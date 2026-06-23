<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Authentication Configuration
define('ADMIN_USER', 'admin');
define('ADMIN_PASS', 'admin');

$error = '';
$success = '';

// Database Connectivity Settings
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$db_name = 'portfolio_db';

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_user, $db_pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("<p style='color:red;'>Database connection failed: " . htmlspecialchars($e->getMessage()) . "</p>");
}

// Handle logout action request
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    $_SESSION['admin_logged_in'] = false;
    session_destroy();
    header("Location: admin.php");
    exit;
}

// Process login authentication form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === ADMIN_USER && $password === ADMIN_PASS) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $error = 'Invalid administrative username or access password credentials.';
    }
}

$is_logged_in = $_SESSION['admin_logged_in'] ?? false;

// Process Project Form Submissions (Create & Update)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project_submit']) && $is_logged_in) {
    // Determine category text structure assignment
    $category = trim($_POST['category_select'] ?? '');
    if ($category === 'NEW' || empty($category)) {
        $category = trim($_POST['category_custom'] ?? 'Web Development');
    }

    $title = trim($_POST['title'] ?? '');
    $description = trim($_POST['description'] ?? '');
    $key_contribution = trim($_POST['key_contribution'] ?? '');
    $conclusion = trim($_POST['conclusion'] ?? '');
    $languages_used = trim($_POST['languages_used'] ?? '');
    $project_media = trim($_POST['project_media'] ?? '');
    $github_link = trim($_POST['github_link'] ?? null);
    $live_demo_link = trim($_POST['live_demo_link'] ?? null);
    $date_started = $_POST['date_started'] ?? date('Y-m-d');
    $date_finished = !empty($_POST['date_finished']) ? $_POST['date_finished'] : null;
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $project_id = $_POST['project_id'] ?? '';

    if (empty($title) || empty($description) || empty($languages_used)) {
        $error = 'Please fill out all required fields (Title, Description, and Tech Stack).';
    } else {
        try {
            if (!empty($project_id)) {
                // Update mode
                $sql = "UPDATE projects SET 
                            title = :title, category = :category, description = :description, 
                            key_contribution = :key_contribution, conclusion = :conclusion, 
                            languages_used = :languages_used, project_media = :project_media, 
                            github_link = :github_link, live_demo_link = :live_demo_link, 
                            date_started = :date_started, date_finished = :date_finished, 
                            is_featured = :is_featured 
                        WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':title' => $title, ':category' => $category, ':description' => $description,
                    ':key_contribution' => $key_contribution, ':conclusion' => $conclusion,
                    ':languages_used' => $languages_used, ':project_media' => $project_media,
                    ':github_link' => !empty($github_link) ? $github_link : null,
                    ':live_demo_link' => !empty($live_demo_link) ? $live_demo_link : null,
                    ':date_started' => $date_started, ':date_finished' => $date_finished,
                    ':is_featured' => $is_featured, ':id' => $project_id
                ]);
                $success = "Portfolio entry records updated successfully!";
            } else {
                // Insert mode
                $sql = "INSERT INTO projects (title, category, description, key_contribution, conclusion, languages_used, project_media, github_link, live_demo_link, date_started, date_finished, is_featured) 
                        VALUES (:title, :category, :description, :key_contribution, :conclusion, :languages_used, :project_media, :github_link, :live_demo_link, :date_started, :date_finished, :is_featured)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':title' => $title, ':category' => $category, ':description' => $description,
                    ':key_contribution' => $key_contribution, ':conclusion' => $conclusion,
                    ':languages_used' => $languages_used, ':project_media' => $project_media,
                    ':github_link' => !empty($github_link) ? $github_link : null,
                    ':live_demo_link' => !empty($live_demo_link) ? $live_demo_link : null,
                    ':date_started' => $date_started, ':date_finished' => $date_finished,
                    ':is_featured' => $is_featured
                ]);
                $success = "Project metadata cataloged and uploaded successfully!";
            }
        } catch (PDOException $e) {
            $error = "Database operation halted: " . $e->getMessage();
        }
    }
}

// Handle deleting single database index parameters
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id']) && $is_logged_in) {
    $del_id = (int)$_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM projects WHERE id = :id");
    $stmt->execute([':id' => $del_id]);
    $success = "Project metadata entry dropped safely.";
}

// Gathering Context Profiles for Interface UI Blocks
$projects = [];
$categories = [];
$all_tags = [];

if ($is_logged_in) {
    $projects = $pdo->query("SELECT * FROM projects ORDER BY date_started DESC")->fetchAll();
    
    // Dynamically retrieve unique categories for selection controls
    foreach ($projects as $p) {
        if (!empty($p['category']) && !in_array($p['category'], $categories)) {
            $categories[] = $p['category'];
        }
        if (!empty($p['languages_used'])) {
            $tags = explode(',', $p['languages_used']);
            foreach ($tags as $t) {
                $trimmed = trim($t);
                if (!empty($trimmed) && !in_array($trimmed, $all_tags)) {
                    $all_tags[] = $trimmed;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Console — Hem B. Khatri</title>
    <link href="https://fonts.googleapis.com/css2?family=Karla:wght@400;700&family=Montserrat:wght@400;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: { brandPrimary: '#009688', brandNeutral: '#0F172A' },
                    fontFamily: { sans: ['"Montserrat"', 'sans-serif'], headline: ['"Karla"', 'sans-serif'], body: ['"Open Sans"', 'sans-serif'] }
                }
            }
        }
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-brandNeutral min-h-screen font-body text-gray-800 dark:text-gray-100 transition-colors duration-300 flex flex-col items-center p-4 py-12">

    <?php if (!$is_logged_in): ?>
        <div class="w-full max-w-md bg-white dark:bg-slate-900 shadow-xl border border-gray-200/60 dark:border-slate-800/80 rounded-2xl p-8 transition-all my-auto">
            <div class="text-center mb-6">
                <h1 class="font-headline font-bold text-2xl tracking-tight text-brandPrimary">Portfolio Console</h1>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Authenticate credentials to manage database matrices.</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="mb-4 bg-red-50 dark:bg-red-950/30 border border-red-500/20 text-red-600 dark:text-red-400 text-xs py-2.5 px-3 rounded-xl"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>

            <form method="POST" action="admin.php" class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Username</label>
                    <input type="text" name="username" required autocomplete="off" class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-sm px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all">
                </div>
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Access Token Password</label>
                    <input type="password" name="password" required class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-sm px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all">
                </div>
                <button type="submit" name="login_submit" class="w-full bg-brandPrimary hover:bg-teal-600 text-white font-semibold text-sm py-3 px-4 rounded-xl shadow-md shadow-brandPrimary/10 transition-colors mt-2">Initialize Session</button>
            </form>
        </div>
    <?php else: ?>
        <div class="w-full max-w-5xl flex flex-col gap-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center bg-white dark:bg-slate-900 border border-gray-200/60 dark:border-slate-800/80 p-6 rounded-2xl shadow-md gap-4">
                <div>
                    <h1 class="font-headline font-bold text-2xl text-gray-900 dark:text-white">Control Center Workspace</h1>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Logged into active session profile root layer.</p>
                </div>
                <a href="admin.php?action=logout" class="bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-gray-600 dark:text-gray-300 font-medium text-xs py-2 px-4 rounded-xl transition-all">Terminate Session</a>
            </div>

            <?php if (!empty($error)): ?>
                <div class="bg-red-50 dark:bg-red-950/30 border border-red-500/20 text-red-600 dark:text-red-400 text-sm py-3 px-4 rounded-xl"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <div class="bg-emerald-50 dark:bg-emerald-950/30 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-sm py-3 px-4 rounded-xl"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>

            <div class="bg-white dark:bg-slate-900 shadow-xl border border-gray-200/60 dark:border-slate-800/80 rounded-2xl p-6 md:p-8 tracking-wide">
                <h2 id="form-heading" class="font-headline font-bold text-xl text-gray-900 dark:text-white mb-6 border-b border-gray-100 dark:border-slate-800 pb-3">Add New Portfolio Project</h2>
                
                <form method="POST" action="admin.php" id="project-main-form" class="space-y-5">
                    <input type="hidden" name="project_id" id="project_id" value="">

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Project Title *</label>
                            <input type="text" name="title" id="form_title" required placeholder="e.g., Core Engine Application" class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-sm px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Category Stack Group</label>
                            <select name="category_select" id="category_select" onchange="toggleCategoryInput(this.value)" class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-sm px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all">
                                <option value="NEW">[ + Add New Category Group ]</option>
                                <?php foreach ($categories as $cat): ?>
                                    <option value="<?php echo htmlspecialchars($cat); ?>"><?php echo htmlspecialchars($cat); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <input type="text" name="category_custom" id="category_custom" placeholder="Type new layout category group..." class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-sm px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all mt-2">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">System Architecture Description *</label>
                        <textarea name="description" id="form_description" rows="4" required placeholder="Describe system design parameters, data layer maps, and frameworks..." class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-sm p-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all font-body leading-relaxed"></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Key Contribution (Optional)</label>
                            <input type="text" name="key_contribution" id="form_key_contribution" placeholder="Optimized database execution metrics..." class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-sm px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Project Takeaway (Optional)</label>
                            <input type="text" name="conclusion" id="form_conclusion" placeholder="Reduced execution intervals by 40%..." class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-sm px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Languages Used & Badges *</label>
                        <input type="hidden" name="languages_used" id="languages_used" value="">
                        
                        <div class="flex flex-wrap gap-2 p-3 bg-gray-50 dark:bg-slate-950 rounded-xl border border-gray-200 dark:border-slate-800 mb-2 min-h-[46px]" id="pill-badges-container">
                            </div>
                        
                        <div class="flex gap-2">
                            <input type="text" id="custom_tag_input" placeholder="Add single language string..." class="bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-xs px-3 py-2 rounded-xl focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all max-w-[240px]">
                            <button type="button" onclick="injectCustomBadge()" class="bg-gray-200 hover:bg-gray-300 dark:bg-slate-800 dark:hover:bg-slate-700 text-xs font-semibold px-4 py-2 rounded-xl transition-all">[ + Add Custom Language ]</button>
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Media Assets Log Collection (Comma-separated URLs)</label>
                            <span class="text-[10px] uppercase font-bold text-brandPrimary tracking-wide">Supports ImgBB & YouTube</span>
                        </div>
                        <input type="text" name="project_media" id="form_project_media" placeholder="https://ibb.co/image1, https://youtube.com/watch?v=..." class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-sm px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">GitHub Codebase Link URL</label>
                            <input type="url" name="github_link" id="form_github_link" placeholder="https://github.com..." class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-sm px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Live Website Production Link URL</label>
                            <input type="url" name="live_demo_link" id="form_live_demo_link" placeholder="https://..." class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-sm px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Deployment Date Started *</label>
                            <input type="date" name="date_started" id="form_date_started" required value="<?php echo date('Y-m-d'); ?>" class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-sm px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 mb-1">Date Finished (Blank for Ongoing)</label>
                            <input type="date" name="date_finished" id="form_date_finished" class="w-full bg-gray-50 dark:bg-slate-950 border border-gray-200 dark:border-slate-800 text-sm px-4 py-2.5 rounded-xl focus:outline-none focus:ring-2 focus:ring-brandPrimary transition-all">
                        </div>
                    </div>

                    <div class="flex items-center space-x-3 bg-gray-50 dark:bg-slate-950/60 border border-gray-200/50 dark:border-slate-800/80 p-4 rounded-xl mt-3 transition-colors">
                        <input type="checkbox" name="is_featured" id="form_is_featured" class="w-4 h-4 rounded text-brandPrimary focus:ring-brandPrimary bg-gray-100 border-gray-300 dark:bg-slate-950 dark:border-slate-800">
                        <div class="select-none">
                            <label for="form_is_featured" class="block text-sm font-bold text-gray-900 dark:text-white cursor-pointer">Pin as Featured Project</label>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Highlights this entry prominently within presentation grids.</p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-100 dark:border-slate-800 flex items-center justify-between gap-4">
                        <button type="button" id="form-reset-btn" onclick="clearFormState()" class="hidden bg-gray-100 hover:bg-gray-200 dark:bg-slate-800 dark:hover:bg-slate-700 font-semibold text-sm py-3 px-6 rounded-xl transition-all text-gray-600 dark:text-gray-300">Cancel Edit Mode</button>
                        <button type="submit" name="project_submit" id="form-submit-btn" class="bg-brandPrimary hover:bg-teal-600 text-white font-semibold text-sm py-3 px-8 rounded-xl shadow-md shadow-brandPrimary/10 transition-colors ml-auto w-full sm:w-auto">Publish Portfolio Entry</button>
                    </div>
                </form>
            </div>

            <div class="bg-white dark:bg-slate-900 shadow-xl border border-gray-200/60 dark:border-slate-800/80 rounded-2xl p-6 md:p-8 tracking-wide">
                <h2 class="font-headline font-bold text-xl text-gray-900 dark:text-white mb-6 border-b border-gray-100 dark:border-slate-800 pb-3">Edit Existing Portfolio Matrix Records</h2>
                
                <?php if (empty($projects)): ?>
                    <p class="text-center text-gray-400 py-6 italic text-sm">No recorded entry nodes detected in repository matrix logs.</p>
                <?php else: ?>
                    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-slate-800">
                        <table class="w-full text-left text-sm border-collapse">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-slate-950 text-gray-500 dark:text-gray-400 text-xs font-semibold uppercase border-b border-gray-200 dark:border-slate-800">
                                    <th class="px-4 py-3">Project Title Elements</th>
                                    <th class="px-4 py-3">Category Grid</th>
                                    <th class="px-4 py-3">Target Badges</th>
                                    <th class="px-4 py-3 text-center">Featured</th>
                                    <th class="px-4 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-slate-800/60">
                                <?php foreach ($projects as $proj): ?>
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-slate-950/30 transition-colors">
                                        <td class="px-4 py-3.5 font-semibold text-gray-900 dark:text-white max-w-[200px] truncate"><?php echo htmlspecialchars($proj['title']); ?></td>
                                        <td class="px-4 py-3.5"><span class="px-2.5 py-0.5 text-xs bg-slate-100 dark:bg-slate-800 rounded-md"><?php echo htmlspecialchars($proj['category']); ?></span></td>
                                        <td class="px-4 py-3.5 max-w-[240px] truncate"><span class="text-xs font-mono text-gray-500 dark:text-gray-400"><?php echo htmlspecialchars($proj['languages_used']); ?></span></td>
                                        <td class="px-4 py-3.5 text-center">
                                            <?php if ($proj['is_featured'] == 1): ?>
                                                <span class="text-emerald-500 text-xs font-bold font-mono px-2 py-0.5 bg-emerald-500/10 rounded">YES</span>
                                            <?php else: ?>
                                                <span class="text-gray-400 text-xs font-mono">NO</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-4 py-3.5 text-right font-medium space-x-2">
                                            <button onclick='loadProjectIntoWorkspace(<?php echo json_encode($proj, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>)' class="text-brandPrimary hover:underline text-xs">Edit Mapping</button>
                                            <a href="admin.php?action=delete&id=<?php echo $proj['id']; ?>" onclick="return confirm('Drop this project matrix entry indefinitely?')" class="text-red-500 hover:underline text-xs">Drop</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <script>
        // Internal configuration store layer arrays
        let structuredSystemTags = <?php echo json_encode($all_tags); ?>;
        let activeSelectedTags = [];

        function toggleCategoryInput(value) {
            const targetInput = document.getElementById('category_custom');
            if (value === 'NEW') {
                targetInput.style.display = 'block';
                targetInput.setAttribute('required', 'required');
            } else {
                targetInput.style.display = 'none';
                targetInput.removeAttribute('required');
                targetInput.value = '';
            }
        }

        function buildLanguagePillWorkspace() {
            const container = document.getElementById('pill-badges-container');
            if (!container) return;
            container.innerHTML = '';

            structuredSystemTags.forEach(tag => {
                const cleanTag = tag.trim();
                if(!cleanTag) return;
                
                const isSelected = activeSelectedTags.includes(cleanTag);
                const button = document.createElement('button');
                button.type = 'button';
                button.onclick = () => toggledBadgeState(cleanTag);
                
                // Style configurations balancing selections matching the theme
                if (isSelected) {
                    button.className = 'bg-brandPrimary text-white text-xs font-mono px-3 py-1 rounded-lg transition-all shadow-sm';
                    button.innerHTML = cleanTag + ' &times;';
                } else {
                    button.className = 'bg-gray-200 dark:bg-slate-800 text-gray-700 dark:text-gray-300 hover:bg-gray-300 dark:hover:bg-slate-700 text-xs font-mono px-3 py-1 rounded-lg transition-all';
                    button.innerHTML = cleanTag;
                }
                container.appendChild(button);
            });

            // Sync with invisible form submission field element safely
            document.getElementById('languages_used').value = activeSelectedTags.join(', ');
        }

        function toggledBadgeState(tag) {
            if (activeSelectedTags.includes(tag)) {
                activeSelectedTags = activeSelectedTags.filter(item => item !== tag);
            } else {
                activeSelectedTags.push(tag);
            }
            buildLanguagePillWorkspace();
        }

        function injectCustomBadge() {
            const input = document.getElementById('custom_tag_input');
            const targetValue = input.value.trim();
            
            if (targetValue !== '') {
                // Parse comma strings gracefully if pasted directly
                const values = targetValue.split(',').map(v => v.trim()).filter(v => v);
                values.forEach(val => {
                    if (!structuredSystemTags.includes(val)) {
                        structuredSystemTags.push(val);
                    }
                    if (!activeSelectedTags.includes(val)) {
                        activeSelectedTags.push(val);
                    }
                });
                input.value = '';
                buildLanguagePillWorkspace();
            }
        }

        function loadProjectIntoWorkspace(payload) {
            // Smoothly scrolls to form workspace interface block anchor
            document.getElementById('form-heading').scrollIntoView({ behavior: 'smooth' });
            
            document.getElementById('form-heading').innerText = "Edit Portfolio Project Matrix Logs";
            document.getElementById('form-submit-btn').innerText = "Save Matrix Updates";
            document.getElementById('form-reset-btn').classList.remove('hidden');

            // Inject core strings fields metadata blocks
            document.getElementById('project_id').value = payload.id;
            document.getElementById('form_title').value = payload.title;
            document.getElementById('form_description').value = payload.description;
            document.getElementById('form_key_contribution').value = payload.key_contribution || '';
            document.getElementById('form_conclusion').value = payload.conclusion || '';
            document.getElementById('form_project_media').value = payload.project_media || '';
            document.getElementById('form_github_link').value = payload.github_link || '';
            document.getElementById('form_live_demo_link').value = payload.live_demo_link || '';
            document.getElementById('form_date_started').value = payload.date_started;
            document.getElementById('form_date_finished').value = payload.date_finished || '';
            document.getElementById('form_is_featured').checked = parseInt(payload.is_featured) === 1;

            // Handle Category selector rules configurations mappings matching payload parameters
            const selector = document.getElementById('category_select');
            let optionExists = false;
            for (let i = 0; i < selector.options.length; i++) {
                if (selector.options[i].value === payload.category) {
                    optionExists = true;
                    break;
                }
            }

            if (optionExists) {
                selector.value = payload.category;
                toggleCategoryInput(payload.category);
            } else {
                selector.value = 'NEW';
                toggleCategoryInput('NEW');
                document.getElementById('category_custom').value = payload.category;
            }

            // Sync languages arrays elements mapping structures securely
            if (payload.languages_used) {
                activeSelectedTags = payload.languages_used.split(',').map(t => t.trim()).filter(t => t);
                // Expand selection map store safely if editing imports missing metrics tags data structures
                activeSelectedTags.forEach(t => {
                    if (!structuredSystemTags.includes(t)) structuredSystemTags.push(t);
                });
            } else {
                activeSelectedTags = [];
            }
            buildLanguagePillWorkspace();
        }

        function clearFormState() {
            document.getElementById('project-main-form').reset();
            document.getElementById('project_id').value = '';
            document.getElementById('form-heading').innerText = "Add New Portfolio Project";
            document.getElementById('form-submit-btn').innerText = "Publish Portfolio Entry";
            document.getElementById('form-reset-btn').classList.add('hidden');
            toggleCategoryInput(document.getElementById('category_select').value);
            activeSelectedTags = [];
            buildLanguagePillWorkspace();
        }

        // Initialize Workspace logic arrays on browser execution completion ready contexts loops
        document.addEventListener('DOMContentLoaded', () => {
            toggleCategoryInput(document.getElementById('category_select').value);
            buildLanguagePillWorkspace();
        });
    </script>
</body>
</html>