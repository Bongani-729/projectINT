
<?php
// Enable detailed error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "residence_finder";

try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    die($e->getMessage());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name             = $_POST['name'];
    $email            = $_POST['email'];
    $password         = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender           = $_POST['gender'];
    $course           = $_POST['course'];
    $year             = $_POST['year'];
    $studentNo        = $_POST['studentNo'];
    $bursary          = $_POST['bursary'];

    // Basic validation (as before)...

    // ⚠️ Storing password directly (INSECURE – only for development/testing)
    // $password = password_hash($password, PASSWORD_DEFAULT); // Removed

    $stmt = $conn->prepare("INSERT INTO user_profile (name, email, password, gender, course, year_study, studentNo, bursary) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $email, $password, $gender, $course, $year, $studentNo, $bursary);

    if ($stmt->execute()) {
        echo "<script>alert('Profile created successfully! Redirecting to login...'); window.location.href = 'login.html';</script>";
        exit();
    } else {
        echo "<script>alert('Error creating profile.'); window.location.href = 'createProfile.php';</script>";
        exit();
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Create Student Profile</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background-color: #f9f9f9;
      color: #333;
    }

    .header {
      text-align: center;
      padding: 2rem;
      background-color: #003366;
      color: white;
      font-size: 2rem;
    }

    .profile-form {
      background: white;
      padding: 2rem;
      max-width: 600px;
      margin: 2rem auto;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: bold;
    }

    input, select {
      width: 100%;
      padding: 0.8rem;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .submit-button {
      background-color: #003366;
      color: white;
      padding: 0.8rem;
      border: none;
      width: 100%;
      font-size: 1.1rem;
      border-radius: 5px;
      cursor: pointer;
    }

    .submit-button:hover {
      background-color: #002244;
    }

    .footer {
      text-align: center;
      padding: 1rem;
      background-color: #003366;
      color: white;
      margin-top: 2rem;
    }
  </style>
</head>
<body>
  <div class="header">Create Student Profile</div>

  <div class="profile-form">
    <form id="profile-form" method="POST" action="createProfile.php">
      <div class="form-group">
        <label for="name">Full Name:</label>
        <input type="text" name="name" id="name" required />
      </div>

      <div class="form-group">
        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" required />
      </div>

      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required />
      </div>

      <div class="form-group">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required />
      </div>

      <div class="form-group">
        <label for="gender">Gender:</label>
        <select name="gender" id="gender" required>
          <option value="">Select Gender</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
          <option value="other">Other</option>
        </select>
      </div>

      <div class="form-group">
        <label for="course">Course of Study:</label>
        <input type="text" name="course" id="course" required />
      </div>

      <div class="form-group">
        <label for="year">Year of Study:</label>
        <input type="number" name="year" id="year" required />
      </div>

      <div class="form-group">
        <label for="studentNo">Student Number:</label>
        <input type="number" name="studentNo" id="studentNo" required />
      </div>

      <div class="form-group">
        <label for="bursary">Bursary:</label>
        <select name="bursary" id="bursary" required>
          <option value="">Select Bursary</option>
        </select>
      </div>

      <button type="submit" class="submit-button">Create Profile</button>
    </form>
  </div>

  <div class="footer">
    &copy; 2025 Student Residence Finder. All rights reserved.
  </div>

  <script>
    // Populate bursary dropdown
    const bursaryDropdown = document.getElementById("bursary");
    const bursaries = ["NSFAS", "Sasol Bursary", "Company Bursary", "Self Funding"];

    bursaries.forEach(name => {
      const option = document.createElement("option");
      option.value = name;
      option.textContent = name;
      bursaryDropdown.appendChild(option);
    });

    // Client-side validation
    document.getElementById("profile-form").addEventListener("submit", function (event) {
      const password = document.getElementById("password").value;
      const confirm = document.getElementById("confirm_password").value;
      const year = document.getElementById("year").value;
      const studentNo = document.getElementById("studentNo").value;

      if (password !== confirm) {
        alert("Passwords do not match.");
        event.preventDefault();
        return;
      }

      if (password.length < 8) {
        alert("Password must be at least 8 characters.");
        event.preventDefault();
        return;
      }

      if (!/^\d+$/.test(year)) {
        alert("Year must be a number.");
        event.preventDefault();
        return;
      }

      if (!/^\d+$/.test(studentNo)) {
        alert("Student number must be numeric.");
        event.preventDefault();
        return;
      }
    });
  </script>
</body>
</html>
