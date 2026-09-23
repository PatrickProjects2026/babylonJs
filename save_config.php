<?php
// Read the incoming raw POST data
$content = file_get_contents('php://input');

if ($content) {
    // Decode and re-encode for pretty formatting
    $data = json_decode($content, true);
    if ($data) {
        $formattedJson = json_encode($data, JSON_PRETTY_PRINT);
        
        // Save directly into the main project directory as car_config.json
        file_put_contents(__DIR__ . '/car_config.json', $formattedJson);
        
        http_response_code(200);
        echo json_encode(["status" => "success", "message" => "Saved successfully to main directory"]);
        exit;
    }
}

http_response_code(400);
echo json_encode(["status" => "error", "message" => "Invalid data"]);
?>