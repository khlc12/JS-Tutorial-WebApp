<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Topic;

class Subtopic extends Model
{
    use HasFactory;

    protected $fillable = [
        'topic_id',
        'title',
        'slug',
        'content',
        'order'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
