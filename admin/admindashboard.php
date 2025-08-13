<?php 
include('db_connect.php');
session_start();

// Count queries
$total_customers = $conn->query("SELECT COUNT(*) AS total FROM customers")->fetch_assoc()['total'];
$total_products  = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc()['total'];
$total_orders    = $conn->query("SELECT COUNT(*) AS total FROM orders")->fetch_assoc()['total'];
$total_payments  = $conn->query("SELECT COUNT(*) AS total FROM payments")->fetch_assoc()['total'];
$total_feedbacks = $conn->query("SELECT COUNT(*) AS total FROM feedback")->fetch_assoc()['total'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #212529;
            padding-top: 20px;
            color: #fff;
        }

        .sidebar a {
            padding: 15px;
            color: #fff;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #007bff;
        }

        .main {
            margin-left: 270px;
            padding: 40px;
            position: relative;
        }

        .logout-btn {
            position: absolute;
            height:50px;
            width:130px;
            top: 20px;
            right: 20px;
            background-color:rgb(255, 255, 255);
            border: 2px solid #dc3545;
            padding: 10px 18px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            font-size:15px;
            color:#dc3545;
            cursor: pointer;
        }

        .logout-btn:hover {
            background-color: #c82333;
            color:white;
        }

        h1 {
            color: #333;
        }

        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 60px;
        }

        .summary-card {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .summary-card.blue { background: #007bff; }
        .summary-card.green { background: #28a745; }
        .summary-card.orange { background: #fd7e14; }
        .summary-card.red { background: #dc3545; }
        .summary-card.purple { background: #6f42c1; }

        .summary-card h3 {
            margin: 0;
            font-size: 18px;
            color: white;
        }

        .summary-card p {
            font-size: 24px;
            margin: 5px 0 0;
            color: white;
            font-weight: bold;
        }

        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal-box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0,0,0,0.3);
            max-width: 400px;
            width: 90%;
        }

        .modal-box h2 {
            margin-bottom: 20px;
        }

        .modal-buttons button {
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn-confirm {
            background-color: #dc3545;
            color: white;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
        }

        .btn-confirm:hover {
            background-color: #c82333;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3 style="text-align:center;">ADMIN DASHBOARD</h3>
    <a href="admindashboard.php">Dashboard</a>
    <a href="manage_customers.php">Customers</a>
    <a href="manage_categorie.php">Category</a>
    <a href="manage_product.php">Product</a>
    <a href="manage_orders.php">Order</a>
    <a href="manage_payments.php">Payment</a>
    <a href="manage_feedback.php">Feedback</a>
</div>

<!-- Main Content -->
<div class="main">
    <button class="logout-btn" onclick="showLogoutPopup()">Logout</button>

    <h1>Welcome to the Admin Dashboard</h1>

    <div class="summary-cards">
        <div class="summary-card blue">
            <h3>Total Customers</h3>
            <p><?= $total_customers ?></p>
        </div>
        <div class="summary-card green">
            <h3>Total Products</h3>
            <p><?= $total_products ?></p>
        </div>
        <div class="summary-card orange">
            <h3>Total Orders</h3>
            <p><?= $total_orders ?></p>
        </div>
        <div class="summary-card red">
            <h3>Total Payments</h3>
            <p><?= $total_payments ?></p>
        </div>
        <div class="summary-card purple">
            <h3>Total Feedback</h3>
            <p><?= $total_feedbacks ?></p>
        </div>
    </div>
</div>

<!-- Modal Popup -->
<div class="modal-overlay" id="logoutModal">
    <div class="modal-box">
        <h2>Are you sure you want to logout?</h2>
        <div class="modal-buttons">
            <button class="btn-confirm" onclick="confirmLogout()">Yes</button>
            <button class="btn-cancel" onclick="hideLogoutPopup()">Cancel</button>
        </div>
    </div>
</div>

<script>
    function showLogoutPopup() {
        document.getElementById('logoutModal').style.display = 'flex';
    }

    function hideLogoutPopup() {
        document.getElementById('logoutModal').style.display = 'none';
    }

    function confirmLogout() {
        window.location.href = 'logout.php';
    }
</script>

</body>
</html>
