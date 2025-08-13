<?php   
include('db_connect.php');

// Handle form submission to add a new category
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category_name']) && !isset($_POST['edit_id'])) {
    $category_name = trim($_POST['category_name']);
    if (!empty($category_name)) {
        $stmt = $conn->prepare("INSERT INTO category (category_name) VALUES (?)");
        $stmt->bind_param("s", $category_name);
        $stmt->execute();
        $stmt->close();
        header("Location: manage_categorie.php");
        exit();
    }
}

// Handle form submission to update a category
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_id'])) {
    $edit_id = intval($_POST['edit_id']);
    $category_name = trim($_POST['category_name']);
    if (!empty($category_name)) {
        $stmt = $conn->prepare("UPDATE category SET category_name = ? WHERE category_id = ?");
        $stmt->bind_param("si", $category_name, $edit_id);
        $stmt->execute();
        $stmt->close();
        header("Location: manage_categorie.php");
        exit();
    }
}

// Handle delete action
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $conn->query("DELETE FROM category WHERE category_id = $delete_id");
    header("Location: manage_categorie.php");
    exit();
}

// Handle edit action (fetch data)
$edit_category = null;
if (isset($_GET['edit'])) {
    $edit_id = intval($_GET['edit']);
    $edit_result = $conn->query("SELECT * FROM category WHERE category_id = $edit_id");
    if ($edit_result->num_rows > 0) {
        $edit_category = $edit_result->fetch_assoc();
    }
}

// Fetch all categories
$result = $conn->query("SELECT * FROM category");
if (!$result) {
    die("Query Failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', sans-serif;
            padding: 20px;
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

        .container {
            margin-top: 40px;
            margin-left: 225px;
        }

        h2 {
            margin-bottom: 20px;
        }

        table {
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-delete:hover {
            background-color: #b02a37;
        }

        .form-inline {
            margin-bottom: 30px;
        }

        .form-inline input {
            width: 300px;
            display: inline-block;
            margin-right: 10px;
        }

        .form-inline button {
            vertical-align: top;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #000;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn-edit:hover {
            background-color: #e0a800;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <h3 style="text-align:center;">ADMIN DASHBOARD</h3>
    <a href="admindashboard.php">Dashboard</a>
    <a href="manage_customers.php">Customers</a>
    <a href="manage_categorie.php">Category</a>
    <a href="manage_product.php">Product</a>
    <a href="manage_orders.php">Order</a>
    <a href="manage_payments.php">Payment</a>
    <a href="manage_feedback.php">Feedback</a>
</div>

<div class="container">
    <h2>Manage Categories</h2>

    <!-- Add or Edit Category Form -->
    <form method="POST" class="form-inline">
        <input type="text" name="category_name" class="form-control" placeholder="Enter category name" required
               value="<?= $edit_category ? htmlspecialchars($edit_category['category_name']) : '' ?>">
        <?php if ($edit_category): ?>
            <input type="hidden" name="edit_id" value="<?= $edit_category['category_id'] ?>">
            <button type="submit" class="btn btn-warning">Update Category</button>
            <a href="manage_categorie.php" class="btn btn-secondary">Cancel</a>
        <?php else: ?>
            <button type="submit" class="btn btn-primary">Add Category</button>
        <?php endif; ?>
    </form>

    <!-- Category List Table -->
    <table class="table table-bordered">
        <thead class="table-dark">
        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['category_id'] ?></td>
                <td><?= htmlspecialchars($row['category_name']) ?></td>
                <td>
                    <a href="manage_categorie.php?edit=<?= $row['category_id'] ?>" class="btn-edit">Edit</a>
                </td>
                <td>
                    <a href="manage_categorie.php?delete=<?= $row['category_id'] ?>" class="btn-delete"
                       onclick="return confirm('Are you sure you want to delete this category?')">
                        Delete
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
