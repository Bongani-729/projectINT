<?php
header('Content-Type: application/json');

// Database credentials
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "residence_finder";

// Connect using mysqli with error reporting
$mysqli = new mysqli($host, $user, $pass, $dbname);
if ($mysqli->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed."]);
    exit;
}

// Define query
$sql = "SELECT 
            residence AS name, 
            total_available, 
            male_available, 
            female_available, 
            total_unavailable 
        FROM room_availability";

// Prepare and execute
$stmt = $mysqli->prepare($sql);
if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to prepare the SQL query."]);
    exit;
}

$stmt->execute();
$result = $stmt->get_result();

// Fetch data
$residences = [];
while ($row = $result->fetch_assoc()) {
    $residences[] = $row;
}

// Output JSON
echo json_encode($residences);

// Cleanup
$stmt->close();
$mysqli->close();
?>
