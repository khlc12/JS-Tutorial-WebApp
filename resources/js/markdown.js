import { marked } from 'marked';
import DOMPurify from 'dompurify';

// Configure marked options
const markedOptions = {
    breaks: true,
    headerIds: true,
    mangle: false,
    sanitize: false
};

// Custom renderer for links
const renderer = {
    link(href, title, text) {
        // Ensure we have valid text content and handle potential undefined values
        const linkText = text || 
            (typeof href === 'object' ? href.text || href.href : href) || 
            'Link';
        
        // Extract and validate the URL
        const actualHref = typeof href === 'object' && href.href ? href.href : href;
        const hrefString = (actualHref || '').toString().trim();
        
        if (!hrefString) {
            console.warn('Empty href detected in markdown link');
            return `<span class="text-red-500">Invalid Link</span>`;
        }
        
        // Enhanced YouTube regex to support more formats
        const youtubeRegex = /^(?:https?:\/\/)?(?:www\.|m\.)?(?:youtu\.be\/|youtube\.com\/(?:watch\?(?:.*&)?v=|shorts\/|embed\/|v\/))([a-zA-Z0-9_-]+)(?:[?&].*)?$/;
        
        try {
            // Try to construct a URL object to validate the href
            new URL(hrefString.startsWith('http') ? hrefString : `https://${hrefString}`);
            
            if (youtubeRegex.test(hrefString)) {
                const sanitizedHref = DOMPurify.sanitize(hrefString);
                const match = hrefString.match(youtubeRegex);
                const videoId = match ? match[1] : null;
                
                if (!videoId) {
                    throw new Error('Could not extract YouTube video ID');
                }
                
                return `
                    <a href="${sanitizedHref}" 
                       class="youtube-link inline-flex items-center gap-2 px-3 py-2 rounded-full bg-gray-50 hover:bg-red-50 transition-all duration-300 hover:-translate-y-0.5 group relative"
                       target="_blank" 
                       rel="noopener noreferrer"
                       data-video-id="${videoId}">
                        <i class="fab fa-youtube text-red-600 text-xl"></i>
                        <span class="text-gray-700 group-hover:text-gray-900 max-w-[300px] truncate">${DOMPurify.sanitize(linkText)}</span>
                        <i class="fas fa-external-link-alt text-gray-400 text-xs group-hover:text-gray-600"></i>
                        <span class="absolute -bottom-1 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 text-xs text-gray-500">
                            Watch on YouTube
                        </span>
                    </a>
                `.trim();
            }
        } catch (error) {
            console.error('Error processing link:', error);
            return `<span class="text-red-500">Invalid URL: ${DOMPurify.sanitize(linkText)}</span>`;
        }
        
        // Return default link for non-YouTube links with enhanced security
        try {
            const sanitizedHref = DOMPurify.sanitize(hrefString);
            const sanitizedText = DOMPurify.sanitize(linkText);
            const sanitizedTitle = title ? DOMPurify.sanitize(title) : '';
            
            return `
                <a href="${sanitizedHref}" 
                   ${sanitizedTitle ? `title="${sanitizedTitle}"` : ''} 
                   class="text-[#3C8C4E] hover:text-[#2D6B3B] underline inline-flex items-center gap-1 group"
                   ${hrefString.startsWith('http') ? 'target="_blank" rel="noopener noreferrer"' : ''}>
                    <span>${sanitizedText}</span>
                    ${hrefString.startsWith('http') ? '<i class="fas fa-external-link-alt text-xs opacity-50 group-hover:opacity-100"></i>' : ''}
                </a>
            `.trim();
        } catch (error) {
            console.error('Error creating default link:', error);
            return `<span class="text-red-500">Error: Could not create link</span>`;
        }
    }
};

// Set up marked with the options and renderer
marked.use({ 
    renderer,
    ...markedOptions,
    pedantic: false,
    gfm: true
});

// Function to render markdown content
function renderMarkdown() {
    const contentElement = document.getElementById('markdown-content');
    if (!contentElement) {
        console.error('Markdown content element not found');
        return;
    }

    try {
        // Get the raw content
        const rawContent = contentElement.getAttribute('data-content');
        if (!rawContent) {
            console.error('No markdown content found in data-content attribute');
            contentElement.innerHTML = '<p class="text-red-500">No content available</p>';
            return;
        }

        // Decode HTML entities
        const decodedContent = new DOMParser().parseFromString(rawContent, 'text/html').body.textContent;
        
        // Parse the markdown and sanitize the output
        const htmlContent = DOMPurify.sanitize(
            marked.parse(decodedContent)
        );
        
        // Set the content
        contentElement.innerHTML = htmlContent;

        // Style headers
        document.querySelectorAll('h1, h2, h3, h4, h5, h6').forEach(header => {
            header.classList.add(
                'text-[#2D6B3B]',  // Dark green color to match your theme
                'font-bold',
                'my-4'
            );
        });

        // Add syntax highlighting classes to code blocks
        document.querySelectorAll('pre code').forEach(block => {
            block.classList.add(
                'bg-slate-800',
                'p-4',
                'rounded',
                'overflow-x-auto',
                'my-4',
                'block',
                'whitespace-pre',
                'text-gray-100'
            );
            block.style.fontFamily = 'ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace';
        });

        // Style inline code
        document.querySelectorAll('code:not(pre code)').forEach(block => {
            block.classList.add(
                'bg-[#1B4332]',  // Darker green that complements the theme
                'px-2',
                'py-1',
                'rounded',
                'text-sm',
                'font-mono',
                'text-gray-100'
            );
        });

        // Add container styles
        document.querySelectorAll('pre').forEach(block => {
            block.classList.add(
                'my-4',
                'shadow-sm',
                'border',
                'border-gray-200',
                'relative'
            );
        });

        // Style paragraphs for better readability
        document.querySelectorAll('p').forEach(p => {
            p.classList.add(
                'text-[#343A40]',  // Dark gray for better readability
                'leading-relaxed',
                'my-4'
            );
        });

        // Style ordered and unordered lists
        document.querySelectorAll('ol, ul').forEach(list => {
            list.classList.add(
                'my-4',
                'ml-8',  // Add left margin for indentation
                'list-decimal'  // Show numbers for ordered lists
            );
        });

        // Style list items
        document.querySelectorAll('li').forEach(item => {
            item.classList.add(
                'text-[#343A40]',
                'my-2',  // Spacing between list items
                'leading-relaxed'
            );
        });
    } catch (error) {
        console.error('Error rendering markdown:', error);
        contentElement.innerHTML = '<p class="text-red-500">Error rendering content</p>';
    }
}

// Initialize when the DOM is loaded
document.addEventListener('DOMContentLoaded', renderMarkdown);
