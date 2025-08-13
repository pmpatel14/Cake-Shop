<?php  
include 'db_connect.php'; // Connect to your database

// Fetch all feedback records
$query = "SELECT * FROM feedback ORDER BY feedback_date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 20px;
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

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            margin-left: 250px;
        }

        .feedback-table {
            width: calc(100% - 270px);
            margin: 0 auto 0 270px;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .feedback-table th, .feedback-table td {
            padding: 15px 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .feedback-table th {
            background-color: rgb(79,79,79);
            font-weight: bold;
            color: white;
        }

        .feedback-table tr:hover {
            background-color: #f9f9f9;
        }

        .stars {
            color: gold;
            font-size: 18px;
        }

        .message {
            white-space: pre-wrap;
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
    <a href="manage_orders.php">Order</a>
    <a href="manage_payments.php">Payment</a>
    <a href="manage_feedback.php">Feedback</a>
</div>

<h2>Customer Feedback</h2>

<table class="feedback-table">
    <thead>
        <tr>
            <th>Feedback ID</th>
            <th>Customer Name</th>
            <th>Date</th>
            <th>Rating</th>
            <th>Message</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= htmlspecialchars($row['feedback_id']) ?></td>
                <td><?= htmlspecialchars($row['customer_name']) ?></td>
                <td><?= date('d M Y, h:i A', strtotime($row['feedback_date'])) ?></td>
                <td class="stars">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <?= $i <= $row['rating'] ? "&#9733;" : "&#9734;" ?>
                    <?php endfor; ?>
                </td>
                <td class="message"><?= htmlspecialchars($row['message']) ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

</body>
</html>
