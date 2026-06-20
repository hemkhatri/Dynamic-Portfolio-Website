<?php
// 1. Set dynamic metadata context before loading layouts
$pageTitle = "Hem B. Khatri - Articles & Insights";
include "../includes/header.php";

// 2. Full backend data production engine (PHP Data Set Array Matrix)
$blogs_data = [
    [
        "id" => 1,
        "title" => "Building AI Agent Workflows with LangGraph and Django",
        "slug" => "building-ai-agent-workflows-langgraph-django",
        "date" => "March 25, 2026",
        "datetime" => "2026-03-25",
        "read_time" => "5 min read",
        "category" => "AI Workflows",
        "excerpt" => "A technical deep-dive into building production-grade AI agent workflows using LangGraph for orchestration and Django for persistence, background tasks, and API exposure.",
        "thumbnail" => "https://unsplash.com"
    ],
    [
        "id" => 2,
        "title" => "Scaling PostgreSQL Database Queries for High-Traffic Applications",
        "slug" => "scaling-postgresql-queries-high-traffic",
        "date" => "February 12, 2026",
        "datetime" => "2026-02-12",
        "read_time" => "8 min read",
        "category" => "Database",
        "excerpt" => "Optimizing slow indexing, handling connection pooling issues with PgBouncer, and structuring complex database queries to sustain millions of daily requests safely.",
        "thumbnail" => "https://unsplash.com"
    ],
    [
        "id" => 3,
        "title" => "How We Engineered Merojob Backend for Zero-Downtime Migration",
        "slug" => "merojob-backend-zero-downtime-migration",
        "date" => "January 05, 2026",
        "datetime" => "2026-01-05",
        "read_time" => "6 min read",
        "category" => "Backend",
        "excerpt" => "An architectural breakdown of running dual-write data pipelines during a complete database overhaul without interrupting active job seekers or employers.",
        "thumbnail" => "https://unsplash.com"
    ]
];

$json_blogs = json_encode($blogs_data);
?>

<!-- Clean Context Container -->
<div class="w-full max-w-4xl mx-auto py-4">

    <!-- Section Header Layout Alignment (Shifted left using negative margin utilities) -->
    <div class="mb-12 border-b border-gray-800 pb-8 -ml-4 sm:-ml-6 pl-4 sm:pl-6">
        <h1 class="font-headline text-3xl md:text-4xl font-bold tracking-tight text-white mb-3">
            Articles & Insights
        </h1>
        <p class="font-body text-gray-400 text-sm md:text-base leading-relaxed max-w-2xl">
            Deep dives into backend engineering, systemic architecture optimization, and building intelligent workflows.
        </p>
    </div>

    <!-- Vertical Stack Feed Container -->
    <div id="blogs-list" class="flex flex-col divide-y divide-gray-800">
        <!-- Loading Fallback State -->
        <div id="loading-state" class="text-gray-500 font-body text-sm py-4">
            Loading log entries...
        </div>
    </div>

</div>

<!-- JavaScript Render Application logic -->
<script>
    const blogsData = <?php echo $json_blogs; ?>;

    function renderBlogs(articles) {
        const listContainer = document.getElementById('blogs-list');
        if (!listContainer) return;

        listContainer.innerHTML = '';

        if (!articles || articles.length === 0) {
            listContainer.innerHTML = `<p class="text-gray-500 py-4">No articles found.</p>`;
            return;
        }

        articles.forEach((article, index) => {
            const paddingClass = index === 0 ? 'pb-8' : 'py-8';

            const cardHtml = `
                <article class="group relative flex flex-col sm:flex-row items-stretch gap-6 ${paddingClass}">
                    <!-- Interactive Hover Micro-Highlight Layer -->
                    <div class="absolute -inset-x-4 -inset-y-2 z-0 scale-95 bg-gray-800/10 opacity-0 transition group-hover:scale-100 group-hover:opacity-100 rounded-2xl sm:-inset-x-6"></div>
                    
                    <!-- [] FULL-WIDTH MOBILE LANDSCAPE THUMBNAIL CONTAINER -->
                    <div class="relative z-10 w-full sm:w-[240px] aspect-video rounded-lg overflow-hidden border border-gray-800 bg-gray-900/40 flex-shrink-0">
                        <img src="${article.thumbnail}" alt="${article.title}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" onerror="this.onerror=null; this.src='https://placehold.co';">
                    </div>

                    <!-- MAIN ITEM CONTENT COLUMN WRAPPER -->
                    <div class="relative z-10 w-full flex flex-col justify-center">
                        
                        <!-- [] METADATA ROW: Date, Read Time, and Clean Category Tag -->
                        <div class="mb-2 flex flex-wrap items-center gap-2 text-xs text-gray-500 font-body mt-2 sm:mt-0">
                            <time datetime="${article.datetime}" class="flex items-center pl-3.5 relative">
                                <span class="absolute inset-y-0 left-0 flex items-center" aria-hidden="true">
                                    <span class="h-3 w-0.5 rounded-full bg-gray-700"></span>
                                </span>
                                ${article.date}
                            </time>
                            <span class="text-gray-700">•</span>
                            <span>${article.read_time}</span>
                            <span class="text-gray-700">•</span>
                            <!-- High-Trust Styled Category Badge -->
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider text-[#009688] bg-[#009688]/10 border border-[#009688]/20 backdrop-blur-sm shadow-sm shadow-[#009688]/5">
                                ${article.category}
                            </span>

                        </div>

                        <!-- [] TITLE AREA -->
                        <h2 class="font-headline text-lg md:text-xl font-bold tracking-tight text-white mb-2">
                             <a href="post.php?slug=${article.slug}">
                                <span class="absolute -inset-x-4 -inset-y-2 z-20 sm:-inset-x-6 rounded-2xl"></span>
                                <span class="relative z-10 group-hover:text-brandPrimary transition-colors duration-200">${article.title}</span>
                            </a>
                        </h2>

                        <!-- [] SHORT DESCRIPTION SUMMARY EXCERPT -->
                        <p class="font-body text-xs md:text-sm text-gray-400 leading-relaxed mb-4 max-w-3xl">
                            ${article.excerpt}
                        </p>

                        <!-- [] READ ARTICLE LINK -->
                        <div aria-hidden="true" class="flex items-center text-xs md:text-sm font-medium text-teal-500 group-hover:text-teal-400 transition-colors">
                            Read article
                            <svg viewBox="0 0 20 20" fill="currentColor" class="ml-1 h-4 w-4 transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform duration-200">
                                <path fill-rule="evenodd" d="M5.22 14.78a.75.75 0 001.06 0l7.22-7.22v5.69a.75.75 0 001.5 0v-7.5a.75.75 0 00-.75-.75h-7.5a.75.75 0 000 1.5h5.69l-7.22 7.22a.75.75 0 000 1.06z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </article>
            `;
            listContainer.innerHTML += cardHtml;
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        renderBlogs(blogsData);
    });
</script>

<?php include "../includes/footer.php"; ?>