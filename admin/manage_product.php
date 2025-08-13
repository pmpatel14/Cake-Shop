<?php 
include('db_connect.php');

// Insert product if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $category_id = $_POST['category_id'];
    $product_price = $_POST['product_price'];
    $image_data = file_get_contents($_FILES['product_image']['tmp_name']);

    $stmt = $conn->prepare("INSERT INTO products (product_name, category_id, product_price, product_image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sids", $product_name, $category_id, $product_price,  $image_data);

    if ($stmt->execute()) {
        $message = "✅ Product added successfully!";
    } else {
        $message = "❌ Failed to add product.";
    }
    $stmt->close();
}

// Fetch categories for dropdown
$categories = $conn->query("SELECT * FROM category");

// Fetch all products with category name
$products = $conn->query("SELECT p.*, c.category_name FROM products p LEFT JOIN category c ON p.category_id = c.category_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Products</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f2f2f2;
            padding: 30px;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
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
            text-align: left;
            color: #000;
            font-size: 28px;
        }
        .message {
            padding: 12px;
            background: #e0ffe0;
            border-left: 6px solid #28a745;
            margin-bottom: 20px;
            border-radius: 8px;
            color: #155724;
        }

        .add-product-form {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .add-product-form input,
        .add-product-form select {
            flex: 1;
            min-width: 140px;
            padding: 10px 12px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #fff;
        }

        .add-product-form input:focus,
        .add-product-form select:focus {
            outline: none;
            border-color: #007bff;
        }

        .add-product-form button {
            padding: 12px 18px;
            background-color: #0069d9;
            color: #fff;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .add-product-form button:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background: rgb(79, 79, 79);
            color: white;
        }
        img {
            width: 80px;
            height: auto;
            border-radius: 6px;
        }

        .action-btn {
            display: inline-block;
            padding: 8px 14px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 6px;
            margin-right: 6px;
            transition: background-color 0.2s ease-in-out;
        }

        .edit-btn {
            background-color: #28a745;
            color: white;
        }

        .edit-btn:hover {
            background-color: #218838;
        }

        .delete-btn {
            background-color: #dc3545;
            color: white;
        }

        .delete-btn:hover {
            background-color: #c82333;
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

<!-- Main Container -->
<div class="container" style="margin-left: 350px;">
    <h2>ADD PRODUCTS</h2>

    <?php if (isset($message)) echo "<div class='message'>$message</div>"; ?>

    <form method="POST" enctype="multipart/form-data" class="add-product-form">
        <input type="text" name="product_name" placeholder="Product Name" required>
        <input type="number" step="0.01" name="product_price" placeholder="Price" required>

        <select name="category_id" required>
            <option value="">Category</option>
            <?php while ($cat = $categories->fetch_assoc()): ?>
                <option value="<?= $cat['category_id'] ?>"><?= htmlspecialchars($cat['category_name']) ?></option>
            <?php endwhile; ?>
        </select>

        <input type="file" name="product_image" accept="image/*" required>

        <button type="submit" name="add_product">Add Product</button>
    </form>

    <h2>All Products</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Price (₹)</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $products->fetch_assoc()): ?>
            <tr>
                <td><?= $row['product_id'] ?></td>
                <td><?= htmlspecialchars($row['product_name']) ?></td>
                <td><?= htmlspecialchars($row['category_name'] ?? 'N/A') ?></td>
                <td><?= number_format($row['product_price'], 2) ?></td>
                <td><img src="data:image/jpeg;base64,<?= base64_encode($row['product_image']) ?>" alt="Product Image"></td>
                <td>
                    <a href="edit_product.php?id=<?= $row['product_id'] ?>" class="action-btn edit-btn">Edit</a>
                    <a href="delete_product.php?id=<?= $row['product_id'] ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>
