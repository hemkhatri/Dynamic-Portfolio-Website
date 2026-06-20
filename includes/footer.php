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





<!-- Visual Floating Interface Container -->
<div class="fixed bottom-5 right-5 z-[99999] font-sans antialiased">

    <!-- 1. Floating AI Chat Logo Button -->
    <button id="chat-toggle-btn" onclick="toggleChatWindow()"
        class="flex h-14 w-14 items-center justify-center rounded-full bg-brandPrimary text-white shadow-lg hover:bg-opacity-90 transition-all duration-300 transform hover:scale-105 focus:outline-none">
        <!-- Replace this comment with your custom SVG directly -->
        <span id="toggle-icon-open" class="block">
            <!-- Example Chat Icon SVG -->
            <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 01.865-.501 48.172 48.172 0 003.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
            </svg>
        </span>
        <span id="toggle-icon-close" class="hidden">
            <!-- Close Icon SVG -->
            <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </span>
    </button>

    <!-- 2. Chat Window Panel (Hidden by default, styled according to your design parameters) -->
    <div id="ai-chat-window"
        class="hidden absolute bottom-20 right-0 w-[340px] sm:w-[360px] max-h-[500px] bg-white dark:bg-brandNeutral border border-slate-200 dark:border-slate-800 rounded-2xl shadow-2xl flex-col overflow-hidden transition-all duration-300 transform scale-95 origin-bottom-right">

        <!-- Header Section -->
        <div class="bg-brandPrimary p-4 text-white flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></div>
                <span class="font-headline font-bold tracking-wide text-sm">Ask My Portfolio AI</span>
            </div>
            <!-- Secondary minimize button in panel header -->
            <button onclick="toggleChatWindow()" class="text-white/80 hover:text-white focus:outline-none">
                <svg xmlns="http://w3.org" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"
                    class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
        </div>

        <!-- Chat Screen Messaging Area -->
        <div id="chat-screen"
            class="h-80 overflow-y-auto p-4 space-y-4 font-body text-sm bg-slate-50 dark:bg-slate-900/40">
            <div
                class="max-w-[85%] bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 p-3 rounded-2xl rounded-tl-none border border-slate-100 dark:border-slate-700/50 shadow-sm leading-relaxed">
                👋 Hello! I am HemLex's AI Assistant. How can I help you explore his portfolio, projects, or technical skills today?
            </div>
        </div>

        <!-- Input Actions Bar -->
        <div
            class="p-3 bg-white dark:bg-brandNeutral border-t border-slate-100 dark:border-slate-800 flex items-center gap-2">
            <input type="text" id="chat-input" placeholder="Type query..."
                class="flex-1 bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-slate-100 placeholder-slate-400 font-body text-sm rounded-xl px-4 py-2.5 border-none focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all">
            <button onclick="talkToAI()"
                class="bg-brandPrimary hover:bg-opacity-95 text-white font-headline text-xs font-semibold uppercase tracking-wider px-4 py-2.5 rounded-xl shadow-sm transition-all focus:outline-none">
                Send
            </button>
        </div>

    </div>
</div>

<!-- Integrated Functionality Script -->
<script>
    // 1. Detect if the user manually reloaded the current page view
    if (window.performance && window.performance.getEntriesByType) {
        const navigationEntries = window.performance.getEntriesByType('navigation');
        if (navigationEntries.length > 0 && navigationEntries[0].type === 'reload') {
            // Wipes out chat history memory instantly on manual refresh action
            sessionStorage.removeItem('portfolio_chat_history');
        }
    } else {
        // Safe structural fallback mapping for older browser viewports
        if (performance.navigation && performance.navigation.type === performance.navigation.TYPE_RELOAD) {
            sessionStorage.removeItem('portfolio_chat_history');
        }
    }

    // Unique key name for storing your portfolio session logs
    const STORAGE_KEY = 'portfolio_chat_history';

    // Run immediately when any page loads to restore state
    document.addEventListener('DOMContentLoaded', () => {
        restoreChatHistory();
    });

    // State management for toggle display
    function toggleChatWindow() {
        const windowEl = document.getElementById('ai-chat-window');
        const iconOpen = document.getElementById('toggle-icon-open');
        const iconClose = document.getElementById('toggle-icon-close');

        const isHidden = windowEl.classList.contains('hidden');

        if (isHidden) {
            windowEl.classList.remove('hidden');
            windowEl.classList.add('flex');
            setTimeout(() => {
                windowEl.classList.remove('scale-95');
                windowEl.classList.add('scale-100');
            }, 10);
            iconOpen.classList.add('hidden');
            iconClose.classList.remove('hidden');
            document.getElementById('chat-input').focus();
        } else {
            windowEl.classList.remove('scale-100');
            windowEl.classList.add('scale-95');
            setTimeout(() => {
                windowEl.classList.add('hidden');
                windowEl.classList.remove('flex');
            }, 150);
            iconOpen.classList.remove('hidden');
            iconClose.classList.add('hidden');
        }
    }

    /**
     * Converts plain text URLs and contacts into interactive, styled Tailwind badges
     */
    function formatAIResponse(text) {
        let formatted = text;

        // 1. Format LinkedIn Links into brand badges
        const linkedinRegex = /https?:\/\/(www\.)?linkedin\.com\/in\/([a-zA-Z0-9_-]+)\/?/gi;
        formatted = formatted.replace(linkedinRegex, (match, sub, username) => {
            return `<a href="${match}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 bg-[#0a66c2]/10 hover:bg-[#0a66c2]/20 text-[#0a66c2] font-semibold px-2 py-0.5 rounded-md transition-colors font-sans text-xs">
                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                ${username}
            </a>`;
        });

        // 2. Format GitHub Links into brand badges
        const githubRegex = /https?:\/\/(www\.)?github\.com\/([a-zA-Z0-9_-]+)\/?/gi;
        formatted = formatted.replace(githubRegex, (match, sub, username) => {
            return `<a href="${match}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 bg-slate-800 text-white hover:bg-slate-900 font-semibold px-2 py-0.5 rounded-md transition-colors font-sans text-xs dark:bg-slate-700 dark:hover:bg-slate-600">
                <svg class="w-3.5 h-3.5 fill-current" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                ${username}
            </a>`;
        });

        // 3. Make phone numbers clickable
        const phoneRegex = /(\+977[- ]?\d{10}|\b98\d{8}\b)/g;
        formatted = formatted.replace(phoneRegex, (match) => {
            return `<a href="tel:${match.replace(/[- ]/g, '')}" class="text-brandPrimary hover:underline font-semibold font-mono">${match}</a>`;
        });

        // 4. Make emails clickable
        const emailRegex = /([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6})/g;
        formatted = formatted.replace(emailRegex, (match) => {
            return `<a href="mailto:${match}" class="text-brandPrimary hover:underline font-semibold">${match}</a>`;
        });

        return formatted;
    }

    /**
     * Saves the current internal state of chat screen into sessionStorage
     */
    function saveChatHistory() {
        const screenEl = document.getElementById('chat-screen');
        if (screenEl) {
            sessionStorage.setItem(STORAGE_KEY, screenEl.innerHTML);
        }
    }

    /**
     * Restores history markup if it exists from previous navigation
     */
    function restoreChatHistory() {
        const savedData = sessionStorage.getItem(STORAGE_KEY);
        const screenEl = document.getElementById('chat-screen');
        if (savedData && screenEl) {
            screenEl.innerHTML = savedData;
            screenEl.scrollTop = screenEl.scrollHeight;
        }
    }

    async function talkToAI() {
        const inputEl = document.getElementById('chat-input');
        const screenEl = document.getElementById('chat-screen');
        const text = inputEl.value.trim();

        if (!text) return;

        // 1. Append User Bubble
        screenEl.innerHTML += `
        <div class="flex justify-end">
            <div class="max-w-[85%] bg-brandPrimary text-white p-3 rounded-2xl rounded-tr-none shadow-sm leading-relaxed">
                ${text}
            </div>
        </div>`;

        inputEl.value = '';
        screenEl.scrollTop = screenEl.scrollHeight;
        saveChatHistory();

        // 2. Build Chat Context History Array for Backend
        const historyArray = [];
        const chatBubbles = screenEl.querySelectorAll('#chat-screen > div');

        chatBubbles.forEach(bubble => {
            const isUser = bubble.classList.contains('justify-end');
            const textContent = bubble.textContent.trim();
            // Skip loading indicators
            if (textContent.includes("AI is processing...")) return;

            historyArray.push({
                role: isUser ? "user" : "assistant",
                content: textContent
            });
        });

        // 3. Show Loading Indicator
        const loading = document.createElement('div');
        loading.className = "flex gap-1 items-center text-slate-400 dark:text-slate-500 font-body text-xs italic mt-1 pl-2";
        loading.id = "ai-loading-placeholder";
        loading.innerHTML = `
        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 0ms"></div>
        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 150ms"></div>
        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 300ms"></div>
        <span class="ml-1">AI is processing...</span>`;
        screenEl.appendChild(loading);
        screenEl.scrollTop = screenEl.scrollHeight;

        try {
            // 4. Send BOTH the latest message AND the history array
            const res = await fetch('/hemkhatri.com.np/ai-backend.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    message: text,
                    history: historyArray // Passing whole conversation timeline
                })
            });

            const data = await res.json();
            removeLoadingState();

            const parsedReply = formatAIResponse(data.reply);

            // 5. Append AI Bubble
            screenEl.innerHTML += `
            <div class="flex justify-start">
                <div class="max-w-[85%] bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200 p-3 rounded-2xl rounded-tl-none border border-slate-100 dark:border-slate-700/50 shadow-sm leading-relaxed">
                    ${parsedReply}
                </div>
            </div>`;

            screenEl.scrollTop = screenEl.scrollHeight;
            saveChatHistory();
        } catch (e) {
            removeLoadingState();
            screenEl.innerHTML += `
            <div class="flex justify-start">
                <div class="max-w-[85%] bg-rose-50 text-rose-600 border border-rose-100 p-3 rounded-xl font-body text-xs">
                    Failed to retrieve portfolio insights. Please verify connection.
                </div>
            </div>`;
            screenEl.scrollTop = screenEl.scrollHeight;
        }
    }

    function removeLoadingState() {
        const loadingPlaceholder = document.getElementById('ai-loading-placeholder');
        if (loadingPlaceholder) {
            loadingPlaceholder.remove();
        }
    }

    document.getElementById('chat-input').addEventListener('keypress', function (e) {
        if (e.key === 'Enter') talkToAI();
    });
</script>











</div> <!-- Closes the max-w-7xl content container box opened in header.php -->
</section> <!-- Closes the full screen section element opened in header.php -->
</main> <!-- Closes #main-content -->
</body>

</html>