<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            max-width: 90%;
            text-align: center;
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
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form id="login-form">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-button">Login</button>
        </form>
        <div class="register-link">
            Don't have an account? <a href="createProfile.php">Create profile</a>
        </div>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(event) {
            event.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // In a real application, you would send this data to a server for authentication.
            // For this example, we'll just simulate a successful login.

            console.log('Login attempt:', { email, password });

            // Simulate a successful login
            if (email && password) {
                // Store user session (in a real app, use a secure method)
                sessionStorage.setItem('userEmail', email);
                alert('Login successful! Redirecting to profile creation...');
                window.location.href = 'create_profile.html'; // Redirect to profile creation
            } else {
                alert('Invalid credentials. Please try again.');
            }
        });
    </script>
</body>
</html>
