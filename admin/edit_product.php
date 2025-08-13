<?php
include('db_connect.php');

if (!isset($_GET['id'])) {
    echo "Invalid request.";
    exit;
}

$id = $_GET['id'];

// Fetch product
$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if (!$product) {
    echo "Product not found.";
    exit;
}

// Update on form submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $category_id = $_POST['category_id'];

    // Check if image is updated
    if ($_FILES['product_image']['size'] > 0) {
        $image_data = file_get_contents($_FILES['product_image']['tmp_name']);
        $stmt = $conn->prepare("UPDATE products SET product_name=?, category_id=?, product_price=?, product_image=? WHERE product_id=?");
        $stmt->bind_param("sidsi", $product_name, $category_id, $product_price, $image_data, $id);
    } else {
        $stmt = $conn->prepare("UPDATE products SET product_name=?, category_id=?, product_price=? WHERE product_id=?");
        $stmt->bind_param("sidi", $product_name, $category_id, $product_price, $id);
    }

    if ($stmt->execute()) {
        header("Location: manage_product.php?updated=true");
    } else {
        echo "Failed to update product.";
    }
    $stmt->close();
}

$categories = $conn->query("SELECT * FROM category");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"],
        input[type="number"],
        select,
        input[type="file"] {
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        button {
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            margin: 10px 0 0;
            font-size: 14px;
            color: #666;
        }

        @media (max-width: 600px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>
        <input type="number" step="0.01" name="product_price" value="<?= $product['product_price'] ?>" required>
        
        <select name="category_id" required>
            <?php while ($cat = $categories->fetch_assoc()): ?>
                <option value="<?= $cat['category_id'] ?>" <?= $cat['category_id'] == $product['category_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat['category_name']) ?>
                </option>
            <?php endwhile; ?>
        </select>

        <p>Upload new image (optional):</p>
        <input type="file" name="product_image" accept="image/*">

        <button type="submit">Update Product</button>
    </form>
</div>

</body>
</html>
