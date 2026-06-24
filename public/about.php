<?php
// 1. Define meta attributes for the About page targeting client acquisition
$pageTitle = "About Hem B. Khatri | Senior Full Stack Software Engineer";
$pageMeta  = [
    'description'  => 'Meet Hem B. Khatri, a Senior Full Stack Engineer specializing in enterprise Python/Django applications, scalable cloud architecture, and strategic software development solutions.',
    'keywords'     => 'About Hem Khatri, Senior Python Engineer Nepal, Enterprise Software Developer, Full Stack Architecture, Backend Consultant Kathmandu, Hire Technical Lead',
    'og_type'      => 'profile',
    'og_image_alt' => 'About Hem B. Khatri — Senior Full Stack Software Engineer',
    'canonical'    => 'https://hemkhatri.com.np',
    'robots'       => 'index, follow',
];

// 2. Safely include header dynamically using the absolute server file path
require_once $_SERVER['DOCUMENT_ROOT'] . '/hemkhatri.com.np/src/includes/header.php';
?>

<!-- Tailwind Design Architecture Configuration Injector -->
<script>
    tailwind.config = {
        darkMode: 'class',
        theme: {
            extend: {
                colors: {
                    brandPrimary: '#009688',
                    brandNeutral: '#0F172A',
                },
                fontFamily: {
                    sans: ['"Montserrat"', 'sans-serif'],
                    headline: ['"Karla"', 'sans-serif'],
                    body: ['"Open Sans"', 'sans-serif'],
                }
            }
        }
    }
</script>

<!-- Content Block Layer -->
<main class="min-h-screen bg-white dark:bg-brandNeutral font-body text-gray-800 dark:text-gray-200 py-16 px-4 sm:px-6 lg:px-8 transition-colors duration-200">
    <div class="max-w-4xl mx-auto">
        
        <!-- Hero Header -->
        <header class="mb-12 border-b border-gray-100 dark:border-gray-800 pb-8">
            <h1 class="font-headline font-bold text-4xl sm:text-5xl text-gray-900 dark:text-white tracking-tight mb-4">
                Engineering High-Performance <span class="text-brandPrimary">Production Systems</span>
            </h1>
            <p class="font-sans text-lg font-medium text-gray-600 dark:text-gray-400">
                Senior Full Stack Software Engineer & Backend Architect based in Kathmandu, Nepal.
            </p>
        </header>

        <!-- Profile Narrative & Core Competencies Split Layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            
            <!-- Left Narrative Column -->
            <div class="md:col-span-2 space-y-6">
                <p>
                    I am a dedicated software engineer with over 4+ years of proven enterprise experience designing, deploying, and maintaining high-traffic web applications, robust REST APIs, and automated distributed backend structures. 
                </p>
                <p>
                    My architectural philosophy focuses on shipping predictable, secure, and horizontally scalable microservices. I specialize in breaking down complex business requirements into clear, functional codebases that lower operational overhead and maximize compute performance.
                </p>
                <p>
                    Whether your organization requires a contract-based technical lead to construct custom web applications from the ground up or a database optimization specialist to patch bottlenecks in existing PostgreSQL setups, I offer reliable, remote engineering partnership.
                </p>
            </div>

            <!-- Right Core Tech Focus Column -->
            <div class="md:col-span-1 bg-gray-50 dark:bg-slate-900 p-6 rounded-xl border border-gray-100 dark:border-gray-800 h-fit">
                <h3 class="font-headline font-semibold text-xl text-gray-900 dark:text-white mb-4">Core Technology Focus</h3>
                <ul class="space-y-2 font-sans text-sm font-medium">
                    <li class="flex items-center"><span class="w-2 h-2 rounded-full bg-brandPrimary mr-2"></span> Python / Django / DRF</li>
                    <li class="flex items-center"><span class="w-2 h-2 rounded-full bg-brandPrimary mr-2"></span> PHP / Modern MVC</li>
                    <li class="flex items-center"><span class="w-2 h-2 rounded-full bg-brandPrimary mr-2"></span> PostgreSQL / Query Optimization</li>
                    <li class="flex items-center"><span class="w-2 h-2 rounded-full bg-brandPrimary mr-2"></span> RESTful & gRPC API Design</li>
                    <li class="flex items-center"><span class="w-2 h-2 rounded-full bg-brandPrimary mr-2"></span> AWS / CI-CD Pipelines</li>
                </ul>
            </div>

        </div>

    </div>
</main>

<?php 
// 3. Safely include footer using the absolute server file path
require_once $_SERVER['DOCUMENT_ROOT'] . '/hemkhatri.com.np/src/includes/footer.php'; 
?>
