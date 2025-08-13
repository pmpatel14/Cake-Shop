<?php
session_start();
include 'db_connect.php';

// Redirect if not logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

$sql = "SELECT first_name, last_name, email, date_of_birth, address, city, pincode FROM customers WHERE customer_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();
$customer = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Profile</title>
     <!-- swiper link  -->
     <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
     <!-- cdn icon link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- custom css file  -->
    <link rel="stylesheet" href="style.css">
    <style>
    /* body {
    margin: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(to right, #f0f4f8, #d9e2ec);
    padding: 60px 20px;
    color: #2f3e46;
} */

.profile-container {
    max-width: 650px;
    margin: auto;
    background: #ffffff;
    padding: 40px 30px;
    border-radius: 20px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}

h2 {
    text-align: center;
    color: #1d3557;
    font-size: 28px;
    margin-bottom: 30px;
}

.profile-info label {
    font-weight: 600;
    font-size: 15px;
    color: #555;
    margin-top: 20px;
    display: block;
}

.profile-info span {
    display: block;
    margin-top: 5px;
    font-size: 16px;
    color: #2c3e50;
}

.btn-group {
    margin-top: 35px;
    text-align: center;
}

.btn-group a {
    text-decoration: none;
    padding: 12px 25px;
    border-radius: 8px;
    margin: 0 12px;
    font-size: 15px;
    font-weight: 600;
    transition: all 0.3s ease-in-out;
    display: inline-block;
    background-color: #007bff;
    color: white;
}

.btn-group a.logout {
    background-color: #dc3545;
}

.btn-group a:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    opacity: 0.95;
}
</style>
</head>
<body>

<?php include 'header.php';?>
<br>
    </br>
<div class="profile-container">
    <h2>Welcome, <?= htmlspecialchars($customer['first_name']) ?>!</h2>

    <div class="profile-info">
        <label>Full Name:</label>
        <span><?= htmlspecialchars($customer['first_name'] . ' ' . $customer['last_name']) ?></span>

        <label>Email:</label>
        <span><?= htmlspecialchars($customer['email']) ?></span>

        <label>Date of Birth:</label>
        <span><?= htmlspecialchars($customer['date_of_birth']) ?></span>

        <label>Address:</label>
        <span>
            <?= htmlspecialchars($customer['address']) ?><br>
            <?= htmlspecialchars($customer['city']) ?> - <?= htmlspecialchars($customer['pincode']) ?>
        </span>
    </div>

    <div class="btn-group">
        <a href="update_profile.php">Update Profile</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</div>
<br>
    </br>

<?php include 'footer.php';?>

</body>
</html>
