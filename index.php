<?php include 'includes/header.php';
// 1. Fetch the latest 4 posts at the top of your index.php file
require_once __DIR__ . '/blogger_api.php';

// 1. Fire the pipeline request
$endpoint = "posts?maxResults=10&";
$cache_filename = "posts_cache.json";
$raw_payload = fetch_blogger_data($endpoint, $cache_filename);

// 2. CRITICAL FIX: Ensure 'items' exists, is an array, and assign it cleanly to $latest_posts
$latest_posts = [];
if ($raw_payload && isset($raw_payload['items']) && is_array($raw_payload['items'])) {
    $latest_posts = format_blogger_posts($raw_payload['items']);
}
?>
<style>
    @layer utilities {
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    }

    @keyframes minimal-drop {

        0%,
        100% {
            transform: translateY(0);
        }

        25% {
            transform: translateY(3px);
        }

        50% {
            transform: translateY(0);
        }

        75% {
            transform: translateY(3px);
        }
    }

    /* When the link (group) is hovered, animate the child with this class */
    .group:hover .animate-drop-twice {
        animation: minimal-drop 0.6s ease-in-out;
    }

    /* Hide the tooltip by default */
    .tooltip-container .tooltip-text {
        visibility: hidden;
        opacity: 0;
        position: absolute;
        z-index: 10;

        /* Position centered at the bottom of the image */
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);

        /* Styling */
        background-color: rgba(0, 0, 0, 0.8);
        color: #ffffff;
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 14px;
        white-space: nowrap;
        transition: opacity 0.2s ease-in-out;
    }

    /* Show the tooltip on hover */
    .tooltip-container:hover .tooltip-text {
        visibility: visible;
        opacity: 1;
    }
</style>

<!-- HERO SECTION -->

<!-- Profile Image Placeholder -->
<div class="mb-8">
    <img src="assets/favicon/profile.png" alt="Hem B. Khatri"
        class="w-16 h-16 rounded-full object-cover border-2 border-brandPrimary/30">
</div>

<!-- Headline -->
<h1
    class="font-sans text-4xl sm:text-5xl md:text-6xl font-bold text-gray-900 dark:text-white mb-6 leading-tight tracking-tight transition-colors duration-300">
    Hem B. Khatri — Full Stack<br class="hidden sm:block">
    Developer in the Himalayas,<br class="hidden sm:block">
    Nepal
</h1>


<!-- Bio Description -->
<p
    class="text-gray-600 dark:text-gray-400 text-base sm:text-lg leading-relaxed max-w-2xl mb-10 transition-colors duration-300">
    I'm Hem B. Khatri, a <a href="/about" class="group/link"><span
            class="text-teal-600 dark:text-teal-400 font-bold hover:underline transition-colors duration-200">Senior
            Full Stack Developer
            based in Nepal</span></a> with 4+ years building production systems. I focus on crafting scalable,
    performant, and robust backend architectures, modern web frameworks, and bringing high-performance digital solutions
    to
    life.
</p>


<!-- Social Icons Link-->
<div class="flex items-center space-x-6">
    <!-- Twitter/X -->
    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path
                d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z" />
        </svg>
    </a>
    <!-- Instagram -->
    <a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path fill-rule="evenodd"
                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                clip-rule="evenodd" />
        </svg>
    </a>
    <!-- GitHub -->
    <a href="https://www.github.com/hemkhatri" class="text-gray-400 hover:text-white transition-colors duration-200">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path fill-rule="evenodd"
                d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                clip-rule="evenodd" />
        </svg>
    </a>
    <!-- LinkedIn -->
    <a href="https://www.linkedin.com/in/hemlex" class="text-gray-400 hover:text-white transition-colors duration-200">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path fill-rule="evenodd"
                d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"
                clip-rule="evenodd" />
        </svg>
    </a>
</div>


<!-- Gallery Section -->
<div class="relative w-screen left-1/2 -translate-x-1/2 overflow-visible my-6">
    <!-- 
      - 'justify-center' keeps the active cards positioned centered on desktop.
      - 'no-scrollbar' hides all track bars.-->
    <div
        class="flex flex-row items-center justify-center gap-10 overflow-x-auto overflow-y-visible py-10 w-full px-4 sm:px-8 no-scrollbar">

        <!-- Card 1: Tilted Left (Removed overflow-hidden from here) -->
        <div class="group relative w-64 h-80 shadow-2xl border border-white/5 flex-shrink-0 transform -rotate-2">

            <!-- Wrapper to keep the rounded corners restricted to just the image -->
            <div class="w-full h-full rounded-3xl overflow-hidden relative">
                <img src="assets/images/badimalika.jpg" alt="Badimalika" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
            </div>

            <!-- Tailwind Tooltip (Safe from overflow-hidden) -->
            <span
                class="absolute bottom-4 left-4 z-20 text-white/80 text-xs font-light tracking-wide opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                Credit: tourisminfonepal.com
            </span>
        </div>

        <!-- Card 2: Tilted Right -->
        <div class="group relative w-64 h-80 shadow-2xl border border-white/5 flex-shrink-0 transform rotate-3">
            <!-- Image Wrapper to clip corners safely -->
            <div class="w-full h-full rounded-3xl overflow-hidden relative">
                <img src="assets/images/mani_baudha.jpg" alt="Mani of Buddha Religion"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
            </div>
            <!-- Tooltip -->
            <span
                class="absolute bottom-4 left-4 z-20 text-white/80 text-xs font-light tracking-wide opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                Credit: worldnomads.com
            </span>
        </div>

        <!-- Card 3: Tilted Left Slightly -->
        <div class="group relative w-64 h-80 shadow-2xl border border-white/5 flex-shrink-0 transform -rotate-2">
            <!-- Image Wrapper to clip corners safely -->
            <div class="w-full h-full rounded-3xl overflow-hidden relative">
                <img src="assets/images/marigold.jpg" alt="Marigold Flower" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
            </div>
            <!-- Tooltip -->
            <span
                class="absolute bottom-4 left-4 z-20 text-white/80 text-xs font-light tracking-wide opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                Credit: brendansadventures.com
            </span>
        </div>

        <!-- Card 4: Tilted Right More -->
        <div class="group relative w-64 h-80 shadow-2xl border border-white/5 flex-shrink-0 transform rotate-2">
            <!-- Image Wrapper to clip corners safely -->
            <div class="w-full h-full rounded-3xl overflow-hidden relative">
                <img src="assets/images/Mountains-Nepal-II.jpg" alt="Mountains of Nepal"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
            </div>
            <!-- Tooltip -->
            <span
                class="absolute bottom-4 left-4 z-20 text-white/80 text-xs font-light tracking-wide opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                Credit: trekroute.com
            </span>
        </div>

        <!-- Card 5: Tilted Left -->
        <div class="group relative w-64 h-80 shadow-2xl border border-white/5 flex-shrink-0 transform -rotate-2">
            <!-- Image Wrapper to clip corners safely -->
            <div class="w-full h-full rounded-3xl overflow-hidden relative">
                <img src="assets/images/nepal boudhanath stupa.jpg" alt="Nepal Boudhanath stupa"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent"></div>
            </div>
            <!-- Tooltip -->
            <span
                class="absolute bottom-4 left-4 z-20 text-white/80 text-xs font-light tracking-wide opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                Credit: nepaltraveller.com
            </span>
        </div>

    </div>
</div>


<!-- My projects -->
<div class="project section py-12">

    <!-- Section Header (Dynamic Light/Dark states) -->
    <div class="mb-6 md:mb-8">
        <h2
            class="font-sans text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-3 transition-colors duration-300">
            Featured Projects</h2>
        <p class="font-body text-gray-600 dark:text-gray-400 text-base md:text-lg transition-colors duration-300">
            Production systems I've designed, built, and shipped.</p>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 -mx-8">

        <!-- Project 1 -->
        <a href="#"
            class="cursor-pointer bg-transparent hover:bg-slate-100 dark:hover:bg-neutral-800/40 p-8 rounded-2xl flex flex-col h-full border border-gray-200/60 dark:border-gray-800/20 group transition-colors duration-300">
            <h3 class="font-sans text-xl font-bold text-gray-900 dark:text-white mb-4 transition-colors duration-300">
                merojob</h3>
            <p
                class="font-body text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-6 flex-grow transition-colors duration-300">
                Nepal's #1 job portal — a high-traffic, full-stack platform handling thousands of daily job
                seekers and employers. Built and maintained core backend services for scalable performance.
            </p>
            <div
                class="text-teal-600 dark:text-teal-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 text-sm font-medium inline-flex items-center transition-colors mt-auto w-max">
                merojob.com
                <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </a>


        <!-- Project 2 -->
        <a href="#"
            class="cursor-pointer bg-transparent hover:bg-slate-100 dark:hover:bg-neutral-800/40 p-8 rounded-2xl flex flex-col h-full border border-gray-200/60 dark:border-gray-800/20 group transition-colors duration-300">
            <h3 class="font-sans text-xl font-bold text-gray-900 dark:text-white mb-4 transition-colors duration-300">
                merojob</h3>
            <p
                class="font-body text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-6 flex-grow transition-colors duration-300">
                Nepal's #1 job portal — a high-traffic, full-stack platform handling thousands of daily job
                seekers and employers. Built and maintained core backend services for scalable performance.
            </p>
            <div
                class="text-teal-600 dark:text-teal-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 text-sm font-medium inline-flex items-center transition-colors mt-auto w-max">
                merojob.com
                <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </a>

        <!-- Project 3 -->
        <a href="#"
            class="cursor-pointer bg-transparent hover:bg-slate-100 dark:hover:bg-neutral-800/40 p-8 rounded-2xl flex flex-col h-full border border-gray-200/60 dark:border-gray-800/20 group transition-colors duration-300">
            <h3 class="font-sans text-xl font-bold text-gray-900 dark:text-white mb-4 transition-colors duration-300">
                merojob</h3>
            <p
                class="font-body text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-6 flex-grow transition-colors duration-300">
                Nepal's #1 job portal — a high-traffic, full-stack platform handling thousands of daily job
                seekers and employers. Built and maintained core backend services for scalable performance.
            </p>
            <div
                class="text-teal-600 dark:text-teal-400 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 text-sm font-medium inline-flex items-center transition-colors mt-auto w-max">
                merojob.com
                <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </div>
        </a>

    </div>

    <!-- View All Projects Link Container -->
    <div class="mt-12">
        <a href="#"
            class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-500 font-medium text-sm inline-flex items-center group transition-colors">
            View all projects
            <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>
    </div>

</div>

<!-- Core Services -->
<div class="core-services section py-16">
    <!-- Section Header (Dynamic Light/Dark states) -->
    <div class="mb-6 md:mb-8">
        <h2
            class="font-sans text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-3 transition-colors duration-300">
            Core Services</h2>
        <p class="font-body text-gray-600 dark:text-gray-400 text-base md:text-lg transition-colors duration-300">What I
            bring to your engineering team or project.</p>
    </div>

    <!-- Core Services Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

        <!-- Backend Architecture Card 1 -->
        <div
            class="bg-white dark:bg-[#424552] p-8 rounded-2xl flex flex-col h-full border border-gray-200/80 dark:border-gray-800/30 shadow-sm dark:shadow-none transition-colors duration-300">
            <!-- Top Icon Badge -->
            <div
                class="w-12 h-12 rounded-xl border border-gray-200 dark:border-gray-700/50 flex items-center justify-center mb-6 bg-gray-50 dark:bg-transparent transition-colors duration-300">
                <!-- Database SVG Icon -->
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 transition-colors duration-300" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 7v10c0 2.21 3.58 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.58 4 8 4s8-1.79 8-4M4 7c0-2.21 3.58-4 8-4s8 1.79 8 4m0 5c0 2.21-3.58 4-8 4s-8-1.79-8-4" />
                </svg>
            </div>

            <!-- Title -->
            <h3 class="font-sans text-xl font-bold text-gray-900 dark:text-white mb-2 transition-colors duration-300">
                Backend Architecture</h3>

            <!-- Inline Tech Stack (with dots) -->
            <div class="font-body text-sm font-medium mb-4 flex flex-wrap gap-1.5 items-center">
                <span class="text-teal-600 dark:text-teal-400 transition-colors">Python</span>
                <span class="text-emerald-600/50 dark:text-emerald-500/50 font-bold transition-colors">·</span>
                <span class="text-teal-600 dark:text-teal-400 transition-colors">Django</span>
                <span class="text-emerald-600/50 dark:text-emerald-500/50 font-bold transition-colors">·</span>
                <span class="text-teal-600 dark:text-teal-400 transition-colors">PostgreSQL</span>
            </div>

            <!-- Description -->
            <p
                class="font-body text-gray-600 dark:text-gray-400 text-sm leading-relaxed flex-grow transition-colors duration-300">
                Designing and shipping scalable REST APIs, background workers, and database schemas that handle
                millions of requests with PostgreSQL and Django.
            </p>
        </div>

        <!-- Backend Architecture Card 2 -->
        <div
            class="bg-white dark:bg-[#424552] p-8 rounded-2xl flex flex-col h-full border border-gray-200/80 dark:border-gray-800/30 shadow-sm dark:shadow-none transition-colors duration-300">
            <!-- Top Icon Badge -->
            <div
                class="w-12 h-12 rounded-xl border border-gray-200 dark:border-gray-700/50 flex items-center justify-center mb-6 bg-gray-50 dark:bg-transparent transition-colors duration-300">
                <!-- Database SVG Icon -->
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 transition-colors duration-300" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 7v10c0 2.21 3.58 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.58 4 8 4s8-1.79 8-4M4 7c0-2.21 3.58-4 8-4s8 1.79 8 4m0 5c0 2.21-3.58 4-8 4s-8-1.79-8-4" />
                </svg>
            </div>

            <!-- Title -->
            <h3 class="font-sans text-xl font-bold text-gray-900 dark:text-white mb-2 transition-colors duration-300">
                Backend Architecture</h3>

            <!-- Inline Tech Stack (with dots) -->
            <div class="font-body text-sm font-medium mb-4 flex flex-wrap gap-1.5 items-center">
                <span class="text-teal-600 dark:text-teal-400 transition-colors">Python</span>
                <span class="text-emerald-600/50 dark:text-emerald-500/50 font-bold transition-colors">·</span>
                <span class="text-teal-600 dark:text-teal-400 transition-colors">Django</span>
                <span class="text-emerald-600/50 dark:text-emerald-500/50 font-bold transition-colors">·</span>
                <span class="text-teal-600 dark:text-teal-400 transition-colors">PostgreSQL</span>
            </div>

            <!-- Description -->
            <p
                class="font-body text-gray-600 dark:text-gray-400 text-sm leading-relaxed flex-grow transition-colors duration-300">
                Designing and shipping scalable REST APIs, background workers, and database schemas that handle
                millions of requests with PostgreSQL and Django.
            </p>
        </div>

        <!-- Backend Architecture Card 3 -->
        <div
            class="bg-white dark:bg-[#424552] p-8 rounded-2xl flex flex-col h-full border border-gray-200/80 dark:border-gray-800/30 shadow-sm dark:shadow-none transition-colors duration-300">
            <!-- Top Icon Badge -->
            <div
                class="w-12 h-12 rounded-xl border border-gray-200 dark:border-gray-700/50 flex items-center justify-center mb-6 bg-gray-50 dark:bg-transparent transition-colors duration-300">
                <!-- Database SVG Icon -->
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400 transition-colors duration-300" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M4 7v10c0 2.21 3.58 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.58 4 8 4s8-1.79 8-4M4 7c0-2.21 3.58-4 8-4s8 1.79 8 4m0 5c0 2.21-3.58 4-8 4s-8-1.79-8-4" />
                </svg>
            </div>

            <!-- Title -->
            <h3 class="font-sans text-xl font-bold text-gray-900 dark:text-white mb-2 transition-colors duration-300">
                Backend Architecture</h3>

            <!-- Inline Tech Stack (with dots) -->
            <div class="font-body text-sm font-medium mb-4 flex flex-wrap gap-1.5 items-center">
                <span class="text-teal-600 dark:text-teal-400 transition-colors">Python</span>
                <span class="text-emerald-600/50 dark:text-emerald-500/50 font-bold transition-colors">·</span>
                <span class="text-teal-600 dark:text-teal-400 transition-colors">Django</span>
                <span class="text-emerald-600/50 dark:text-emerald-500/50 font-bold transition-colors">·</span>
                <span class="text-teal-600 dark:text-teal-400 transition-colors">PostgreSQL</span>
            </div>

            <!-- Description -->
            <p
                class="font-body text-gray-600 dark:text-gray-400 text-sm leading-relaxed flex-grow transition-colors duration-300">
                Designing and shipping scalable REST APIs, background workers, and database schemas that handle
                millions of requests with PostgreSQL and Django.
            </p>
        </div>

    </div>
</div>


<!-- Articles Wrapper -->
<div class="w-full articles-section py-12">

    <div class="mb-6 md:mb-8">
        <h2
            class="font-sans text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-3 transition-colors duration-300">
            Latest Writing</h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-16 md:gap-24 items-start w-full">

        <div class="md:col-span-1 flex flex-col gap-12">

            <?php
            // 1. Slice the array matrix to keep only the first 5 entries
            $display_posts = is_array($latest_posts) ? array_slice($latest_posts, 0, 5) : [];

            // 2. Loop safely through the sliced array matrix
            if (!empty($display_posts)):
                foreach ($display_posts as $post):
                    // Safety guard: skip iteration if for any reason a broken string leaks into the loop
                    if (!is_array($post))
                        continue;

                    // Convert the friendly date back to YYYY-MM-DD for the HTML datetime attribute
                    $datetime_attr = date('Y-m-d', strtotime($post['created_at'] ?? 'now'));
                    ?>
                    <article class="group relative flex flex-col items-start">
                        <h2 class="text-base font-semibold tracking-tight text-zinc-800 dark:text-zinc-100">
                            <div
                                class="absolute -inset-x-4 -inset-y-6 z-0 scale-95 bg-zinc-50 opacity-0 transition group-hover:scale-100 group-hover:opacity-100 dark:bg-zinc-800/50 sm:-inset-x-6 sm:rounded-2xl">
                            </div>
                            <a href="post.php?slug=<?php echo $post['slug']; ?>">
                                <span class="absolute -inset-x-4 -inset-y-6 z-20 sm:-inset-x-6 sm:rounded-2xl"></span>
                                <span class="relative z-10"><?php echo $post['title']; ?></span>
                            </a>
                        </h2>
                        <time
                            class="relative z-10 order-first mb-3 flex items-center text-sm text-zinc-400 dark:text-zinc-500 pl-3.5"
                            datetime="<?php echo $datetime_attr; ?>">
                            <span class="absolute inset-y-0 left-0 flex items-center" aria-hidden="true">
                                <span class="h-4 w-0.5 rounded-full bg-zinc-200 dark:bg-zinc-500"></span>
                            </span>
                            <?php echo $post['created_at']; ?>
                        </time>
                        <p class="relative z-10 mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                            <?php echo $post['excerpt']; ?>
                        </p>
                        <div aria-hidden="true" class="relative z-10 mt-4 flex items-center text-sm font-medium text-teal-500">
                            Read article
                            <svg viewBox="0 0 20 20" fill="currentColor"
                                class="ml-1 h-4 w-4 transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform duration-200">
                                <path fill-rule="evenodd"
                                    d="M5.22 14.78a.75.75 0 001.06 0l7.22-7.22v5.69a.75.75 0 001.5 0v-7.5a.75.75 0 00-.75-.75h-7.5a.75.75 0 000 1.5h5.69l-7.22 7.22a.75.75 0 000 1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                    </article>
                    <?php
                endforeach;
            else:
                ?>
                <p class="text-zinc-500 dark:text-zinc-400">System logs are currently empty. Check back later.</p>
            <?php endif; ?>

            <div class="mt-6">
                <a href="blogs.php"
                    class="text-emerald-500 hover:text-emerald-400 text-sm font-medium inline-flex items-center group transition-colors">
                    View all articles
                    <svg class="w-4 h-4 ml-1.5 transform group-hover:translate-x-1 transition-transform" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

        </div>


        <div
            class="md:col-span-1 bg-white dark:bg-[#343742]/40 border border-gray-200/80 dark:border-gray-700/40 p-6 rounded-3xl shadow-sm dark:shadow-inner transition-colors duration-300">

            <div class="flex items-center gap-3 mb-6">
                <div class="text-gray-500 dark:text-teal-400 transition-colors duration-300">
                    <svg class="w-5 h-5 stroke-[1.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 14.15v4.25c0 .552-.448 1-1 1H4.75c-.552 0-1-.448-1-1v-4.25m16.5 0a2.25 2.25 0 00-2.25-2.25H5.25A2.25 2.25 0 003 14.15m17.25 0c-.267-.034-.539-.05-.814-.05H4.564c-.275 0-.547.016-.814.05M16.5 7.5V6.25a2.25 2.25 0 00-2.25-2.25h-4.5A2.25 2.25 0 007.5 6.25V7.5m9 0H7.5" />
                    </svg>
                </div>
                <h3
                    class="text-sm font-semibold text-gray-900 dark:text-white tracking-wide transition-colors duration-300">
                    Work Experience</h3>
            </div>

            <div class="space-y-6 mb-6">
                <div class="flex items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-white flex items-center justify-center overflow-hidden flex-shrink-0 border border-gray-200 dark:border-gray-600/50 p-1 transition-colors duration-300">
                            <span class="text-xs font-bold text-blue-900 tracking-tighter">mj</span>
                        </div>
                        <div class="flex flex-col">
                            <span
                                class="text-sm font-semibold text-gray-900 dark:text-white leading-tight transition-colors duration-300">merojob</span>
                            <span
                                class="text-xs text-teal-600 dark:text-teal-400 mt-0.5 font-medium transition-colors duration-300">Senior
                                Full Stack Developer</span>
                        </div>
                    </div>
                    <span
                        class="text-xs font-medium text-gray-500 dark:text-gray-400 whitespace-nowrap transition-colors duration-300">2021
                        — Present</span>
                </div>
            </div>

            <a href="/resume.pdf" download
                class="group w-full inline-flex items-center justify-center gap-2 rounded-xl text-sm font-medium py-3 px-4 bg-gray-100 hover:bg-gray-200/80 dark:bg-neutral-800/60 dark:hover:bg-neutral-800 dark:text-zinc-200 border border-gray-300/60 dark:border-gray-700/50 hover:border-gray-400 dark:hover:border-gray-600 transition-all duration-200">
                Download CV
                <svg class="w-3.5 h-3.5 stroke-[2.5] animate-drop-twice transition-transform duration-200" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5L12 21m0 0l-7.5-7.5M12 21V3" />
                </svg>
            </a>
        </div>

    </div>
</div>
<?php include 'includes/footer.php'; ?>