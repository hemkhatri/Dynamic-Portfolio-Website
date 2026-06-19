<?php
// Get the current file name to handle active links automatically
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Using dynamic page title variable if set on pages -->
    <title><?php echo isset($pageTitle) ? $pageTitle : "Hem B. Khatri - Portfolio"; ?></title>

    <!-- Import Google Fonts -->
    <link rel="preconnect" href="https://googleapis.com">
    <link rel="preconnect" href="https://gstatic.com" crossorigin>
    <link
        href="https://googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' ||
            (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Tailwind Configuration -->
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
   <style>
    /* Base setup for the logo pill container */
    #logo-pill {
        background-color: transparent;
        border: 1px solid transparent;
        box-shadow: none;
        backdrop-filter: blur(0px);
        -webkit-backdrop-filter: blur(0px);
        /* Smooth out all properties over 250ms natively */
        transition: all 0.25s ease-in-out !important; 
    }

    /* Light Mode: Injects the blurred glass layer cleanly on scroll down */
    #logo-pill.scrolled {
        background-color: rgba(255, 255, 255, 0.4) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        border: 1px solid rgba(229, 231, 235, 0.4) !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
    }

    /* Dark Mode: Adaptive dark glass settings on scroll down */
    .dark #logo-pill.scrolled {
        background-color: rgba(23, 23, 23, 0.4) !important;
        border: 1px solid rgba(63, 63, 70, 0.4) !important;
        box-shadow: none !important;
    }
</style>




</head>

<body class="bg-white dark:bg-black min-h-screen font-body flex flex-col transition-colors duration-300">

    <!-- Header Component (Main container is fully invisible/naked) -->
    <header id="main-header"
        class="fixed top-6 left-0 w-full px-4 sm:px-8 lg:px-16 transition-all duration-300 ease-in-out z-50">
        <div class="max-w-7xl mx-auto flex items-center justify-between h-16">

            <!-- Fully naked container at top position — no border, no shadow, no bg -->
<div id="logo-pill" class="flex-shrink-0 flex items-center rounded-full px-5 py-2">
    <a href="<?php echo ($current_page == 'index.php') ? 'index.php' : '../index.php'; ?>" class="font-headline font-bold text-gray-900 dark:text-white text-base sm:text-lg tracking-wide transition-colors">
        Hem B. Khatri
    </a>
</div>




            <!-- Center Element: Floating Rounded Pill ONLY for Desktop Nav Links -->
            <nav
                class="hidden md:flex items-center space-x-1 lg:space-x-2 bg-white/40 dark:bg-neutral-900/40 backdrop-blur-md border border-gray-200/40 dark:border-neutral-800/40 shadow-md rounded-full px-6 py-2 transition-colors duration-300">
                <a href="<?php echo ($current_page == 'index.php') ? 'index.php' : '../index.php'; ?>"
                    class="px-3 py-1 rounded-full text-sm font-medium transition-colors duration-200 <?php echo ($current_page == 'index.php' || $current_page == '') ? 'text-brandPrimary font-semibold' : 'text-gray-600 dark:text-gray-400 hover:text-brandPrimary'; ?>">Home</a>
                <a href="<?php echo ($current_page == 'index.php') ? '#about' : '../index.php#about'; ?>"
                    class="px-3 py-1 rounded-full text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-brandPrimary transition-colors duration-200">About</a>
                <a href="<?php echo ($current_page == 'index.php') ? '#skills' : '../index.php#skills'; ?>"
                    class="px-3 py-1 rounded-full text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-brandPrimary transition-colors duration-200">Skills</a>
                <a href="<?php echo ($current_page == 'index.php') ? '#services' : '../index.php#services'; ?>"
                    class="px-3 py-1 rounded-full text-sm font-medium text-gray-600 dark:text-gray-400 hover:text-brandPrimary transition-colors duration-200">Services</a>
                <a href="<?php echo ($current_page == 'index.php') ? 'blogs/blogs.php' : 'blogs.php'; ?>"
                    class="px-3 py-1 rounded-full text-sm font-medium transition-colors duration-200 <?php echo ($current_page == 'blogs.php') ? 'text-brandPrimary font-semibold' : 'text-gray-600 dark:text-gray-400 hover:text-brandPrimary'; ?>">Blog</a>
            </nav>

            <!-- Right Element: Floating Rounded Pill for Theme Toggler & Mobile Trigger -->
            <div
                class="flex items-center space-x-2 bg-white/40 dark:bg-neutral-900/40 backdrop-blur-md border border-gray-200/40 dark:border-neutral-800/40 shadow-md rounded-full p-1.5 transition-colors duration-300">
                <button id="theme-toggle" type="button"
                    class="text-gray-500 dark:text-gray-400 hover:bg-gray-200/50 dark:hover:bg-neutral-800/60 focus:outline-none rounded-full text-sm p-2 transition-all"
                    aria-label="Toggle theme">
                    <!-- Sun Icon -->
                    <svg id="theme-toggle-sun-icon" class="hidden h-5 w-5 fill-current" viewBox="0 0 20 20"
                        xmlns="http://w3.org">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 2.293a1 1 0 011.414 0l.707.707a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.414zm4 4.707a1 1 0 01-1 1h-1a1 1 0 110-2h1a1 1 0 011 1zM16.121 14.707a1 1 0 010 1.414l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM10 14a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zm-4.707-1.293a1 1 0 010 1.414l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 0zM2 10a1 1 0 011-1h1a1 1 0 110 2H3a1 1 0 01-1-1zm2.293-4.707a1 1 0 011.414-1.414l.707.707a1 1 0 01-1.414 1.414l-.707-.707zM10 5a5 5 0 100 10 5 5 0 000-10z">
                        </path>
                    </svg>
                    <!-- Moon Icon -->
                    <svg id="theme-toggle-moon-icon" class="hidden h-5 w-5 fill-current" viewBox="0 0 20 20"
                        xmlns="http://w3.org">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                </button>

                <!-- Mobile Hamburger Button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn"
                        class="text-gray-500 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white focus:outline-none rounded-full p-2 transition-colors">
                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Layer -->
        <div id="mobile-menu"
            class="hidden md:hidden mt-2 bg-white/95 dark:bg-neutral-900/95 backdrop-blur-md border border-gray-200 dark:border-neutral-800 rounded-2xl w-full shadow-xl overflow-hidden transition-all">
            <div class="px-4 py-4 space-y-1">
                <a href="<?php echo ($current_page == 'index.php') ? 'index.php' : '../index.php'; ?>"
                    class="block <?php echo ($current_page == 'index.php' || $current_page == '') ? 'text-brandPrimary bg-gray-100 dark:bg-white/5 font-semibold' : 'text-gray-600 dark:text-gray-400'; ?> text-sm font-medium py-2.5 px-4 rounded-xl transition-colors">Home</a>
                <a href="<?php echo ($current_page == 'index.php') ? '#about' : '../index.php#about'; ?>"
                    class="block text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-white/5 text-sm font-medium px-4 py-2.5 rounded-xl transition-colors">About</a>
                <a href="<?php echo ($current_page == 'index.php') ? '#skills' : '../index.php#skills'; ?>"
                    class="block text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-white/5 text-sm font-medium px-4 py-2.5 rounded-xl transition-colors">Skills</a>
                <a href="<?php echo ($current_page == 'index.php') ? '#services' : '../index.php#services'; ?>"
                    class="block text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-white/5 text-sm font-medium px-4 py-2.5 rounded-xl transition-colors">Services</a>
                <a href="<?php echo ($current_page == 'index.php') ? 'blogs/blogs.php' : 'blogs.php'; ?>"
                    class="block <?php echo ($current_page == 'blogs.php') ? 'text-brandPrimary bg-gray-100 dark:bg-white/5 font-semibold' : 'text-gray-600 dark:text-gray-400'; ?> text-sm font-medium py-2.5 px-4 rounded-xl transition-colors">Blog</a>
            </div>
        </div>
    </header>




    <!-- JavaScript logic to toggle mobile menu drawer and synchronize global theme states -->
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const header = document.getElementById('main-header');

        const themeToggleBtn = document.getElementById('theme-toggle');
        const themeToggleDarkIcon = document.getElementById('theme-toggle-moon-icon');
        const themeToggleLightIcon = document.getElementById('theme-toggle-sun-icon');
        
        const logoPill = document.getElementById('logo-pill');

        // Theme Icon Setup Logic
        if (document.documentElement.classList.contains('dark')) {
            themeToggleLightIcon.classList.remove('hidden');
            themeToggleDarkIcon.classList.add('hidden');
        } else {
            themeToggleDarkIcon.classList.remove('hidden');
            themeToggleLightIcon.classList.add('hidden');
        }

        // Click Logic for theme alterations
        if (themeToggleBtn) {
            themeToggleBtn.addEventListener('click', () => {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('color-theme', 'light');
                    themeToggleDarkIcon.classList.remove('hidden');
                    themeToggleLightIcon.classList.add('hidden');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('color-theme', 'dark');
                    themeToggleLightIcon.classList.remove('hidden');
                    themeToggleDarkIcon.classList.add('hidden');
                }
            });
        }

        // Drawer Menu Action Controllers
        if (mobileMenuBtn && mobileMenu) {
            mobileMenuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Scroll Tracking Handlers
        let lastScrollY = window.scrollY;

        window.addEventListener('scroll', () => {
            const currentScrollY = window.scrollY;

            // Hide/Show entire container bar matrix
            if (currentScrollY > lastScrollY && currentScrollY > 60) {
                header.classList.add('-translate-y-32', 'opacity-0');
                if (mobileMenu) mobileMenu.classList.add('hidden');
            } else {
                header.classList.remove('-translate-y-32', 'opacity-0');
            }

            // Reverse Evaluation Mode: Appends classes if user moves away from top
            if (currentScrollY > 10) {
                if (logoPill) logoPill.classList.add('scrolled');
            } else {
                if (logoPill) logoPill.classList.remove('scrolled');
            }

            lastScrollY = currentScrollY;
        });
    });
</script>




    <!-- Start of main wrapper block -->
    <section
        class="w-full bg-white dark:bg-[#22242a] min-h-screen py-12 md:py-20 flex flex-col items-center justify-center overflow-x-hidden flex-grow transition-colors duration-300">

        <!-- Main content inside this neutral card box -->
        <div
            class="w-full max-w-7xl bg-[#f0f2f5] dark:bg-[#2c2e35] rounded-xl p-8 sm:p-12 md:p-16 shadow-2xl border border-gray-200/50 dark:border-gray-800/50 transition-colors duration-300">