<?php 
include('db_connect.php');

// Handle Add to Cart POST request
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    // Fetch product details
    $stmt = $conn->prepare("SELECT product_name, product_price, product_image FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($product_name, $product_price, $product_image);
        $stmt->fetch();

        // Insert into cart
        $insert = $conn->prepare("INSERT INTO cart (product_id, product_name, product_price, product_image) VALUES (?, ?, ?, ?)");
        $insert->bind_param("isds", $product_id, $product_name, $product_price, $product_image);
        $insert->execute();
        $insert->close();
    }

    $stmt->close();
}

// Fetch all items from the cart
$sql = "SELECT * FROM cart";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cart</title>

      <!-- swiper link  -->
      <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
     <!-- cdn icon link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- custom css file  -->
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: #f9f9f9;
            font-family: 'Segoe UI', sans-serif;
            /* padding: 20px; */
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
        }

        .remove-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }

        .remove-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<h2>Your Shopping Cart</h2>

<?php if ($result && $result->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Price (₹)</th>
                <th>Date Added</th>
                <th>Remove</th>
                <th>Order</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $grand_total = 0;
            while ($row = $result->fetch_assoc()): 
                $grand_total += $row['product_price'];
            ?>
            <tr>
                <td>
                    <?php if (!empty($row['product_image'])): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($row['product_image']) ?>" alt="Product">
                    <?php else: ?>
                        <img src="images/no-image.png" alt="No Image">
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['product_name']) ?></td>
                <td><?= number_format($row['product_price'], 2) ?></td>
                <td><?= date('d M Y, h:i A', strtotime($row['added_at'])) ?></td>
                <td>
                    <form action="remove_cart.php" method="POST">
                        <input type="hidden" name="cart_id" value="<?= $row['cart_id'] ?>">
                        <button type="submit" class="remove-btn">Remove</button>
                    </form>
                </td>
                <td>
                <form action="order_now.php" method="POST" style="display:inline;">
    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
    <input type="hidden" name="product_name" value="<?= htmlspecialchars($row['product_name']) ?>">
    <input type="hidden" name="product_price" value="<?= $row['product_price'] ?>">
    <input type="hidden" name="product_image" value="<?= base64_encode($row['product_image']) ?>">
    <button type="submit" style="background-color: #28a745; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
        Order
    </button>
</form>
                    </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" style="text-align: right; font-weight: bold;">Grand Total</td>
                <td colspan="3" style="font-weight: bold;">₹<?= number_format($grand_total, 2) ?></td>
            </tr>
        </tfoot>
    </table>
<?php else: ?>
    <p style="text-align: center;">Your cart is empty.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>
</body>
</html>
