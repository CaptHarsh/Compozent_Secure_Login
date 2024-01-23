<?php


session_start();

if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
    header("Location: LoginPage.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["logout"])) {
    session_destroy();
    header("Location: LoginPage.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

 
    <style>
        :root {
            --bg-color: #f4f4f4;
            --text-color: #333;
            --primary-color: #4285f4;
            --form-bg-color: #ffffff;
            --border-color: #333;
        }

        body {
            display: grid;
            place-items: center;
            height: 100vh;
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: 'Arial', sans-serif;
            margin: 0;
        }

        .dashboard {
            animation: fadeIn 0.8s ease-out;
            max-width: 350px;
            text-align: center;
            border-radius: 1rem;
            background-color: var(--form-bg-color);
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.25);
            padding: 2rem;
            border: 1px solid var(--border-color);
            box-sizing: border-box;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        .btn-logout {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 4px;
            border: none;
            background-color: var(--primary-color);
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-logout:hover {
            background-color: #3c76f6;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>

<body>
    <div class="dashboard">

        <h2>Welcome to COMPOZENT SECURE LOGIN!</h2>

        <form method="post">
            <button class="btn-logout" type="submit" name="logout">Logout</button>
        </form>

    </div>
</body>

</html>
