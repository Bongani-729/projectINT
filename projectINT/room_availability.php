<?php
// Database connection
$conn = new mysqli('localhost', 'username', 'password', 'residence_finder'); // Replace with your real DB info

// Check for connection error
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get the residence name from the query string, or use default
$residence = $_GET['residence'] ?? 'CorridorHill';

// Prepare and run the SQL query securely
$stmt = $conn->prepare("SELECT * FROM room_availability WHERE residence_name = ?");
$stmt->bind_param("s", $residence);
$stmt->execute();
$result = $stmt->get_result();

// Initialize counters
$total_available = 0;
$male_available = 0;
$female_available = 0;
$total_unavailable = 0;

if ($row = $result->fetch_assoc()) {
    $total_available = (int)$row['total_available'];
    $male_available = (int)$row['male_available'];
    $female_available = (int)$row['female_available'];
    $total_unavailable = (int)$row['total_unavailable'];
}

// Output as JSON
echo json_encode([
    'residence' => $residence,
    'total_available' => $total_available,
    'male_available' => $male_available,
    'female_available' => $female_available,
    'total_unavailable' => $total_unavailable
]);

// Close connection
$stmt->close();
$conn->close();
?>
