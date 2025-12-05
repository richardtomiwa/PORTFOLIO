<?php

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type:application/json");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}
echo json_encode("hello");
/* $storageFile = __DIR__ . '/teachers.json';

function readEvents($file) {
    if (!file_exists($file)) return [];
    $json = file_get_contents($file);
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}

function writeEvents($file, $events) {
    $json = json_encode($events, JSON_PRETTY_PRINT);
    // use file lock to avoid race
    $fp = fopen($file, 'c');
    if ($fp === false) return false;
    flock($fp, LOCK_EX);
    ftruncate($fp, 0);
    fwrite($fp, $json);
    fflush($fp);
    flock($fp, LOCK_UN);
    fclose($fp);
    return true;
}

// Seed defaults if storage missing
if (!file_exists($storageFile)) {
    $seed = [
        ["id" => 1, "name" => "tommy", "phone" => "09138163420", "image" => "./images/igs_logo.png"],

    ];
    writeEvents($storageFile, $seed);
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $teachers = readEvents($storageFile);
    echo json_encode($teachers);
    exit();
}

if ($method === 'POST') {
    // Accept JSON body or form-encoded
    $input = file_get_contents('php://input');
    $body = json_decode($input, true);
    if (!is_array($body)) {
        // fallback to $_POST
        $body = $_POST;
    }

    $action = isset($body['action']) ? $body['action'] : null;
    $teachers = readEvents($storageFile);

    if ($action === 'add') {
        $name = isset($body['name']) ? trim($body['name']) : '';
        $phone = isset($body['phone']) ? $body['phone'] : '';
        $image = isset($body['image']) ? $body['image'] : '';
        if ($name === '' || $phone === '') {
            http_response_code(400);
            echo json_encode(["error"=>"title and start are required"]);
            exit();
        }
        $maxId = 0;
        foreach ($teachers as $ts) if (isset($ts['id']) && $ts['id'] > $maxId) $maxId = $ts['id'];
        $new = [
            'id' => $maxId + 1,
            'name' => $name,
            'phone' => $phone,
            'image' => $image,
            
        ];
        $teachers[] = $new;
        if (writeEvents($storageFile, $teachers)) {
            echo json_encode($new);
            exit();
        }
        http_response_code(500);
        echo json_encode(["error"=>"failed to write events"]);
        exit();
    }

    if ($action === 'delete') {
        $id = isset($body['id']) ? intval($body['id']) : 0;
        if ($id <= 0) {
            http_response_code(400);
            echo json_encode(["error"=>"invalid id"]);
            exit();
        }
        $newList = array_values(array_filter($teachers, function($ts) use ($id) { return (!isset($ts['id']) || intval($ts['id']) !== $id); } ));
        if (count($newList) === count($teachers)) {
            http_response_code(404);
            echo json_encode(["error"=>"not found"]);
            exit();
        }
        if (writeEvents($storageFile, $newList)) {
            echo json_encode(["success"=>true]);
            exit();
        }
        http_response_code(500);
        echo json_encode(["error"=>"failed to write events"]);
        exit();
    }

    // Unknown action
    http_response_code(400);
    echo json_encode(["error"=>"unknown action"]);
    exit();
}

// other methods
http_response_code(405);
echo json_encode(["error"=>"method not allowed"]);
exit();
*/
?>



