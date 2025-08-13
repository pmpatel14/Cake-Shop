<?php     
include('db_connect.php');

// Fixed category ID
$category_id = 3;

// Fetch products from category 1
$stmt = $conn->prepare("SELECT * FROM products WHERE category_id = ?");
$stmt->bind_param("i", $category_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Pastry</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            background: #f7f9fc;
            font-family: 'Segoe UI', sans-serif;
        }

        .container {
            padding: 40px 20px;
        }

        h2 {
            margin-bottom: 30px;
            text-align: center;
        }

        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            justify-items: center;
        }

        .product-card {
            width: 250px;
            height: auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            transition: transform 0.2s ease;
        }

        .product-card:hover {
            transform: scale(1.03);
        }

        .product-img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .product-name {
            font-size: 16px;
            font-weight: bold;
            margin: 5px 0;
            text-align: center;
        }

        .product-price {
            font-size: 15px;
            color: #28a745;
            margin-bottom: 5px;
        }

        .product-desc {
            font-size: 13px;
            text-align: center;
            color: #555;
            margin-bottom: 10px;
        }

        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: auto;
            margin-bottom: 10px;
        }

        .btn {
            padding: 6px 12px;
            font-size: 13px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-cart {
            background-color: #007bff;
            color: white;
        }

        .btn-order {
            background-color: #28a745;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h2>All Pastry</h2>

    <div class="product-grid">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product-card">
                    <?php if (!empty($row['product_image'])): ?>
                        <img class="product-img" src="data:image/jpeg;base64,<?= base64_encode($row['product_image']) ?>" alt="Product Image">
                    <?php else: ?>
                        <img class="product-img" src="images/no-image.png" alt="No Image">
                    <?php endif; ?>
                    
                    <div class="product-name"><?= htmlspecialchars($row['product_name']) ?></div>
                    <div class="product-price">₹<?= number_format($row['product_price'], 2) ?></div>
                    <div class="product-desc"><?= htmlspecialchars($row['product_description']) ?></div>

                    <div class="btn-group">
                        <!-- Add to Cart Button -->
                        <form action="cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                            <button type="submit" class="btn btn-cart">Add to Cart</button>
                        </form>

                        <!-- Order Now Button -->
                        <form action="order_now.php" method="POST" style="display:inline;">
    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
    <input type="hidden" name="product_name" value="<?= htmlspecialchars($row['product_name']) ?>">
    <input type="hidden" name="product_price" value="<?= $row['product_price'] ?>">
    <input type="hidden" name="product_image" value="<?= base64_encode($row['product_image']) ?>">
    <button type="submit" style="background-color: #28a745; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
        Order Now
    </button>
</form>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-warning text-center">No products found in this category.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
