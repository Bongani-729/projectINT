<?php
header('Content-Type: application/json');

$conn = new mysqli('localhost', 'root', '', 'residence_finder');
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$sql = "SELECT residence_name, total_available, total_unavailable FROM room_availability";
$result = $conn->query($sql);

$residences = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $residences[] = $row;
    }
    echo json_encode($residences);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Query failed']);
}

$conn->close();
