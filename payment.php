<?php 
include('db_connect.php');
$message = "";

// Fetch latest order
$order = $conn->query("SELECT * FROM orders ORDER BY order_id DESC LIMIT 1")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_payment'])) {
    $order_id = $_POST['order_id'];
    $customer_name = $_POST['customer_name'];
    $total_amount = $_POST['total_amount'];
    $payment_method = $_POST['payment_method'];

    // Set payment_status based on method
    $payment_status = ($payment_method === 'UPI') ? 'Completed' : 'Pending';

    // Insert into 'payments' table
    $insert = $conn->prepare("
        INSERT INTO payments 
        (order_id, customer_name, total_amount, payment_method, payment_status) 
        VALUES (?, ?, ?, ?, ?)
    ");
    $insert->bind_param("isdss", $order_id, $customer_name, $total_amount, $payment_method, $payment_status);

    if ($insert->execute()) {
        header("Location: order_successfull.php");
        exit();
    } else {
        $message = "❌ Payment failed to process.";
    }

    $insert->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f0f0f0;
            padding: 40px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        .message {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            color: #155724;
            background-color: #d4edda;
            border-left: 6px solid #28a745;
        }
        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            background: #007bff;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background: #0069d9;
        }
        #upi-section {
            display: none;
            text-align: center;
            margin-top: 20px;
        }
        #upi-section img {
            width: 200px;
            border-radius: 8px;
        }
    </style>
    <script>
        function toggleUPI() {
            var method = document.getElementById("payment_method").value;
            document.getElementById("upi-section").style.display = (method === "UPI") ? "block" : "none";
        }
    </script>
</head>
<body>

<div class="container">
    <h2>Confirm Your Payment</h2>

    <?php if ($message): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <?php if ($order): ?>
        <form method="POST">
            <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
            <input type="hidden" name="customer_name" value="<?= htmlspecialchars($order['customer_name']) ?>">
            <input type="hidden" name="total_amount" value="<?= $order['total_amount'] ?>">

            <label>Customer Name:</label>
            <input type="text" value="<?= htmlspecialchars($order['customer_name']) ?>" readonly>

            <label>Total Amount (₹):</label>
            <input type="text" value="<?= number_format($order['total_amount'], 2) ?>" readonly>

            <label for="payment_method">Choose Payment Method</label>
            <select name="payment_method" id="payment_method" onchange="toggleUPI()" required>
                <option value="">-- Select --</option>
                <option value="Cash on Delivery">Cash on Delivery</option>
                <option value="UPI">UPI</option>
            </select>

            <div id="upi-section">
                <p><strong>Scan the QR code below to pay using UPI</strong></p>
                <img src="upi_qr.png" alt="UPI QR Code">
            </div>

            <button type="submit" name="submit_payment">Submit Payment</button>
        </form>
    <?php else: ?>
        <p style="text-align: center;">❌ No order found.</p>
    <?php endif; ?>
</div>

</body>
</html>
