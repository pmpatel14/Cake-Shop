<?php 
session_start();
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    // Handle form submission and insert into orders table
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $customer_name = $_POST['customer_name'];
    $customer_address = $_POST['customer_address'];
    $customer_number = $_POST['customer_number'];
    $customer_id = $_SESSION['customer_id'];
    $quantity_option = $_POST['quantity_option'];
    $total_amount = $_POST['total_amount'];

    $stmt = $conn->prepare("INSERT INTO orders (product_id, product_name, product_image, customer_name, customer_address, customer_number, quantity_option, total_amount,customer_id, order_date )
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?,?,  NOW())");
    
    // Fixed bind_param string: i = int, s = string, d = double
    $stmt->bind_param("isssssidi", $product_id, $product_name, $product_image, $customer_name, $customer_address, $customer_number, $quantity_option, $total_amount, $customer_id);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;
        $stmt->close();
        header("Location: payment.php?order_id=$order_id");
        exit();
    } else {
        echo "❌ Failed to place order: " . $stmt->error;
        exit();
    }

} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Display product order form
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image']; // base64 encoded
} else {
    echo "No product selected.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Place Your Order</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f4;
            padding: 40px;
        }

        .order-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            font-size:16px;
        }

        img {
            width: 100%;
            max-height: 300px;
            object-fit: contain;
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            background: #007bff;
            color: white;
            padding: 10px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<div class="order-container">
    <h2>Order This Product</h2>
    <img src="data:image/jpeg;base64,<?= $product_image ?>" alt="Product Image">
    <p><strong>Product:</strong> <?= htmlspecialchars($product_name) ?></p>
    <p><strong>Price (per kg):</strong> ₹<?= number_format($product_price, 2) ?></p>

    <form method="POST">
        <!-- Hidden fields -->
        <input type="hidden" name="product_id" value="<?= $product_id ?>">
        <input type="hidden" name="product_name" value="<?= htmlspecialchars($product_name) ?>">
        <input type="hidden" name="product_price" id="product_price" value="<?= $product_price ?>">
        <input type="hidden" name="product_image" value="<?= $product_image ?>">
        <input type="hidden" name="total_amount" id="total_amount">
        <input type="hidden" name="place_order" value="1">

        <!-- Customer details -->
        <input type="text" name="customer_name" placeholder="Your Name" required>
        <input type="text" name="customer_address" placeholder="Delivery Address" required>
        <input type="text" name="customer_number" placeholder="Phone Number" required>

        <!-- Quantity selection -->
        <select name="quantity_option" id="quantity_option" required onchange="updateTotal()">
            <option value="">Select Quantity</option>
            <option value="1">100 GM</option>
            <option value="2">500 GM</option>
            <option value="3">1 KG</option>
            <option value="4">2 KG</option>
        </select>

        <!-- Total Display -->
        <p><strong>Total: ₹<span id="display_total">0.00</span></strong></p>

        <button type="submit">Place Order</button>
    </form>
</div>

<script>
    function updateTotal() {
        let price = parseFloat(document.getElementById('product_price').value);
        let qty = document.getElementById('quantity_option').value;
        let qtyNum = parseInt(qty);

        if (!isNaN(qtyNum)) {
            let total = price * qtyNum;
            document.getElementById('total_amount').value = total.toFixed(2);
            document.getElementById('display_total').textContent = total.toFixed(2);
        } else {
            document.getElementById('total_amount').value = '';
            document.getElementById('display_total').textContent = '0.00';
        }
    }
</script>

</body>
</html>  