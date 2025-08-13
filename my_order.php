<?php 
session_start();
include('db_connect.php');

// Check if user is logged in
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// Secure query with JOIN to fetch product image and name
$stmt = $conn->prepare("
    SELECT 
        o.order_id, 
        o.quantity_option, 
        o.total_amount, 
        o.order_status, 
        o.order_date,
        p.product_name,
        p.product_image
    FROM orders o
    JOIN products p ON o.product_id = p.product_id
    WHERE o.customer_id = ?
    ORDER BY o.order_date DESC
");
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query Failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 16px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #333;
            color: white;
        }
        img {
            width: 60px;
            border-radius: 5px;
        }
        .cancelled {
            color: red;
            font-weight: bold;
        }
        .no-orders {
            text-align: center;
            font-size: 18px;
            color: #777;
            padding: 40px;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h2>🧾 My Orders</h2>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Quantity (KG)</th>
                    <th>Total (₹)</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['order_id'] ?></td>
                        <td><?= htmlspecialchars($row['product_name']) ?></td>
                        <td>
                            <?php if (!empty($row['product_image'])): ?>
                                <img src="data:image/jpeg;base64,<?= base64_encode($row['product_image']) ?>" alt="Product Image">
                            <?php else: ?>
                                <span>No Image</span>
                            <?php endif; ?>
                        </td>
                        <td><?= $row['quantity_option'] ?> KG</td>
                        <td>₹<?= number_format($row['total_amount'], 2) ?></td>
                        <td class="<?= $row['order_status'] === 'Cancelled' ? 'cancelled' : '' ?>">
                            <?= $row['order_status'] ?>
                        </td>
                        <td><?= $row['order_date'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-orders">You haven't placed any orders yet.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
