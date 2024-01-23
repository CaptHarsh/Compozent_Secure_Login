<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "1234";
$database = "seclogin_db";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashedPassword = $user["password"];

        if (password_verify($password, $hashedPassword)) {
            $_SESSION["user"] = $user;
            header("Location: Dashboard.php");
            exit();
        } else {
            echo "Invalid password. Debug: Passwords do not match. Password entered: $password, Hashed Password in DB: $hashedPassword";
        }
    } else {
        echo "Invalid username.User not found.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Stylesheet -->
    <style>
        :root {
            --bg-color: #f4f4f4;
            --text-color: #333;
            --primary-color: #4285f4;
            --form-bg-color: #ffffff;
            --border-color: #333; /* Updated border color to match the signup page */
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'Arial', sans-serif;
            margin: 0;
        }

        /* Elevated Card-like Background */
        .background-card {
            background-color: var(--form-bg-color);
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            padding: 2rem;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            box-sizing: border-box;
        }

        /* Animated Login Card */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-card {
            animation: fadeIn 0.8s ease-out;
            max-width: 350px;
            text-align: center;
            border-radius: 1rem;
            background-color: var(--form-bg-color);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.25);
            padding: 20px;
            border: 1px solid var(--border-color);
            box-sizing: border-box;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--border-color);
            border-radius: 4px;
            margin-bottom: 1rem;
            box-sizing: border-box;
            font-size: 0.9rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
        }

        .btn-login,
        .btn-signup {
            width: 100%;
            padding: 0.75rem;
            border: none;
            border-radius: 4px;
            background-color: var(--primary-color);
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
            margin-bottom:30px;
            text-decoration:none;
        }

        .btn-login:hover,
        .btn-signup:hover {
            background-color: #3c76f6;
        }

        .btn-signup {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="background-card">
        <div class="login-card">
            <h2>Login</h2>
            <form action="LoginPage.php" method="POST">
                <input type="text" class="form-control" name="username" placeholder="Username">
                <input type="password" class="form-control" name="password" placeholder="Password">
                <button type="submit" class="btn-login">Log In</button>
                <a href="SignUpPage.php" class="btn-signup">Sign Up</a>
            </form>
        </div>
    </div>
</body>

</html>

