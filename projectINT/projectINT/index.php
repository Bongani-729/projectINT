<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "residence_finder";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error message
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $stmt = $conn->prepare("SELECT email, password FROM user_profile WHERE email = ?");
    $stmt->bind_param("s", $email);

    if ($stmt->execute()) {
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($db_email, $db_password);
            $stmt->fetch();

            if (password_verify($password, $db_password)) {
                $_SESSION['user_email'] = $db_email;
                header("Location: main.php");
                exit();
            } else {
                $error_message = "Invalid password.";
            }
        } else {
            $error_message = "No account found with that email.";
        }
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding-top: 5rem;
        }

        header {
            background-color: #003366;
            color: white;
            padding: 1rem;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        header h1 {
            margin: 0 0 0.5rem 0;
            font-size: 1.8rem;
        }

        nav {
            display: flex;
            gap: 1rem;
            margin-bottom: 0.5rem;
        }

        nav a {
            color: white;
            text-decoration: none;
            font-size: 1.1rem;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-links a {
            color: white;
            font-size: 1.1rem;
            text-decoration: none;
        }

        .social-links a:hover {
            opacity: 0.7;
        }

        .login-container {
            background: white;
            padding: 2rem;
            margin: 3rem auto 0;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 400px;
            max-width: 90%;
        }

        h2 {
            color: #003366;
            text-align: center;
        }

        .form-group {
            margin-bottom: 1.2rem;
        }

        label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #aaa;
            border-radius: 5px;
        }

        .login-button {
            background-color: #003366;
            color: white;
            padding: 0.8rem;
            border: none;
            border-radius: 25px;
            width: 100%;
            font-size: 1rem;
            cursor: pointer;
        }

        .login-button:hover {
            background-color: #002244;
        }

        .error-message {
            color: red;
            margin-top: 1rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .register-link {
            margin-top: 1rem;
            text-align: center;
            font-size: 0.9rem;
        }

        .register-link a {
            color: #003366;
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .social-login {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 1.5rem;
            gap: 1rem;
        }

        .social-login-button {
            padding: 0.8rem;
            border: none;
            border-radius: 25px;
            width: 100%;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .google-login-button {
            background-color: #db4437;
            color: white;
        }

        .google-login-button:hover {
            background-color: #c23321;
        }

        .whatsapp-login-button {
            background-color: #25d366;
            color: white;
        }

        .whatsapp-login-button:hover {
            background-color: #1e9b4e;
        }

        .forgot-password {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
        }

        .forgot-password a {
            color: #003366;
            text-decoration: none;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Student Residence Finder</h1>
        <nav>
            <a href="#contact">Contact</a>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#menu">Menu</a>
        </nav>
 
    </header>

    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>
        <div class="register-link">
            Don't have an account? <a href="createProfile1.php">Create profile</a>
        </div>

        <div class="social-login">
            <button class="social-login-button google-login-button">
                <img src="search.png" alt="Google Logo" width="20">
                Login with Google
            </button>
            <button class="social-login-button whatsapp-login-button">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/2048px-WhatsApp.svg.png" alt="WhatsApp Logo" width="20">
                Login with WhatsApp
            </button>
        </div>
        <div class="forgot-password">
            <a href="forgot_password.php">Forgot Password?</a>
        </div>
    </div>
    <script>
        const googleLoginButton = document.querySelector('.google-login-button');
        const whatsappLoginButton = document.querySelector('.whatsapp-login-button');

        googleLoginButton.addEventListener('click', () => {
            alert('Google login functionality not implemented yet.');
        });

        whatsappLoginButton.addEventListener('click', () => {
             alert('WhatsApp login functionality not implemented yet.');
        });
    </script>
</body>
</html>
