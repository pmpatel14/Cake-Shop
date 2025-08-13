<?php 
session_start();
include 'db_connect.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: profile.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];
$message = "";

// Fetch current customer details
$sql = "SELECT first_name, last_name, email, date_of_birth, address, city, pincode FROM customers WHERE customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $dob = $_POST["date_of_birth"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $pincode = $_POST["pincode"];

    $update_sql = "UPDATE customers SET first_name=?, last_name=?, email=?, date_of_birth=?, address=?, city=?, pincode=? WHERE customer_id=?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("sssssssi", $first_name, $last_name, $email, $dob, $address, $city, $pincode, $customer_id);

    if ($update_stmt->execute()) {
        $_SESSION["customer_name"] = $first_name;

        // Redirect to profile page after successful update
        header("Location: profile.php");
        exit();
    } else {
        $message = "❌ Error updating profile!";
    }

    $update_stmt->close();
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Profile</title>
    <style>
        body {
            font-family: Arial;
            background: #f0f0f0;
            padding: 40px;
        }
        .container {
            background: white;
            max-width: 600px;
            margin: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form div {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .message {
            text-align: center;
            color: green;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Update Profile</h2>

    <?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>

    <form method="POST">
        <div>
            <label>First Name:</label>
            <input type="text" name="first_name" value="<?= htmlspecialchars($customer['first_name']) ?>" required>
        </div>
        <div>
            <label>Last Name:</label>
            <input type="text" name="last_name" value="<?= htmlspecialchars($customer['last_name']) ?>" required>
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="<?= htmlspecialchars($customer['email']) ?>" required>
        </div>
        <div>
            <label>Date of Birth:</label>
            <input type="date" name="date_of_birth" value="<?= htmlspecialchars($customer['date_of_birth']) ?>">
        </div>
        <div>
            <label>Address:</label>
            <textarea name="address"><?= htmlspecialchars($customer['address']) ?></textarea>
        </div>
        <div>
            <label>City:</label>
            <input type="text" name="city" value="<?= htmlspecialchars($customer['city']) ?>">
        </div>
        <div>
            <label>Pincode:</label>
            <input type="text" name="pincode" value="<?= htmlspecialchars($customer['pincode']) ?>">
        </div>
        <button type="submit">Update</button>
    </form>
</div>

</body>
</html>
