<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

// 1. Get the frontend payloads (Latest message + Conversation timeline array)
$input = json_decode(file_get_contents("php://input"), true);
$userText = isset($input['message']) ? trim($input['message']) : '';
$conversationHistory = isset($input['history']) ? $input['history'] : [];

if (empty($userText)) {
    echo json_encode(["reply" => "Please ask a question!"]);
    exit;
}

// 2. Custom function to safely load environment variables from local .env
function loadEnv($path)
{
    if (!file_exists($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments inside env configuration files
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Split data cleanly by the initial assignment equals sign
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);

            // Strip away string boundaries quotes if defined
            $value = trim($value, '"\'');

            if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
                putenv(sprintf('%s=%s', $name, $value));
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
}

// Load configurations from repository root
loadEnv(__DIR__ . '/../../.env');
$groqApiKey = $_ENV['GROQ_API_KEY'] ?? $_SERVER['GROQ_API_KEY'] ?? getenv('GROQ_API_KEY') ?? '';

if (empty($groqApiKey)) {
    echo json_encode(['reply' => 'Configuration error: API Key missing inside server environment.']);
    exit;
}

// 3. Import dynamic context instructions mapping
$instructionFilePath = __DIR__ . '/../../instruction.txt';

if (file_exists($instructionFilePath)) {
    $portfolioContext = file_get_contents($instructionFilePath);
} else {
    $portfolioContext = "You are a polite AI portfolio assistant for Hem Khatri. Contact him via email at hemlexofficial@gmail.com.";
}

$portfolioContext = trim($portfolioContext);

// 4. Construct the dynamic messages engine for Groq
$messagesPayload = [];

// Inject your system instructions FIRST
$messagesPayload[] = [
    "role" => "system",
    "content" => $portfolioContext
];

// Optimize token usage: Only keep the last 10 messages from the history log if it gets too long
if (count($conversationHistory) > 10) {
    $conversationHistory = array_slice($conversationHistory, -10);
}

// Clean and append past conversation history blocks
foreach ($conversationHistory as $msg) {
    if (isset($msg['role']) && isset($msg['content'])) {
        $role = trim($msg['role']);
        $content = trim($msg['content']);

        // Skip message processing if it's the loading state string or empty
        if (strpos($content, "AI is processing...") !== false || empty($content)) {
            continue;
        }

        $messagesPayload[] = [
            "role" => $role === 'user' ? 'user' : 'assistant',
            "content" => $content
        ];
    }
}

// Bump up the temperature slightly to 0.5-0.6 to give the AI organic phrasing variations
$postData = [
    "model" => "llama-3.3-70b-versatile",
    "messages" => $messagesPayload,
    "max_tokens" => 250, // Bumped to 250 to prevent longer portfolio answers from getting cut off mid-sentence
    "temperature" => 0.5
];

$jsonPayload = json_encode($postData);

// 5. Fire cURL session directly to Groq's official Chat Completions Endpoint
$ch = curl_init("https://api.groq.com/openai/v1/chat/completions");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Bypasses local XAMPP/WAMP SSL configuration faults

curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer " . $groqApiKey,
    "Content-Type: application/json",
    "Content-Length: " . strlen($jsonPayload)
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$data = json_decode($response, true);
$aiAnswer = "";

// 6. Direct mapping extraction parameters
if ($httpCode === 200 && isset($data['choices'][0]['message']['content'])) {
    $aiAnswer = trim($data['choices'][0]['message']['content']);
} elseif (isset($data['error']['message'])) {
    $aiAnswer = "Groq API Error: " . $data['error']['message'];
} else {
    $aiAnswer = "Communication error. (HTTP Code: " . $httpCode . ")";
}

// 7. Output back to your portfolio frontend component
echo json_encode(["reply" => $aiAnswer]);
exit;
