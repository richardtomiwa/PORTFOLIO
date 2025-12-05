<?php

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

// Simple events API with JSON file persistence
// Supports GET (list) and POST (add/delete) using JSON payloads

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
}

$storageFile = __DIR__ . '/events.json';

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
        ["id" => 1, "title" => "Science Week", "start" => "2025-12-08", "end" => "2025-12-12", "color" => "#f97316"],
        ["id" => 2, "title" => "Winter Break", "start" => "2025-12-24", "end" => "2026-01-04", "color" => "#10b981"],
        ["id" => 3, "title" => "Parent-Teacher Meetings", "start" => "2025-12-15T09:00:00", "end" => "2025-12-16T15:00:00", "color" => "#ef4444"],
        ["id" => 4, "title" => "Math Olympiad", "start" => "2025-12-10T14:30:00", "end" => "2025-12-10T16:00:00", "color" => "#6366f1"],
    ];
    writeEvents($storageFile, $seed);
}

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $events = readEvents($storageFile);
    echo json_encode($events);
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
    $events = readEvents($storageFile);

    if ($action === 'add') {
        $title = isset($body['title']) ? trim($body['title']) : '';
        $start = isset($body['start']) ? $body['start'] : '';
        $end = isset($body['end']) ? $body['end'] : '';
        $color = isset($body['color']) ? $body['color'] : '#3b82f6';
        if ($title === '' || $start === '') {
            http_response_code(400);
            echo json_encode(["error"=>"title and start are required"]);
            exit();
        }
        $maxId = 0;
        foreach ($events as $ev) if (isset($ev['id']) && $ev['id'] > $maxId) $maxId = $ev['id'];
        $new = [
            'id' => $maxId + 1,
            'title' => $title,
            'start' => $start,
            'end' => $end,
            'color' => $color,
        ];
        $events[] = $new;
        if (writeEvents($storageFile, $events)) {
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
        $newList = array_values(array_filter($events, function($ev) use ($id) { return (!isset($ev['id']) || intval($ev['id']) !== $id); } ));
        if (count($newList) === count($events)) {
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

?>
