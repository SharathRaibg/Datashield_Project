<?php
date_default_timezone_set("Asia/Kolkata");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$data = file_get_contents("php://input");

if (empty($data)) {
    http_response_code(400);
    exit("No data received");
}

$decoded = json_decode($data, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    exit("Invalid JSON");
}

// Add upload time
$decoded["upload_time"] = date("Y-m-d H:i:s");

$dir = "/home/ec2-user/data/raw";

if (!is_dir($dir)) {
    mkdir($dir, 0775, true);
}

$file = $dir . "/submission_" . date("Ymd_His") . "_" . uniqid() . ".json";

if (file_put_contents($file, json_encode($decoded, JSON_PRETTY_PRINT))) {
    echo "Data saved successfully";
} else {
    http_response_code(500);
    echo "Failed to save data";
}
?>