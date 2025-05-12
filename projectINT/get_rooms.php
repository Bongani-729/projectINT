<?php
header('Content-Type: application/json');

// Database connection
$conn = new mysqli('localhost', 'root', '', 'residence_finder');
if ($conn->connect_error) {
    die(json_encode(['error' => 'Connection failed: ' . $conn->connect_error]));
}

// Fetch room availability from the database for the given residence
$residence = $_GET['residence'] ?? 'corridorhill'; // default residence

$query = "SELECT total_available, male_available, female_available, total_unavailable FROM room_availability WHERE residence_name = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $residence);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode($row);
} else {
    echo json_encode([
        'total_available' => 0,
        'male_available' => 0,
        'female_available' => 0,
        'total_unavailable' => 0
    ]);
}

$stmt->close();
$conn->close();
?>
