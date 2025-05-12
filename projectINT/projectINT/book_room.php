<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'residence_finder');

// Check for connection error
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Get the form data
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$type = $_POST['type'] ?? ''; // 'male' or 'female'
$residence = $_POST['residence'] ?? ''; // 'Building 54', 'Khayalethu', 'Private Accommodation'

// Debugging: Check received data
error_log('Received data: ' . print_r($_POST, true));

if (!$name || !$email || !$type || !$residence) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Please fill in all required fields.'
    ]);
    exit();
}

// Check if the room is available in the selected residence
$query = "SELECT * FROM room_availability WHERE residence_name = ? AND total_available > 0";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $residence);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // Check availability based on room type (male or female)
    if ($type == 'male' && $row['male_available'] > 0) {
        $room_type = 'male';
        $update_query = "UPDATE room_availability 
                         SET male_available = male_available - 1, 
                             total_available = total_available - 1, 
                             total_unavailable = total_unavailable + 1 
                         WHERE residence_name = ?";
    } elseif ($type == 'female' && $row['female_available'] > 0) {
        $room_type = 'female';
        $update_query = "UPDATE room_availability 
                         SET female_available = female_available - 1, 
                             total_available = total_available - 1, 
                             total_unavailable = total_unavailable + 1 
                         WHERE residence_name = ?";
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'No available rooms of the selected type.'
        ]);
        exit();
    }

    // Insert booking into the room_booking table
    $booking_query = "INSERT INTO room_booking (name, email, residence, room_type, booking_date) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($booking_query);
    $stmt->bind_param("ssss", $name, $email, $residence, $room_type);

    if ($stmt->execute()) {
        // Update room availability
        $stmt = $conn->prepare($update_query);
        $stmt->bind_param("s", $residence);
        if ($stmt->execute()) {
            // Success: return booking and checkout dates
            echo json_encode([
                'status' => 'success',
                'currentDate' => date('Y-m-d H:i:s'),
                'checkoutDate' => date('Y-m-d H:i:s', strtotime('+10 hours'))
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Error updating room availability. Please try again.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Error booking your room. Please try again.'
        ]);
    }
} else {
    // No available rooms in the residence
    echo json_encode([
        'status' => 'error',
        'message' => 'No available rooms for the selected residence.'
    ]);
}

$stmt->close();
$conn->close();
?>
