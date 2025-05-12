<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Student Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }

        .header {
            text-align: center;
            padding: 2rem 1rem;
            font-size: 2rem;
            font-weight: bold;
            background-color: #003366;
            color: white;
        }

        .profile-form {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 2rem auto;
            max-width: 600px;
        }

        .profile-form h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #003366;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: bold;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #aaa;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: #003366;
            box-shadow: 0 0 0 2px rgba(0, 51, 102, 0.2);
        }

        .form-group select {
            appearance: none; /* Remove default arrow */
            background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="%23333" d="M2 0L0 2h4z"/></svg>'); /* Custom arrow */
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 0.75rem;
            padding-right: 2.5rem; /* Make space for the arrow */
        }

        .form-group select:focus {
             background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="%23003366" d="M2 0L0 2h4z"/></svg>');
        }


        .bursary-filter {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .bursary-filter h3 {
            margin-bottom: 1rem;
            color: #003366;
        }

        .submit-button {
            background-color: #003366;
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #002244;
        }

        .footer {
            background-color: #003366;
            color: white;
            text-align: center;
            padding: 1.5rem 1rem;
            margin-top: 2rem;
        }

        .footer small {
            color: #ccc;
        }

        @media (max-width: 768px) {
            .profile-form {
                width: 95%;
            }
        }
    </style>
</head>
<body>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "residence_finder";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $gender = $_POST['gender'];
            $course = $_POST['course'];
            $year_study = $_POST['year'];
            $studentNo = $_POST['studentNo'];
            $bursary = $_POST['bursary'];

            $sql = "INSERT INTO user_profile (name, email, password, gender, course, year_study, studentNo, bursary)
                    VALUES ('$name', '$email', '$password', '$gender', '$course', '$year_study', '$studentNo', '$bursary')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Profile created successfully! Redirecting to login...'); window.location.href = 'login.html';</script>";
                //exit(); // Prevent further HTML output
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();
        }
    ?>
    <div class="header">Create Student Profile</div>

    <div class="profile-form">
        <h2>Student Profile Information</h2>
        <form id="profile-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
             <div class="form-group">
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <select id="gender" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="course">Course of Study:</label>
                <input type="text" id="course" name="course" required>
            </div>
            <div class="form-group">
                <label for="year">Year of Study:</label>
                <input type="number" id="year" name="year" required>
            </div>
            <div class="form-group">
                <label for="studentNo">Student Number:</label>
                <input type="number" id="studentNo" name="studentNo" required>
            </div>
            <div class="form-group">
                <label for="bursary">Bursary:</label>
                 <select id="bursary" name="bursary">
                    <option value="">Select Bursary</option>
                 </select>
            </div>
            <button type="submit" class="submit-button">Create Profile</button>
        </form>

    </div>

    <div class="footer">
        <p>&copy; 2025 Student Residence Finder. All rights reserved.</p>
        <small>Website designed and developed by [Your Name/Company]</small>
    </div>

    <script>
    document.getElementById('profile-form').addEventListener('submit', function(event) {
        event.preventDefault();

        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('confirm_password').value;

        if (password !== confirmPassword) {
            alert('Passwords do not match. Please try again.');
            return;
        }

        // Get form values
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const gender = document.getElementById('gender').value;
        const course = document.getElementById('course').value;
        const yearOfStudy = document.getElementById('year').value;
        const studentNo = document.getElementById('studentNo').value;
         const selectedBursaryId = document.getElementById('bursary').value;


        // In a real application, you would send this data to a server
        // to store it in a database and retrieve matching bursaries.
        // For this example, we'll just simulate the filtering.

        console.log('Form Data:', {
            name,
            email,
            password,
            gender,
            course,
            yearOfStudy,
            studentNo,
            selectedBursaryId
        });

        //  this is handled by the PHP
       // alert('Form submitted successfully!');
       //  window.location.href = 'login.html';

    });
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column; /* Change to column to accommodate header */
            align-items: center;
            min-height: 100vh;
            padding-top: 4rem; /* Add padding at the top for fixed header */
            box-sizing: border-box; /* Include padding in body's total width/height */
            position: relative; /* Needed for absolute positioning of header */
        }

        .login-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 90%;
            text-align: center;
            margin-top: 2rem; /* Add margin to separate from header */
        }

        .login-container h2 {
            margin-bottom: 1.5rem;
            color: #003366;
        }

        .form-group {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #aaa;
            border-radius: 5px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        .form-group input:focus {
            outline: none;
            border-color: #003366;
            box-shadow: 0 0 0 2px rgba(0, 51, 102, 0.2);
        }

        .login-button {
            background-color: #003366;
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 25px;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        .login-button:hover {
            background-color: #002244;
        }

        .register-link {
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .register-link a {
            color: #003366;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        /* Header Styles */
        header {
            background-color: #003366;
            color: white;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            box-sizing: border-box;
            position: fixed; /* Make header fixed */
            top: 0;         /* Position at the top */
            z-index: 100;         /* Ensure it's above other elements */
            flex-direction: column; /* Stack items vertically by default */
            align-items: center; /* Center items horizontally by default */
        }

        header h1 {
            margin: 0 0 0.5rem 0; /* Add space below heading */
            font-size: 1.8rem;
        }

        header nav {
            display: flex;
            justify-content: center; /* Center navigation links */
            gap: 1rem;
            margin-bottom: 0.5rem; /* Add space below nav */
        }

        header nav a {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
        }

        header nav a:hover {
            text-decoration: underline;
        }

        .social-links {
            display: flex;
            justify-content: center; /* Center social links */
            gap: 1rem;
        }

        .social-links a {
            color: white;
            font-size: 1.3rem; /* Adjust size as needed */
            text-decoration: none; /* remove underline */
        }

        .social-links a:hover {
             opacity: 0.7; /* reduce opacity on hover for visual feedback */
        }

        /* Responsive adjustments for centering in header */
        @media (min-width: 600px) {
            header {
                flex-direction: row; /* Arrange items in a row on wider screens */
                justify-content: space-between; /* Space out items on wider screens */
            }
            header h1 {
                margin-bottom: 0; /* Remove bottom margin on wider screens */
            }
            header nav {
                margin-bottom: 0;
            }
        }

        .error-message {
            color: red;
            margin-top: 1rem;
            text-align: center;
            font-size: 0.9rem;
        }

    </style>

    <header>
        <h1>Student Residence Finder</h1>
        <nav>
            <a href="#contact">Contact</a>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#menu">Menu</a>
        </nav>
        <div class="social-links">
            <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer">Facebook</a>
            <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer">Instagram</a>
            <a href="https://www.google.com/" target="_blank" rel="noopener noreferrer">Google</a>
            <a href="https://www.whatsapp.com/" target="_blank" rel="noopener noreferrer">WhatsApp</a>
        </div>

        const bursaryDropdown = document.getElementById('bursary');

        // Function to populate the bursary dropdown (replace with your data source)
        function populateBursaryDropdown() {
            const bursaries = [
                { id: 1, name: "NSFAS" },
                { id: 2, name: "Sasol Bursary"},
                { id: 3, name: "Company Bursary" },
                { id: 4, name: "Self Funding" },
                { id: 5, name: "Bursary E", amount: 8000, eligibility: "Engineering Students" },
            ];

            // Clear existing options
            bursaryDropdown.innerHTML = '<option value="">Select Bursary</option>';

            // Add new options
            bursaries.forEach(bursary => {
                const option = document.createElement('option');
                option.value = bursary.id;
                option.textContent = `${bursary.name} (R${bursary.amount}, ${bursary.eligibility})`;
                bursaryDropdown.appendChild(option);
            });
        }

        // Call the function to populate the dropdown when the page loads
        populateBursaryDropdown();
    </script>
</body>
</html>
