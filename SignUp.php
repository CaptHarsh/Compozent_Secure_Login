<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

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

// Signup logic
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup"])) {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = password_hash(trim($_POST["password"]), PASSWORD_BCRYPT); // Hashing the password

    // Check if username or email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<div style="color: #cc9900; font-size: 0.9rem;">Username or email already exists. Please choose a different one.</div>';
    } else {
        // Insert new user into the database
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();
        $stmt->close();

        // Simulate 2FA via email (you would implement a real email sending mechanism here)
        $verificationCode = mt_rand(100000, 999999);
        $_SESSION['verification_code'] = $verificationCode;
        $_SESSION['signup_username'] = $username;
        $_SESSION['signup_email'] = $email;

        // Use PHPMailer to send the email using Mailtrap SMTP server
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '13ac1f96bb5d83';
            $mail->Password = '35f28933f5a75b';
            $mail->SMTPSecure = 'tls'; // You can use 'ssl' instead if needed
            $mail->Port = 2525; // You should use the port provided by Mailtrap

            $mail->setFrom('sahil.chintan.pancholi@gmail.com', 'SAHIL');
            $mail->addAddress($email, $username);
            $mail->Subject = 'Account Verification Code';
            $mail->Body = "Your verification code is: $verificationCode";
            $mail->send();

            // Display a success message
            echo '<div style="color: #009966; font-size: 0.9rem;">Signup successful! Check your email for the verification code.</div>';
        } catch (Exception $e) {
            echo '<div style="color: #cc3300; font-size: 0.9rem;">Message could not be sent. Mailer Error: ' . $mail->ErrorInfo . '</div>';
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>

    <!-- Stylesheet -->
    <style>
        :root {
            --bg-color: #f4f4f4;
            --text-color: #333;
            --primary-color: #4285f4;
            --form-bg-color: #ffffff;
            --border-color: #ddd; /* New border color */
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
    padding: 20px;
    border-radius: 8px;
    border: 1px solid var(--border-color); /* New border style */
    box-sizing: border-box; /* Ensure padding is included in the width */
}

/* Animated Signup Card */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

.signup-card {
    animation: fadeIn 0.8s ease-out;
    width: 300px;
    text-align: center;
    border: 2px solid #333; /* Dark border color */
    border-radius: 8px; /* Add border-radius for rounded corners */
    padding: 20px; /* Add padding inside the border */
    box-sizing: border-box; /* Ensure padding is included in the width */
}

/* ... other styles remain the same ... */


/* ... other styles remain the same ... */


/* ... other styles remain the same ... */


        h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--border-color); /* New border style */
            border-radius: 4px;
            margin-bottom: 1rem;
            box-sizing: border-box;
            font-size: 0.9rem;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
        }

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
        }

        .btn-signup:hover {
            background-color: #3c76f6;
        }
    </style>
</head>

<body>

<div class="background-card">
    <div class="signup-card">
        <h2>Signup</h2>
        <form method="post">
            <input type="text" class="form-control" name="username" placeholder="Username" required>
            <input type="email" class="form-control" name="email" placeholder="Email" required>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <button type="submit" class="btn-signup" name="signup">Sign Up</button>
        </form>
    </div>
</div>

</body>
</html>
