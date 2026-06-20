<?php
// 1. Full database simulation array matrix (Matches your blogs data schema exactly)
$blogs_data = [
    "building-ai-agent-workflows-langgraph-django" => [
        "title" => "Building AI Agent Workflows with LangGraph and Django",
        "date" => "March 25, 2026",
        "read_time" => "5 min read",
        "category" => "AI Workflows",
        "thumbnail" => "https://unsplash.com",
        "content" => "
            <p>Artificial Intelligence workflows are shifting from simple single-prompt completions to long-running, multi-agent state machines. Orchestrating these advanced state operations requires absolute persistence and task-handling robustness.</p>
            <h3>Why LangGraph?</h3>
            <p>LangGraph allows developers to design agent workflows as cyclic graphs. This enables complex loop operations, memory management cycles, and human-in-the-loop interaction layers that traditional linear chains cannot sustain cleanly.</p>
            <h3>Integrating with Django</h3>
            <p>While LangGraph handles the agent execution logic, Django acts as the powerful foundation system, taking charge of:</p>
            <ul>
                <li><strong>State Persistence:</strong> Saving complete graph step matrices safely using PostgreSQL JSONB schema metrics.</li>
                <li><strong>Background Processing:</strong> Offloading heavy model queries safely into Celery task workers.</li>
                <li><strong>API Operations:</strong> Exposing clear REST API endpoints to streaming client applications.</li>
            </ul>
        "
    ],
    "scaling-postgresql-queries-high-traffic" => [
        "title" => "Scaling PostgreSQL Database Queries for High-Traffic Applications",
        "date" => "February 12, 2026",
        "read_time" => "8 min read",
        "category" => "Database",
        "thumbnail" => "https://unsplash.com",
        "content" => "
            <p>Sustaining millions of read and write requests per day demands strategic database optimizations beyond running simple queries.</p>
            <h3>1. Intelligent Indexing Strategies</h3>
            <p>Avoid blindly creating indexes across every single table column. Focus instead on composite or partial indexes designed to speed up specific high-traffic application lookup workflows.</p>
            <h3>2. Connection Management with PgBouncer</h3>
            <p>PostgreSQL spawns an independent backend process for every single inbound connection. By dropping a connection pooler like PgBouncer directly in front of your database instances, you can reuse active pipelines and slash massive server CPU load spikes.</p>
        "
    ],
    "merojob-backend-zero-downtime-migration" => [
        "title" => "How We Engineered Merojob Backend for Zero-Downtime Migration",
        "slug" => "merojob-backend-zero-downtime-migration",
        "date" => "January 05, 2026",
        "read_time" => "6 min read",
        "category" => "Backend",
        "thumbnail" => "https://unsplash.com",
        "content" => "
            <p>When operating a market-dominant job portal handling massive live traffic loads, downtime translates to lost business for employers and job seekers alike. Migrating our database required careful architectural execution.</p>
            <h3>The Strategy: Dual-Write Isolation Pipeline</h3>
            <p>Instead of throwing the database offline, we structured a dual-write mechanism. Active records written on our platform populated both legacy and modern target tables concurrently while background processing workers synchronized historical records safely in the background.</p>
        "
    ]
];

// 2. Safely capture the inbound URL token parameter 
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

// 3. Fallback routing redirect logic if requested token is invalid or blank
if (empty($slug) || !array_key_exists($slug, $blogs_data)) {
    header("Location: blogs.php");
    exit;
}

// 4. Extract targeted post payload dimensions
$article = $blogs_data[$slug];

// 5. Mount site layouts 
$pageTitle = $article['title'] . " - Hem B. Khatri";
include "../includes/header.php";
?>

<!-- Article Wrapper Layout Container -->
<div class="w-full max-w-3xl mx-auto py-4">

    <!-- Go Back Link Navigation Navigation -->
    <div class="mb-8 -ml-4 sm:-ml-6 pl-4 sm:pl-6">
        <a href="blogs.php" class="inline-flex items-center text-sm font-medium text-teal-500 hover:text-teal-400 transition-colors group">
            <svg class="w-4 h-4 mr-2 transform group-hover:-translate-x-0.5 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Articles
        </a>
    </div>

    <!-- Article Core Header Context Block Layout Alignment -->
    <div class="mb-8 border-b border-gray-800 pb-8 -ml-4 sm:-ml-6 pl-4 sm:pl-6">
        
        <!-- Metadata Inline Row Array Elements -->
        <div class="mb-4 flex flex-wrap items-center gap-2 text-xs text-gray-500 font-body">
            <time class="flex items-center pl-3.5 relative">
                <span class="absolute inset-y-0 left-0 flex items-center" aria-hidden="true">
                    <span class="h-3 w-0.5 rounded-full bg-gray-700"></span>
                </span>
                <?php echo $article['date']; ?>
            </time>
            <span class="text-gray-700">•</span>
            <span><?php echo $article['read_time']; ?></span>
            <span class="text-gray-700">•</span>
            
            <!-- Enterprise Styled Verified Category Pill Component -->
            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider text-[#009688] bg-[#009688]/10 border border-[#009688]/20 backdrop-blur-sm shadow-sm shadow-[#009688]/5">
                <?php echo $article['category']; ?>
            </span>
        </div>

        <h1 class="font-headline text-3xl md:text-4xl lg:text-5xl font-bold tracking-tight text-white leading-tight">
            <?php echo $article['title']; ?>
        </h1>
    </div>

    <!-- Full-Width Landscape Post Feature Banner Graphic Image Box -->
    <div class="relative w-full aspect-video rounded-xl overflow-hidden border border-gray-800 bg-gray-900/40 mb-10 shadow-2xl">
        <img src="<?php echo $article['thumbnail']; ?>" alt="<?php echo $article['title']; ?>" class="w-full h-full object-cover">
    </div>

    <!-- Dynamic Prose Content Area Box (Injects formatted semantic markdown HTML arrays securely) -->
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

<?php include "../includes/footer.php"; ?>
