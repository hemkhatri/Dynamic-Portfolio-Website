<?php
// 1. Force XAMPP to show all error reporting metrics
ini_set('display_errors', 1);
error_reporting(E_ALL);

// 2. Include your core controller backend
require_once __DIR__ . '/blogger_api.php';

echo "<h1>📡 Blogger API Feed Testing Panel</h1>";

// 3. Define the query endpoint parameters for fetching multiple posts
// We ask for the latest 10 items and add the trailing ampersand (&) 
// because your fetch_blogger_data() function appends "key=API_KEY" directly to it.
$endpoint = "posts?maxResults=10&";
$cache_filename = "posts_cache.json";

echo "<p>Attempting connection to Google API or fetching from local file storage cache system...</p>";

// 4. Fire the pipeline request
$raw_payload = fetch_blogger_data($endpoint, $cache_filename);

// 5. Verify and process the fetched layout
if ($raw_payload && isset($raw_payload['items'])) {
    
    // Pass raw API items into your formatting structural array matrix
    $formatted_posts = format_blogger_posts($raw_payload['items']);
    
    echo "<h2>✅ Successfully Loaded " . count($formatted_posts) . " Posts:</h2>";
    echo "<ul style='font-family: sans-serif; line-height: 1.6; font-size: 1.2rem;'>";
    
    // Loop and display every title along with its generated slug asset handle
    foreach ($formatted_posts as $post) {
        echo "<li style='margin-bottom: 12px;'>";
        echo "<strong>Title:</strong> " . $post['title'] . "<br>";
        echo "<span style='color: #666; font-size: 0.95rem;'>🔗 Slug Handle: " . $post['slug'] . "</span>";
        echo "</li>";
    }
    
    echo "</ul>";

} else {
    // Error feedback routing engine debug display
    echo "<h2 style='color: #d9534f;'>❌ Error Fetching Data Payload</h2>";
    echo "<p>Please ensure that your credentials inside your <strong>.env</strong> file match perfectly:</p>";
    echo "<ul>";
    echo "<li><strong>BLOG_ID:</strong> " . (defined('BLOG_ID') ? BLOG_ID : 'Not Set') . "</li>";
    echo "<li><strong>API_KEY:</strong> " . (defined('API_KEY') ? substr(API_KEY, 0, 10) . '...' : 'Not Set') . "</li>";
    echo "</ul>";
    
    echo "<h3>Raw Server Context Error Dump:</h3>";
    echo "<pre style='background: #f4f5f7; padding: 10px; border: 1px solid #ddd;'>";
    print_r($raw_payload);
    echo "</pre>";
}
