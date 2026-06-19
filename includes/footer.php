<!-- Fully Naked Minimalist Footer Component (Moved inside the main content container) -->
<footer class="w-full text-gray-500 dark:text-zinc-500 pt-16 pb-8 mt-auto">
    <div
        class="flex flex-col sm:flex-row items-center justify-between gap-6 text-xs font-medium tracking-wide border-t border-gray-200/20 dark:border-gray-800/40 pt-6">

        <!-- Left Side: Clean Unified Text Navigation Links -->
        <nav class="flex flex-wrap justify-center gap-x-4 gap-y-2 text-gray-600 dark:text-zinc-400">
            <a href="index.php"
                class="hover:text-brandPrimary dark:hover:text-white transition-colors duration-200">Home</a>
            <span class="text-gray-300 dark:text-zinc-700/40 select-none">/</span>
            <a href="blogs.php"
                class="hover:text-brandPrimary dark:hover:text-white transition-colors duration-200">Blog</a>
            <span class="text-gray-300 dark:text-zinc-700/40 select-none">/</span>
            <a href="https://github.com" target="_blank" rel="noopener noreferrer"
                class="hover:text-brandPrimary dark:hover:text-white transition-colors duration-200">GitHub</a>
            <span class="text-gray-300 dark:text-zinc-700/40 select-none">/</span>
            <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer"
                class="hover:text-brandPrimary dark:hover:text-white transition-colors duration-200">LinkedIn</a>
        </nav>

        <!-- Right Side: Copyright Statement -->
        <p class="text-center sm:text-right text-gray-400 dark:text-zinc-500">
            &copy; <?php echo date("Y"); ?> Hem B. Khatri
        </p>

    </div>
</footer>

</div> <!-- Closes the max-w-7xl content container box opened in header.php -->
</section> <!-- Closes the full screen section element opened in header.php -->
</main> <!-- Closes #main-content -->
</body>

</html>