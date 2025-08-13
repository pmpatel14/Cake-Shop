<?php
include('db_connect.php');

// Check if cart_id is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id'])) {
    $cart_id = $_POST['cart_id'];

    // Delete item from cart
    $stmt = $conn->prepare("DELETE FROM cart WHERE cart_id = ?");
    $stmt->bind_param("i", $cart_id);

    if ($stmt->execute()) {
        // Redirect back to cart page
        header("Location: cart.php");
        exit();
    } else {
        echo "Failed to remove item from cart.";
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
?>
