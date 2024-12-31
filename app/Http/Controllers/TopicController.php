<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Subtopic;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class TopicController extends Controller
{
    public function __construct()
    {
        // Share topics with all views
        $topics = Topic::with('subtopics')->orderBy('order')->get();
        view()->share('topics', $topics);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->check() && auth()->user()->is_admin) {
            return view('admin.dashboard');
        }
        
        return view('welcome');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            \Log::info('Received topic creation request', $request->all());

            // Validate the basic data first
            $request->validate([
                'title' => 'required|string|max:255',
                'subtopics' => 'required|array|min:1',
                'subtopics.*.title' => 'required|string|max:255',
            ]);

            // Create the topic
            $topic = Topic::create([
                'title' => $request->title,
                'slug' => Str::slug($request->title),
                'order' => Topic::max('order') + 1
            ]);

            \Log::info('Topic created', ['topic' => $topic->toArray()]);

            // Process each subtopic
            foreach ($request->subtopics as $index => $subtopicData) {
                \Log::info('Processing subtopic', [
                    'index' => $index, 
                    'title' => $subtopicData['title'],
                    'file_info' => isset($subtopicData['content_file']) ? [
                        'original_name' => $subtopicData['content_file']->getClientOriginalName(),
                        'mime_type' => $subtopicData['content_file']->getMimeType(),
                        'extension' => $subtopicData['content_file']->getClientOriginalExtension(),
                        'size' => $subtopicData['content_file']->getSize(),
                    ] : 'No file'
                ]);

                // Check if file exists
                if (!isset($subtopicData['content_file'])) {
                    throw new \Exception('No file uploaded for subtopic ' . ($index + 1));
                }

                $file = $subtopicData['content_file'];
                
                // Check file extension instead of mime type
                $extension = strtolower($file->getClientOriginalExtension());
                if (!in_array($extension, ['txt', 'md'])) {
                    throw new \Exception(sprintf(
                        'Invalid file extension for subtopic %d: .%s. Allowed extensions are: .txt, .md',
                        $index + 1,
                        $extension
                    ));
                }

                if (!$file->isValid()) {
                    throw new \Exception('Invalid file upload for subtopic ' . ($index + 1));
                }

                // Read file contents
                $content = file_get_contents($file->path());
                if ($content === false) {
                    throw new \Exception('Failed to read file contents for subtopic ' . ($index + 1));
                }

                // Create a unique slug by appending the topic ID and order
                $baseSlug = Str::slug($subtopicData['title']);
                $slug = $baseSlug;
                $counter = 1;

                // Keep trying until we find a unique slug
                while (Subtopic::where('slug', $slug)->exists()) {
                    $slug = $baseSlug . '-' . $counter;
                    $counter++;
                }

                // Create the subtopic with the unique slug
                $subtopic = $topic->subtopics()->create([
                    'title' => $subtopicData['title'],
                    'slug' => $slug,
                    'content' => $content,
                    'order' => $index + 1
                ]);

                \Log::info('Subtopic created', ['subtopic' => $subtopic->toArray()]);
            }

            return redirect()->route('topics.index')
                           ->with('success', 'Topic created successfully');
        } catch (\Exception $e) {
            \Log::error('Error creating topic', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            // Delete the topic if it was created but subtopics failed
            if (isset($topic)) {
                $topic->delete();
            }

            return redirect()->back()
                           ->with('error', 'Error creating topic: ' . $e->getMessage())
                           ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic, $subtopicSlug = null)
    {
        $subtopic = $subtopicSlug 
            ? $topic->subtopics()->where('slug', $subtopicSlug)->firstOrFail()
            : $topic->subtopics()->orderBy('order')->firstOrFail();

        // Ensure content is a string and properly formatted
        $content = is_string($subtopic->content) ? $subtopic->content : '';
        
        // Remove any potential double encoding
        $content = html_entity_decode($content, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        // Store the clean content back
        $subtopic->content = $content;

        return view('topics.show', compact('topic', 'subtopic'));
    }

    /**
     * Update topic order.
     */
    public function updateOrder(Request $request)
    {
        $validated = $request->validate([
            'topics' => 'required|array',
            'topics.*' => 'exists:topics,id'
        ]);

        foreach ($request->topics as $index => $topicId) {
            Topic::where('id', $topicId)->update(['order' => $index + 1]);
        }

        return response()->json(['message' => 'Order updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        try {
            $topic->delete();
            return redirect()->route('topics.index')
                           ->with('success', 'Topic deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                           ->with('error', 'Error deleting topic: ' . $e->getMessage());
        }
    }
}
