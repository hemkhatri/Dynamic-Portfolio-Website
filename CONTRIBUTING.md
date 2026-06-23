# Contributing to This Repo

Thank you for choosing to contribute to the **Dynamic PHP Portfolio & Blogging Engine**! We welcome bug reports, feature suggestions, code contributions, and documentation improvements.

---

## 🛠️ Local Development Setup

To establish a local environment and start coding, follow these steps:

### 1. Prerequisites
- **PHP 8.x** installed locally.
- **Apache Web Server** (included in suites like [XAMPP](https://www.apachefriends.org/) or WAMP).
- **Git** version control tool.

### 2. Step-by-Step Installation
1. Clone the repository into your local Apache public root directory (e.g., `C:\xampp\htdocs\` on Windows):
   ```bash
   cd C:\xampp\htdocs
   git clone https://github.com/hemkhatri/Dynamic-Portfolio-Website.git
   ```
2. Navigate into the directory and create your environment configuration:
   ```bash
   cd Dynamic-Portfolio-Website
   cp .env.example .env
   ```
3. Populate your `.env` file with your credentials (see configuration details in `README.md`).
4. Ensure the cache directory (`post_cache/`) is writable by the web server:
   - *Linux/macOS*: `chmod 775 post_cache/`
   - *Windows*: Directory permissions are usually write-enabled by default under XAMPP.

---

## 🧪 Testing System Functionalities

Before submitting your pull request, verify that your changes did not break core integrations:

### 1. Blogger CMS API Connectivity
- Open the Apache server via the XAMPP Control Panel.
- Access the Blogger test harness in your web browser: `http://localhost/Dynamic-Portfolio-Website/test.php`.
- Ensure it successfully returns posts from Google Blogger API or pulls from the local `post_cache/posts_cache.json` without throwing connection faults.

### 2. AI Assistant Integration
- Open the home page and click on the floating **Portfolio AI** button at the bottom-right corner.
- Type a test query (e.g., "What is HemLex's email?") and verify the assistant responds with data populated from `instruction.txt`.
- Check that the returned links (GitHub, LinkedIn, Email) are formatted correctly into interactive badges by the client-side JavaScript regex parser inside `includes/footer.php`.

### 3. Server URL Rewriting
- Navigate to a blog post from the index page or articles archive page.
- Verify that your URL rewrites cleanly to `http://localhost/Dynamic-Portfolio-Website/articles/your-blog-slug-name` (this tests the Apache `.htaccess` rewriting rules).

---

## 🌿 Git Branch & PR Workflow

We follow a structured branch naming convention and pull request review process:

### 1. Branch Naming Conventions
Always create a branch from `main` using one of the prefixes below:
- **Features**: `feature/your-feature-name`
- **Bug Fixes**: `bugfix/issue-description`
- **Documentation**: `docs/update-info`
- **Refactoring**: `refactor/component-name`

Example command:
```bash
git checkout -b feature/add-darkmode-persistence
```

### 2. Commit Message Guidelines
Write clean, concise, and descriptive commit messages following the Conventional Commits specification:
- `feat: add Google Blogger caching configuration`
- `fix: resolve DOMDocument UTF-8 font conversion error`
- `docs: update setup instructions in README`

### 3. Submitting Pull Requests
1. Push your branch to your forked repository:
   ```bash
   git push origin feature/your-feature-name
   ```
2. Open a Pull Request (PR) against our upstream `main` branch.
3. Provide a clear description of the problem solved, testing steps taken, and screenshots if you modified any visual layouts.
4. An automated release workflow will categorize your PR based on GitHub labels (`feature`, `bug`, `documentation`, `chore`).
