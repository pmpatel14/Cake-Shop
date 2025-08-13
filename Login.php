<?php
session_start();
include 'db_connect.php'; // Your DB connection file

// If already logged in, redirect to profile
if (isset($_SESSION['customer_id'])) {
    header("Location: profile.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $sql = "SELECT customer_id, first_name, password FROM customers WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row["password"])) {
            // Login success
            $_SESSION["customer_id"] = $row["customer_id"];
            $_SESSION["customer_name"] = $row["first_name"];
            header("Location: profile.php");
            exit();
        } else {
            $message = "❌ Incorrect password!";
        }
    } else {
        $message = "❌ Email not found!";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Style Alley</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 320px;
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        .input-group {
            margin-bottom: 15px;
        }
        .input-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .input-group input {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .login-btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        .login-btn:hover {
            background-color: #0056b3;
        }
        .message {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
        .forgot-password {
            margin-top: 10px;
            font-size: 14px;
            text-align: center;
        }
        .forgot-password a {
            color: #007bff;
            text-decoration: none;
        }
        .register{
            color: #007bff;
            text-align:center;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Customer Login</h2>
    <?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>

    <form method="POST" action="">
        <div class="input-group">
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit" class="login-btn">Login</button>
    </form>

    <div class="forgot-password">
        <a href="#">Forgot Password?</a>
    </div>
    <br>
    <div class="register">
    <a href="Regi.php">Don't Have An account ? Register here </a>
    </div>
</div>

</body>
</html>
