# 🚀 Dynamic PHP Portfolio Website & Headless Blogging Engine

[![PHP Version](https://img.shields.io/badge/PHP-8.x-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Groq AI](https://img.shields.io/badge/Groq%20AI-Llama%203.3-orange?style=for-the-badge&logo=openai&logoColor=white)](https://groq.com/)
[![Blogger API](https://img.shields.io/badge/Blogger%20API-v3-orange?style=for-the-badge&logo=google&logoColor=white)](https://developers.google.com/blogger)
[![HTMX](https://img.shields.io/badge/HTMX-1.x-3D72D6?style=for-the-badge&logo=htmx&logoColor=white)](https://htmx.org/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-06B6D4?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com/)
[![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)](LICENSE)

A high-performance, lightweight, and modern **dynamic PHP portfolio website and headless blogging engine** tailored for software engineers, web developers, and full-stack creators. Designed with high-end glassmorphism, responsive animations, and a single-page application (SPA) feel via HTMX, this template requires zero heavy JavaScript frameworks.

🎯 **Live Demo:** [hemkhatri.com.np](https://hemkhatri.com.np)

---

## 📸 Project Previews & Screenshots

### 🖥️ Desktop View 
**Dark Theme**
<img width="1903" height="1079" alt="Desktop Projects & Skills Grid | Dark Theme" src="https://github.com/user-attachments/assets/aa7247d4-e577-435b-93a7-12a86ff10e14" />

**Light Theme**
<img width="1902" height="1079" alt="Desktop Projects & Skills Grid | Light Theme" src="https://github.com/user-attachments/assets/8bf32cc5-22b6-4304-8c7d-9f78c92d618d" />

### 📱 Mobile View (Responsive & Adaptive Layouts)
<div align="center">
  <img width="359" height="740" alt="Mobile View - Dark" src="https://github.com/user-attachments/assets/69b2f131-5345-4176-ace8-16c3d4303f58" style="margin-right: 10px;" />
  <img width="359" height="737" alt="Mobile View - Light" src="https://github.com/user-attachments/assets/5422d753-06c3-479a-9bbc-2a11d4ae6e4e" />
</div>

---

## 🔥 Key Technical Features

* **🤖 Groq-Powered AI Assistant (`backend/ai-backend.php`)**
  * Integrated chatbot window loaded directly on the frontend using vanilla Javascript.
  * Backend cURL integration with Groq API utilizing the high-performance `llama-3.3-70b-versatile` model.
  * Injects specialized personal background information from `instruction.txt` to align AI responses with your resume facts.
  * Optimizes memory and token consumption by sending only the last 10 messages from session storage.
  * Native regex parsers convert phone numbers, email addresses, and LinkedIn/GitHub profiles into interactive, clickable UI badges.

* **📰 Headless CMS Blogger Integration (`backend/blogger_post_handler.php`)**
  * Connects to Google Blogger REST API v3 to pull articles dynamically.
  * Local file-caching architecture (`post_cache/posts_cache.json`) with customizable expiry rules to bypass rate-limiting and decrease load latency.
  * Absolute path resolution to prevent duplicate cache directories and ensure seamless loading across root and nested article detail sub-pages.
  * Automated emergency fallback to serve stale cache logs if Google Blogger service is unreachable.
  * Helper functions convert post titles into clean, search-engine-friendly SEO slugs.

* **🔗 Dynamic Table of Contents (TOC) Builder**
  * Parses HTML post bodies returned from Blogger using PHP `DOMDocument` and `DOMXPath`.
  * Dynamically detects heading levels (`h2`, `h3`, `h4`) and injects matching anchor ID elements (`toc-section-N`) on page render.
  * Builds a styled navigation block table of contents nested based on heading depths.

* **⚡ Ultra-Fast SPA Navigation (HTMX)**
  * Native integration with HTMX (`hx-boost` and `hx-target`) in navigation controllers.
  * Pages swap content modules instantly within `<main id="main-content">` without hard browser page reloads.

* **🎨 Sleek Dark & Light Themes**
  * Built using custom Tailwind CSS configs (Karla, Montserrat, and Open Sans fonts).
  * Class-based dark mode control persisted in `localStorage`.
  * Visual glassmorphism effects (`backdrop-blur-md` and alpha borders) on header components active on scroll down.

* **🔍 Dynamic Per-Page SEO Metadata Engine (`includes/header.php`)**
  * Every page declares its own `$pageMeta[]` array before the `header.php` include — no global config needed.
  * Automatically generates `<title>`, `meta description`, `meta keywords`, `robots`, and `link rel="canonical"` for each route.
  * Full **Open Graph** (`og:title`, `og:description`, `og:image`, `og:url`, `og:type`) and **Twitter Card** (`summary_large_image`) tags injected on every page.
  * Inserts **JSON-LD Structured Data** appropriate to the page type: `Person` schema on the home page, and `TechArticle` schema on individual blog posts — including `datePublished`, `author`, `publisher`, and `mainEntityOfPage` fields.
  * Falls back gracefully to production-ready site-level defaults when a page does not set `$pageMeta`.

---

## 🛠️ Technology Stack Architecture

* **Backend Engine**: PHP 8.x (Native execution, zero composer dependencies)
* **Frontend Styling**: Tailwind CSS v3 (loaded via CDN with customized script config), Vanilla CSS Custom Layouts
* **Navigation Pipeline**: HTMX (AJAX Boost routing)
* **Local Development**: Apache / XAMPP on Windows

---

## 📦 File System Overview

```text
📦 Dynamic-Portfolio-Website
 ├── .github/
 │   ├── workflows/
 │   │   └── auto-release.yml   # Automatic GitHub Action to draft and tag releases
 │   └── release.yml            # Categorizes merged Pull Requests for release logs
 ├── articles/                  # Dynamic blogging engine components
 │   ├── articles.php           # Dynamic article archive listing Blogger feeds
 │   └── post.php               # Fetches and renders individual post details from Blogger
 ├── assets/                    # Structural layout static graphics and media
 │   ├── favicon/               # Platform icons and profile thumbnails
 │   ├── icons/                 # System SVGs (AI bot indicators, user profiles)
 │   ├── images/                # Local gallery landscapes
 │   └── screenshots/           # Preview illustrations
 ├── backend/                   # Core server logic modules
 │   ├── ai-backend.php         # Groq API cURL pipeline and message memory handler
 │   └── blogger_post_handler.php # Blogger API data sync, absolute cache controller & TOC parser
 ├── includes/                  # Shared header and footer layouts
 │   ├── footer.php             # Chatbot layout structure, AJAX scripts & regex parsers
 │   └── header.php             # Logo pill, navigation links & theme toggle
 ├── post_cache/                # Absolute Local Blogger JSON caches (Automatically created)
 ├── .env.example               # Reference environmental variables file
 ├── .gitignore                 # Tailor-made Git ignore rules
 ├── .htaccess                  # Apache URL rewrite router for clean slugs
 ├── about.php                  # Professional portfolio bio layout
 ├── index.php                  # Landing portfolio home page with Blogger integration
 ├── instruction.txt            # Facts context file injected into AI chatbot system
 ├── LICENSE                    # MIT Open-Source Authorization
 ├── README.md                  # Project Documentation
 └── test.php                   # Developer connection check dashboard
```

---

## ⚙️ Environment Configuration Options

Copy the `.env.example` file and create a `.env` file in the root folder of the project.

| Variable Name | Required | Default | Description |
| :--- | :---: | :---: | :--- |
| `GROQ_API_KEY` | **Yes** | *None* | Your Groq API access token. Get one from [Groq Console](https://console.groq.com/keys). |
| `BLOG_ID` | **Yes** | *None* | Unique Blogger ID. Found in your Blogger dashboard URL: `blogger.com/blog/themes/<BLOG_ID>`. |
| `API_KEY` | **Yes** | *None* | Google API access key. Generate this from your [Google Cloud Console](https://console.cloud.google.com/) Credentials panel (Blogger API v3 must be enabled). |
| `CACHE_EXPIRY` | No | `900` | The caching threshold in seconds (e.g., `900` = 15 minutes). |
| `CACHE_DIR` | No | `"post_cache/"` | Relative directory path where cached json files are stored. |

---

## 🚀 Step-by-Step Beginner Setup Guide (XAMPP)

Follow this detailed, step-by-step developer setup guide to run this project on a local Windows machine.

### Step 1: Install XAMPP
1. Download **XAMPP for Windows** from the [Apache Friends Official Website](https://www.apachefriends.org/).
2. Run the installer. Choose standard installation settings.
3. Open the **XAMPP Control Panel** from your Windows Start Menu.
4. Click the **Start** button next to **Apache** to boot the local web server. The status light will turn green.

### Step 2: Clone the Project
1. Open your Git command line (Git Bash) or Windows PowerShell.
2. Navigate into the XAMPP public web directory:
   ```bash
   cd C:\xampp\htdocs
   ```
3. Clone this repository directly into a new folder:
   ```bash
   git clone https://github.com/hemkhatri/Dynamic-Portfolio-Website.git
   ```

### Step 3: Configure Environment Configurations
1. Go into the folder you just cloned:
   ```bash
   cd Dynamic-Portfolio-Website
   ```
2. Copy the example configurations into a new secret `.env` file:
   ```bash
   copy .env.example .env
   ```
   *(On Git Bash / macOS, use: `cp .env.example .env`)*
3. Open the `.env` file in your preferred text editor (VS Code, Notepad, etc.) and add your credentials:
   ```env
   GROQ_API_KEY="gsk_your_groq_api_token_here"
   BLOG_ID="1234567890123456789"
   API_KEY="AIzaSyYourGoogleApiKeyHere"
   CACHE_EXPIRY=900
   CACHE_DIR="post_cache/"
   ```

### Step 4: Verify Folder Name and Apache Redirects
1. Check the folder name in `C:\xampp\htdocs`. It should be exactly `Dynamic-Portfolio-Website` or match what you choose.
2. Open the `.htaccess` file in the root folder of the project.
3. Locate line 5:
   ```apache
   RewriteBase /hemkhatri.com.np/
   ```
4. If you named your folder `Dynamic-Portfolio-Website`, change this line to match your directory name:
   ```apache
   RewriteBase /Dynamic-Portfolio-Website/
   ```
5. Save the file. This ensures that dynamic clean articles paths (`/articles/slug-name`) resolve correctly without producing 404 errors.

### Step 5: Test and Boot the Application
1. Launch your internet web browser (Google Chrome, Firefox, Edge, etc.).
2. In the URL address bar, navigate to the local testing dashboard:
   ```text
   http://localhost/Dynamic-Portfolio-Website/test.php
   ```
3. If everything is configured correctly, this dashboard will output:
   * **Blogger API Feed Testing Panel**
   * **Successfully Loaded X Posts** (it lists titles and slugs).
4. If there is a configuration error, the script will output a descriptive error block indicating what failed (e.g. missing API keys or wrong Blog ID).
5. Once test success is verified, open the website homepage:
   ```text
   http://localhost/Dynamic-Portfolio-Website/index.php
   ```

---

## 🧪 Local Testing & Verification

For quality assurance, run the following verification steps:
1. **Chatbot Operations**: Ask the AI Assistant, "What is HemLex's email?". It should immediately respond with `hemlexofficial@gmail.com` based on your `instruction.txt` rules.
2. **Cache Refresh**: Check the `post_cache/` folder in your project root. A `posts_cache.json` file should be generated after loading the homepage or `test.php`.
3. **Responsive Testing**: Right-click the browser page, choose **Inspect**, and toggle device mode to view the layout on iPhone or iPad models. Verify that the tilted photo gallery stack behaves responsively.

---

## 📄 Open Source License

This codebase is distributed under the **MIT License**. Check out the [LICENSE](LICENSE) file for authorization permissions and details.
