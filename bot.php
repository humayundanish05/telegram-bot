<?php
// Telegram Bot for Render.com Deployment

error_reporting(E_ALL);
ini_set('display_errors', 0);

// Get your bot token from @BotFather
$BOT_TOKEN = getenv('BOT_TOKEN') ?: "YOUR_BOT_TOKEN_HERE";
$API_URL = "https://api.telegram.org/bot" . $BOT_TOKEN;

// Log file (Render writes logs to stdout)
function log_msg($message) {
    echo "[" . date('Y-m-d H:i:s') . "] " . $message . "\n";
    flush();
}

// Get request body
$content = file_get_contents("php://input");
log_msg("Received request, content length: " . strlen($content));

if (empty($content)) {
    log_msg("Warning: Empty request body");
    http_response_code(200);
    exit;
}

// Decode JSON
$input = json_decode($content, true);

if (!$input || !isset($input['message'])) {
    log_msg("Invalid input or no message");
    http_response_code(200);
    exit;
}

// Extract message info
$message = $input['message'];
$chat_id = $message['chat']['id'] ?? null;
$text = $message['text'] ?? '';
$user_name = $message['from']['first_name'] ?? 'User';

if (!$chat_id) {
    log_msg("No chat ID found");
    http_response_code(200);
    exit;
}

log_msg("Message from $user_name (ID: $chat_id): $text");

// Prepare response
if ($text === '/start') {
    $response = "Welcome! 👋 Your bot is working perfectly on Render!";
} elseif ($text === '/help') {
    $response = "Commands:\n/start - Welcome\n/help - This message\n\nSend any message for default response!";
} else {
    $response = "hello your bot is working";
}

// Send message using cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $API_URL . "/sendMessage");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    'chat_id' => $chat_id,
    'text' => $response
]));
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$result = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

log_msg("Sent response to $chat_id. HTTP Code: $http_code");

http_response_code(200);
echo json_encode(['status' => 'ok']);
?>
