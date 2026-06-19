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
    <link href="https://googleapis.com/css2?family=Karla:ital,wght@0,200..800;1,200..800&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Tailwind Configuration -->
    <script>
        tailwind.config = {
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
</head>

<body class="bg-black min-h-screen font-body flex flex-col">

    <!-- Header Component -->
    <header class="bg-brandNeutral w-full shadow-sm shadow-gray-900/20 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-24">

                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="<?php echo ($current_page == 'index.php') ? 'index.php' : '../index.php'; ?>" class="font-headline font-bold text-white text-2xl tracking-wide">
                        Hem B. Khatri
                    </a>
                </div>

                <!-- Desktop Navigation (Fixed Relative Path Fallbacks) -->
                <nav class="hidden md:flex space-x-8 items-center">
                    <!-- Home Link -->
                    <a href="<?php echo ($current_page == 'index.php') ? 'index.php' : '../index.php'; ?>" class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'text-brandPrimary border-b-2 border-brandPrimary pb-1' : 'text-gray-400 hover:text-brandPrimary'; ?> font-medium transition-colors duration-200">Home</a>
                    
                    <!-- Internal anchor scroll links -->
                    <a href="<?php echo ($current_page == 'index.php') ? '#about' : '../index.php#about'; ?>" class="text-gray-400 hover:text-brandPrimary font-medium transition-colors duration-200">About</a>
                    <a href="<?php echo ($current_page == 'index.php') ? '#skills' : '../index.php#skills'; ?>" class="text-gray-400 hover:text-brandPrimary font-medium transition-colors duration-200">Skills</a>
                    <a href="<?php echo ($current_page == 'index.php') ? '#services' : '../index.php#services'; ?>" class="text-gray-400 hover:text-brandPrimary font-medium transition-colors duration-200">Services</a>
                    
                    <!-- Blog Link -->
                    <a href="<?php echo ($current_page == 'index.php') ? 'blogs/blogs.php' : 'blogs.php'; ?>" class="<?php echo ($current_page == 'blogs.php') ? 'text-brandPrimary border-b-2 border-brandPrimary pb-1' : 'text-gray-400 hover:text-brandPrimary'; ?> font-medium transition-colors duration-200">Blog</a>
                </nav>

                <!-- CTA -->
                <div class="hidden md:flex items-center">
                    <a href="<?php echo ($current_page == 'index.php') ? '#contact' : '../index.php#contact'; ?>" class="bg-brandPrimary text-brandNeutral font-semibold px-6 py-2.5 rounded hover:bg-green-500 transition-colors duration-200 shadow-md shadow-brandPrimary/20">
                        Get in Touch
                    </a>
                </div>

                <!-- Mobile Hamburger -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-gray-300 hover:text-white focus:outline-none focus:ring-2 focus:ring-brandPrimary rounded p-2">
                        <svg class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden bg-[#151f38] border-t border-gray-800 absolute w-full left-0 z-50 shadow-xl">
            <div class="px-4 pt-4 pb-6 space-y-2">
                <a href="<?php echo ($current_page == 'index.php') ? 'index.php' : '../index.php'; ?>" class="block <?php echo ($current_page == 'index.php' || $current_page == '') ? 'text-brandPrimary border-l-4 border-brandPrimary bg-brandNeutral/50 pl-3' : 'text-gray-400 hover:text-brandPrimary pl-3'; ?> font-medium py-2 rounded-r transition-colors">Home</a>
                <a href="<?php echo ($current_page == 'index.php') ? '#about' : '../index.php#about'; ?>" class="block text-gray-400 hover:text-brandPrimary hover:bg-brandNeutral/50 font-medium pl-3 py-2 rounded-r transition-colors">About</a>
                <a href="<?php echo ($current_page == 'index.php') ? '#skills' : '../index.php#skills'; ?>" class="block text-gray-400 hover:text-brandPrimary hover:bg-brandNeutral/50 font-medium pl-3 py-2 rounded-r transition-colors">Skills</a>
                <a href="<?php echo ($current_page == 'index.php') ? '#services' : '../index.php#services'; ?>" class="block text-gray-400 hover:text-brandPrimary hover:bg-brandNeutral/50 font-medium pl-3 py-2 rounded-r transition-colors">Services</a>
                <a href="<?php echo ($current_page == 'index.php') ? 'blogs/blogs.php' : 'blogs.php'; ?>" class="block <?php echo ($current_page == 'blogs.php') ? 'text-brandPrimary border-l-4 border-brandPrimary bg-brandNeutral/50 pl-3' : 'text-gray-400 hover:text-brandPrimary pl-3'; ?> font-medium py-2 rounded-r transition-colors">Blog</a>
                <div class="mt-6 pt-4 border-t border-gray-800">
                    <a href="<?php echo ($current_page == 'index.php') ? '#contact' : '../index.php#contact'; ?>" class="block w-full text-center bg-brandPrimary text-brandNeutral font-semibold px-6 py-3 rounded hover:bg-green-500 transition-colors duration-200">
                        Get in Touch
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- JavaScript logic to toggle mobile hamburger menu drawer -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', () => {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>

    <!-- Start of main wrapper block -->
    <section class="w-full bg-[#22242a] min-h-screen py-12 md:py-20 flex flex-col items-center justify-center overflow-x-hidden flex-grow">
        <!-- Main content inside this neutral card box -->
        <div class="w-full max-w-7xl bg-[#2c2e35] rounded-xl p-8 sm:p-12 md:p-16 shadow-2xl border border-gray-800/50">
