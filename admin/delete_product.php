<?php
include 'db_connect.php';

$product_id = intval($_GET['id']);

// Fetch image to delete from disk
$result = mysqli_query($conn, "SELECT product_image FROM products WHERE product_id = $product_id");
$row = mysqli_fetch_assoc($result);
$image_path = $row['product_image'];

// Delete product from database
$delete_sql = "DELETE FROM products WHERE product_id = $product_id";

if (mysqli_query($conn, $delete_sql)) {
    // Delete image file from server
    if (!empty($image_path) && file_exists($image_path)) {
        unlink($image_path);
    }
    header("Location: manage_product.php");
    exit();
} else {
    echo "Error deleting product: " . mysqli_error($conn);
}
?>
