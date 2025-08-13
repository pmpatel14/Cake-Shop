<?php   
include('db_connect.php'); // Database connection

// Fetch orders and join with products table to get the image
$query = "SELECT o.*, p.product_image 
          FROM orders o 
          LEFT JOIN products p ON o.product_id = p.product_id 
          ORDER BY o.order_date DESC";

$result = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Orders Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            padding: 40px;
            margin-left: 270px;
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
            padding: 15px 20px;
            color: #fff;
            display: block;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #007bff;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: rgb(79, 79, 79);
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            width: 60px;
            height: auto;
            border-radius: 6px;
        }

        p.no-orders {
            text-align: center;
            padding: 30px 0;
            color: #666;
            font-size: 18px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3>ADMIN DASHBOARD</h3>
    <a href="admindashboard.php">Dashboard</a>
    <a href="manage_customers.php">Customers</a>
    <a href="manage_categorie.php">Category</a>
    <a href="manage_product.php">Product</a>
    <a href="manage_orders.php">Orders</a>
    <a href="manage_payments.php">Payments</a>
    <a href="manage_feedback.php">Feedback</a>
</div>

<!-- Main Content -->
<div class="container">
    <h2>🛒 Order Management</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Customer Name</th>
                    <th>Address</th>
                    <th>Number</th>
                    <th>Quantity (KG)</th>
                    <th>Total (₹)</th>
                    <th>Status</th> <!-- Added Status Column -->
                    <th>Order Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['order_id'] ?></td>
                        <td><?= htmlspecialchars($row['product_name']) ?></td>
                        <td>
                            <?php if (!empty($row['product_image'])): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($row['product_image']) ?>" alt="Product">
                            <?php else: ?>
                                <span>No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['customer_name']) ?></td>
                        <td><?= htmlspecialchars($row['customer_address']) ?></td>
                        <td><?= htmlspecialchars($row['customer_number']) ?></td>
                        <td><?= $row['quantity_option'] ?> KG</td>
                        <td>₹<?= number_format($row['total_amount'], 2) ?></td>
                        <td>
    <?php if ($row['order_status'] === 'Cancelled by User'): ?>
        <span style="color: red; font-weight: bold;">Cancelled by User</span>
    <?php else: ?>
        <?= htmlspecialchars($row['order_status']) ?>
    <?php endif; ?>
</td>

                        <td><?= $row['order_date'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-orders">No orders found.</p>
    <?php endif; ?>
</div>

</body>
</html>
