<?php
// 1. FORCE XAMPP TO SHOW ERRORS (Prevents blank screens)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Load your Blogger API connection
require_once dirname(__DIR__) . '/backend/blogger_post_handler.php';

// 3. Fetch the raw posts matrix payload
$raw_payload = fetch_blogger_data('posts?maxResults=50&', 'posts_cache.json');

// 4. Safely capture the inbound URL token parameter 
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

// 5. Fallback routing if the requested token is invalid or blank
if (empty($slug)) {
    header("Location: articles.php");
    exit;
}

// 6. Extract and format items using your core array formatter matrix
$formatted_posts = [];
if ($raw_payload && isset($raw_payload['items']) && is_array($raw_payload['items'])) {
    $formatted_posts = format_blogger_posts($raw_payload['items']);
}

// 7. Search the formatted array matrix for the specific post matching the slug
$article = null;
if (!empty($formatted_posts)) {
    foreach ($formatted_posts as $post) {
        if (isset($post['slug']) && $post['slug'] === $slug) {
            $article = $post;
            break;
        }
    }
}

// 8. If no post matched, redirect up to the actual root level blogs.php
if (!$article) {
    header("Location: articles.php");
    exit;
}

// --- DYNAMIC DATA PREPARATION ---

// Calculate Read Time dynamically (assumes ~200 words per minute reading speed)
$word_count = str_word_count(strip_tags($article['content'] ?? ''));
$read_time_minutes = max(1, ceil($word_count / 200)); 
$read_time = $read_time_minutes . " min read";

// FIX: Use 'category_name' directly from your clean formatted array
$category = !empty($article['category_name']) ? $article['category_name'] : 'Article';

// Handle Thumbnail: Use the 'image' key from the formatted array
$thumbnail = !empty($article['image']) ? $article['image'] : 'https://unsplash.com'; 

// 9. Mount site layouts 
$pageTitle = $article['title'] . " - Hem B. Khatri";

// Safety Check: Include header file only if it exists to avoid include-errors
if (file_exists("../includes/header.php")) {
    include "../includes/header.php";
} else {
    echo "<style>body { background: #0b0f19; color: white; font-family: sans-serif; padding: 40px; }</style>";
}
?>

<div class="w-full max-w-3xl mx-auto py-4">

    <div class="mb-8 -ml-4 sm:-ml-6 pl-4 sm:pl-6">
        <a href="articles/articles.php" class="inline-flex items-center text-sm font-medium text-teal-500 hover:text-teal-400 transition-colors group">
            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Articles
        </a>
    </div>

    <div class="mb-8 border-b border-gray-800 pb-8 -ml-4 sm:-ml-6 pl-4 sm:pl-6">
        
        <div class="mb-4 flex flex-wrap items-center gap-2 text-xs text-gray-500 font-body">
            <time class="flex items-center pl-3.5 relative">
                <span class="absolute inset-y-0 left-0 flex items-center" aria-hidden="true">
                    <span class="h-3 w-0.5 rounded-full bg-gray-700"></span>
                </span>
                <?php echo $article['created_at']; ?>
            </time>
            <span class="text-gray-700">•</span>
            <span><?php echo $read_time; ?></span>
            <span class="text-gray-700">•</span>
            
            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider text-[#009688] bg-[#009688]/10 border border-[#009688]/20 backdrop-blur-sm shadow-sm shadow-[#009688]/5">
                <?php echo $category; ?>
            </span>
        </div>

        <h1 class="font-headline text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-white leading-tight">
            <?php echo $article['title']; ?>
        </h1>
    </div>

    <div class="relative w-full aspect-video rounded-xl overflow-hidden border border-gray-800 bg-gray-900/40 mb-10 shadow-2xl">
        <img src="<?php echo $thumbnail; ?>" alt="<?php echo $article['title']; ?>" class="w-full h-full object-cover">
    </div>

    <article class="font-body text-gray-300 text-base leading-relaxed space-y-6 
                    prose prose-invert max-w-none
                    prose-headings:font-headline prose-headings:font-bold prose-headings:text-white prose-headings:tracking-tight
                    prose-h3:text-xl prose-h3:mt-8 prose-h3:mb-3
                    prose-p:text-gray-400 prose-p:leading-relaxed
                    prose-ul:list-disc prose-ul:pl-6 prose-ul:space-y-2 prose-ul:text-gray-400
                    prose-strong:text-white prose-strong:font-semibold">
        <?php echo $article['content']; ?>
    </article>

</div>

<?php 
if (file_exists("../includes/footer.php")) {
    include "../includes/footer.php"; 
}
?>
