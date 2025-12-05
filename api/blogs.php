<?php

// CORS headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST");
header("Access-Control-Allow-Headers: Content-Type");

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit();
};
$blogs=[
    [
        "title" => "Welcome to Our School",
        "content" => "We are delighted to welcome you to our school community. Our mission is to provide a nurturing environment that fosters academic excellence and personal growth.",
        "date" => "2023-10-01"
    ],
    [
        "title" => "Upcoming Events",
        "content" => "Join us for our annual sports day on October 15th. It's a great opportunity for students to showcase their talents and for parents to engage with the school community.",
        "date" => "2023-10-05"
    ],
    [
        "title" => "New Curriculum Updates",
        "content" => "We are excited to announce updates to our curriculum that will enhance learning experiences and better prepare our students for future challenges.",
        "date" => "2023-10-10"
    ]
    ];


    echo json_encode($blogs);
    exit();
        ?>