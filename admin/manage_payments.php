<?php
include('db_connect.php');

// Fetch all payment records
$payments = $conn->query("SELECT * FROM payments ORDER BY payment_id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Payments Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            padding: 40px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
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
            color: #fff;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        th {
            background-color:  rgb(79,79, 79);
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .status-completed {
            color: green;
            font-weight: bold;
        }

        .status-pending {
            color: #ff9800;
            font-weight: bold;
        }
    </style>
</head>
<body>
     <!-- Sidebar -->
<div class="sidebar">
    <h3>ADMIN DASHOARD</h3>
    <a href="admindashboard.php"><i class=""></i> Dashboard</a>
    <a href="manage_customers.php"><i class=""></i> Customers</a>
    <a href="manage_categorie.php">Category</a>
    <a href="manage_product.php"><i class=""></i> Product</a>
    <a href="manage_orders.php"><i class=""></i> Order</a>
    <a href="manage_payments.php"><i class=""></i> Payment</a>
    <a href="manage_feedback.php"><i class=""></i> Feedback</a>
</div>
<div class="container">
    <h2>💳 Admin Dashboard - Payment Records</h2>

    <?php if ($payments->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Total Amount (₹)</th>
                    <th>Payment Method</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $payments->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['payment_id'] ?></td>
                        <td><?= $row['order_id'] ?></td>
                        <td><?= htmlspecialchars($row['customer_name']) ?></td>
                        <td><?= number_format($row['total_amount'], 2) ?></td>
                        <td><?= $row['payment_method'] ?></td>
                        <td class="<?= $row['payment_status'] === 'Completed' ? 'status-completed' : 'status-pending' ?>">
                            <?= $row['payment_status'] ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align:center;">❌ No payment records found.</p>
    <?php endif; ?>
</div>
</body>
</html>
