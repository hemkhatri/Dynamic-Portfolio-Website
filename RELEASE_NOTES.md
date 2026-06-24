# Release Notes

## 🔍 v1.0.5 — Dynamic Per-Page SEO Metadata Engine (June 2026)

This release introduces a production-grade, page-aware SEO metadata system fully integrated into `header.php`. Every route now emits unique, high-quality search metadata without touching shared layout logic.

### 🌟 Key Changes in v1.0.5

1. **🔍 Dynamic `$pageMeta[]` API in `header.php`**
   * Added a centralized metadata resolution block inside `<head>` that reads a per-page `$pageMeta[]` array and falls back to production-safe site-level defaults when no custom values are provided.
   * Emits `<title>`, `meta description`, `meta keywords`, `meta author`, `meta robots`, and `link rel="canonical"` for every page.

2. **📣 Open Graph & Twitter Card Tags**
   * Every page now emits a full Open Graph block (`og:type`, `og:url`, `og:title`, `og:description`, `og:image`, `og:image:alt`, `og:site_name`, `og:locale`).
   * Twitter Card `summary_large_image` tags are injected on every page automatically, with `twitter:creator` and `twitter:site` pointing to `@hemkhatri`.

3. **📐 JSON-LD Structured Data per Route**
   * `index.php` (Home) — emits a `Person` schema with `jobTitle`, `worksFor`, `address`, and `sameAs` social profile links.
   * `articles/articles.php` (Article index) — emits site-level `website` metadata with article-focused keywords.
   * `articles/post.php` (Individual posts) — emits a fully dynamic `TechArticle` schema populated with `headline`, `description`, `image`, `datePublished`, `dateModified`, `author`, `publisher`, `mainEntityOfPage`, `articleSection`, and `url` fields from the live Blogger post data.
   * `projects/projects.php` (Portfolio) — emits `website`-type metadata with project-focused keywords.

4. **🛡️ SPA Header Alignment**
   * `X-SPA-Title` response header now uses the same `$meta_title` variable as the full-page render, keeping SPA navigation titles consistent with static crawl titles.

5. **📄 Documentation Updates**
   * `README.md` updated with a new *Dynamic Per-Page SEO Metadata Engine* feature bullet under Key Technical Features.
   * `RELEASE_NOTES.md` updated with this entry.

---

## 🚀 v1.0.4 - Blogger API Fixes & Folder Restructuring (June 2026)

This release addresses critical bugs in the Blogger API caching layers, resolves relative path mismatches across root and sub-pages, corrects broken navigation links, and structures all core scripts into a dedicated directory.

### 🌟 Key Changes in v1.0.4

1. **🔧 Fixed Blogger API Caching & Path Resolutions**
   * Solved `.env` loading failure by updating the environment loader path inside `backend/blogger_post_handler.php` to reference the root folder dynamically.
   * Shifted `CACHE_DIR` to use an absolute path (`dirname(__DIR__) . '/' ...`), preventing duplicate cache directories and ensuring cache availability on detail pages.
   * Updated `test.php` and `articles/post.php` to use the correct `backend/blogger_post_handler.php` dependency instead of the deprecated `blogger_api.php`.

2. **🔗 Fixed blogs.php Dead Links & URL Routing**
   * Defined a dynamic `$path_prefix` in `includes/header.php` and `includes/footer.php` to handle navigation links and SVG assets automatically based on page nesting.
   * Replaced all deprecated root links to `blogs.php` with the correct routing path to `articles/articles.php`.
   * Updated the JavaScript rendering in `articles/articles.php` to link directly to clean SEO URLs (slugs) instead of raw queries.
   * Made `articles/articles.php` fetch and render dynamic Blogger posts directly, completely replacing static mock data.

3. **🛡️ Added SECURITY.md Policy**
   * Created a formal security policy defining vulnerability disclosure steps, reporting emails, and SLAs.

---

## 🚀 v1.0.3 - UI/UX Refinement & Theme Switcher (June 2026)

This release contains appearance updates, bug fixes, and dynamic features to enhance the overall look and feel of the website.

### 🌟 Key Changes in v1.0.3
* Added a dynamic navigation bar with scroll-active glassmorphism styling (`backdrop-blur-md`).
* Integrated a day/night theme toggle with state persistence in `localStorage`.
* Refined mobile view responsiveness, ensuring correct alignment on small screens.
* Corrected element layouts and color profiles for optimal readability.

---

## 🚀 v1.0.1 - Documentation Enhancements (June 2026)

* Enhanced repository `README.md` with step-by-step setup guides for local Apache servers.
* Clarified environment variable configurations and fallback parameters.

---

## 🚀 v1.0.0 - Initial Production Release (June 2026)

We are proud to announce the initial production release of the **Dynamic PHP Portfolio & Blogging Engine** (v1.0.0). This release introduces a lightweight, zero-dependency personal website framework for developers, built with native PHP, Tailwind CSS, and HTMX.

### 🌟 Key Feature Highlights
* **🤖 Integrated Groq AI Portfolio Assistant**: Floating chat window loaded via cURL with Llama 3.3.
* **📰 Headless CMS Blogger Sync Engine**: Dynamic Blogger API integration with file-based cache fallbacks.
* **🔗 Dynamic TOC Generator**: Native PHP parsing of Blogger article headers into dynamic skip-links.
* **⚡ Single-Page App Experience**: Boosted navigation using HTMX for seamless page transitions.
