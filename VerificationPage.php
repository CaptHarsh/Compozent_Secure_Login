<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["verify"])) {
    $enteredCode = $_POST["verification_code"];
    $storedCode = $_SESSION['verification_code'];

    if ($enteredCode == $storedCode) {
        // Verification successful, you can proceed to further actions (e.g., allow user access)
        echo '<div style="color: #009966; font-size: 0.9rem;">Verification successful!</div>';
        header("Location: LoginPage.php");
        exit();
    } else {
        // Verification failed, you can redirect or display an error message
        echo '<div style="color: #cc3300; font-size: 0.9rem;">Verification failed. Please enter the correct code.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>

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
            padding: 20px;
            border-radius: 8px;
            border: 1px solid var(--border-color); /* Updated border style */
            box-sizing: border-box; /* Ensure padding is included in the width */
        }

        /* Animated Verification Card */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .verification-card {
            animation: fadeIn 0.8s ease-out;
            max-width: 350px;
            text-align: center;
            border-radius: 1rem;
            background-color: #ffffff;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.25);
            padding: 20px; /* Adjust padding */
            border: 1px solid var(--border-color); /* Updated border style */
            box-sizing: border-box; /* Ensure padding is included in the width */
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
            border: none;
            border-bottom: 2px solid var(--primary-color);
            background-color: transparent;
            color: var(--text-color);
            margin-bottom: 1rem;
            text-align: center; /* Center the text in the input */
            font-size: 0.9rem;
        }

        .form-control:focus {
            outline: none;
            border-bottom-color: #fff;
        }

        .btn-verify {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            border: none;
            background-color: var(--primary-color);
            color: #fff;
            font-size: 0.9rem;
            letter-spacing: 0.1rem;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-verify:hover {
            background-color: #3c76f6;
        }
    </style>
</head>

<body>

    <div class="background-card">
        <div class="verification-card">
            <h2>Verification</h2>
            <form method="post">
                <input type="text" class="form-control" name="verification_code" placeholder="Verification Code" required>
                <button type="submit" class="btn-verify" name="verify">Verify</button>
            </form>
        </div>
    </div>

</body>

</html>

