        </div> <!-- Closes the max-w-7xl content container box opened in header.php -->
    </section> <!-- Closes the full screen section element opened in header.php -->

    <!-- Footer Component -->
    <footer class="bg-[#0b1120] text-gray-300 py-16 px-6 sm:px-12 border-t border-gray-800 mt-auto">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-12 gap-10 md:gap-8">
            
            <!-- Bio and Copyright Info Block -->
            <div class="md:col-span-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-[#00df81] text-2xl font-bold mb-4 tracking-wide">Hem B. Khatri</h2>
                    <p class="text-sm leading-relaxed text-gray-400 max-w-sm mb-8 md:mb-0">
                        Crafting high-performance digital solutions from the heart of the Himalayas. Let's build something exceptional together.
                    </p>
                </div>
                <p class="text-xs text-gray-500 mt-6 md:mt-auto">
                    &copy; <?php echo date("Y"); ?> Hem B. Khatri. Built with PHP & Tailwind.
                </p>
            </div>

            <!-- Dynamic File Destination Navigation Block -->
            <div class="md:col-span-3">
                <h3 class="text-white font-semibold mb-5 tracking-wide text-lg">Navigation</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="index.php" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-200">Home</a></li>
                    <li><a href="index.php#projects" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-200">Projects</a></li>
                    <li><a href="blogs.php" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-200">Blog</a></li>
                    <li><a href="index.php#contact" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-200">Contact</a></li>
                </ul>
            </div>

            <!-- External Social Platform Links Block -->
            <div class="md:col-span-3">
                <h3 class="text-white font-semibold mb-5 tracking-wide text-lg">Connect</h3>
                <ul class="space-y-3 text-sm text-gray-400">
                    <li><a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-200">LinkedIn</a></li>
                    <li><a href="https://github.com" target="_blank" rel="noopener noreferrer" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-200">GitHub</a></li>
                    <li><a href="https://twitter.com" target="_blank" rel="noopener noreferrer" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-200">Twitter</a></li>
                    <li><a href="mailto:youremail@domain.com" class="hover:text-white hover:translate-x-1 inline-block transition-transform duration-200">Email</a></li>
                </ul>
            </div>

        </div>
    </footer>

</body>
</html>
