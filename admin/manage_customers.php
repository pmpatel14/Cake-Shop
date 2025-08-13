<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // Update this if your database has a password
$database = "cake_shop"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch customer data
$sql = "SELECT customer_id, first_name, last_name, email, date_of_birth, address, city, pincode, created_at FROM customers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer List</title>
    <style>

        body {
            font-family: Arial, sans-serif;
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
        }
        table {
            width: 65%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px #ccc;
        }
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: rgb(79,79, 79);
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
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

<h2>Customer List</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Date of Birth</th>
            <th>Address</th>
            <th>City</th>
            <th>Pincode</th>
            <th>Created At</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['customer_id']) ?></td>
                    <td><?= htmlspecialchars($row['first_name']) ?></td>
                    <td><?= htmlspecialchars($row['last_name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td><?= htmlspecialchars($row['date_of_birth']) ?></td>
                    <td><?= htmlspecialchars($row['address']) ?></td>
                    <td><?= htmlspecialchars($row['city']) ?></td>
                    <td><?= htmlspecialchars($row['pincode']) ?></td>
                    <td><?= htmlspecialchars($row['created_at']) ?></td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="9" style="text-align: center;">No customers found.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>

<?php
$conn->close();
?>
