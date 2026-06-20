# Release Notes

## 🚀 v1.0.0 - Initial Production Release (June 2026)

We are proud to announce the initial production release of the **Dynamic PHP Portfolio & Blogging Engine** (v1.0.0). This release introduces a lightweight, zero-dependency personal website framework for developers, built with native PHP, Tailwind CSS, and HTMX.

---

### 🌟 Key Feature Highlights

1. **🤖 Integrated Groq AI Portfolio Assistant (`ai-backend.php`)**
   - Implements a floating interactive chatbot interface in the footer.
   - Connected directly to the Groq Chat Completions API utilizing the high-performance `llama-3.3-70b-versatile` model.
   - Tailored system prompts injected from `instruction.txt` for personal branding alignment.
   - Smart message windowing limiting memory history to the last 10 messages for token usage optimization.
   - Real-time client-side JS regex parser that formats phone numbers, emails, LinkedIn URLs, and GitHub links into clickable, interactive Tailwind badges.

2. **📰 Headless CMS Blogger Sync Engine (`blogger_api.php`)**
   - Utilizes Google Blogger REST API v3 to load articles dynamically on the portfolio landing page and article view page.
   - File-based cache management fallback (`post_cache/posts_cache.json`) with configurable lifetime values to ensure lightning-fast client loading and prevent Google API rate limits.
   - Resilient service design: serves stale/expired cache immediately in case of external network API downtime.

3. **🔗 Automatic DOM-Parsing Table of Contents (TOC) Generator**
   - Uses PHP's native `DOMDocument` and `DOMXPath` utilities to extract `h2`, `h3`, and `h4` tags from Blogger HTML payloads.
   - Injects unique anchors (`toc-section-N`) on the fly, rendering a clean, modern, and sticky jump-link list block before articles.

4. **⚡ Single-Page App Experience via HTMX**
   - Fully optimized with HTMX (`hx-boost`) in navigation bars to allow instant header page swapping without hard page reloads.
   - Native JS state synchronization prevents event listener duplication on page transitions.

5. **🎨 Premium Dark/Light Theme Switcher**
   - Features responsive dark/light color mode triggers saving preferences in `localStorage`.
   - Customized Tailwind CSS configuration utilizing Karla, Montserrat, and Open Sans typography with brand colors (`#009688` and `#0F172A`).

---

### 🔧 Configuration requirements

Please ensure your server configuration satisfies these criteria:
* **PHP Runtime**: version `8.x` or above.
* **PHP Extensions**: `curl` (for Groq API connectivity) and `libxml`/`dom` (for Table of Contents HTML structure parsing).
* **Web Server**: Apache Web Server with `mod_rewrite` enabled to execute routing rules in `.htaccess`.
* **System Environment Configuration**: A `.env` file copied from `.env.example`.

---

### 📝 Contributors

* **Hem B. Khatri** (@hemkhatri) — Lead Architect and Developer.
