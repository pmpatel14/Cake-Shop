<?php 
session_start();
include 'db_connect.php'; // make sure this connects to your DB

// Check if customer is logged in
if (!isset($_SESSION['customer_id'])) {
    echo "<div style='text-align:center; margin-top: 100px; font-size: 20px;'>Please log in to submit feedback.</div>";
    echo "<script>setTimeout(function(){ window.location.href='customer_login.php'; }, 3000);</script>";
    exit;
}

$customer_id = $_SESSION['customer_id'];
$customer_name = $_SESSION['customer_name']; // Ensure you store this at login

$message = $rating = "";
$success = $error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = trim($_POST["message"]);
    $rating = intval($_POST["rating"]);

    if (empty($message) || $rating < 1 || $rating > 5) {
        $error = "Please enter a message and select a rating between 1 and 5.";
    } else {
        $sql = "INSERT INTO feedback (customer_id, customer_name, message, rating) 
                VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issi", $customer_id, $customer_name, $message, $rating);

        if ($stmt->execute()) {
            $success = "Thank you for your feedback!";
        } else {
            $error = "Error submitting feedback: " . $conn->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Submit Feedback</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">

    <style>
        .container {
            max-width: 650px;
            height: 300px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background: #fff;
        }
        textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
        }
        button {
            padding: 10px;
            width: 100%;
            margin-top: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            border-radius: 5px;
        }

        .map h2 {
      color: #1b1722;
      margin-bottom: 20px;
    }

    .map iframe {
      width: 100%;
      height: 400px;
      border: none;
      border-radius: 8px;
    }
        .success { color: green; text-align: center; margin-bottom: 10px; }
        .error { color: red; text-align: center; margin-bottom: 10px; }

        .star-rating {
            direction: rtl;
            display: flex;
            justify-content: flex-start;
            margin-bottom: 10px;
        }
        .star-rating input[type="radio"] {
            display: none;
        }
        .star-rating label {
            font-size: 30px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
        }
        .star-rating input[type="radio"]:checked ~ label,
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: gold;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h2>Submit Your Feedback</h2>

    <?php if ($success): ?><p class="success"><?= $success ?></p><?php endif; ?>
    <?php if ($error): ?><p class="error"><?= $error ?></p><?php endif; ?>

    <form method="POST" action="">
        <label for="message">Your Message:</label><br>
        <textarea name="message" required><?= htmlspecialchars($message) ?></textarea><br>

        <label>Your Rating:</label><br>
        <div class="star-rating">
            <?php for ($i = 5; $i >= 1; $i--): ?>
                <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" <?= $rating == $i ? "checked" : "" ?> />
                <label for="star<?= $i ?>" title="<?= $i ?> stars">&#9733;</label>
            <?php endfor; ?>
        </div>

        <button type="submit">Submit Feedback</button>
    </form>
</div>
<!-- Google Map (Ahmedabad Area) -->
<div class="map">
    <h2>Find Us in Ahmedabad</h2>
    <iframe
      src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3670.482474593237!2d72.57136271541784!3d23.03051358494262!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e84f20c7a16c9%3A0xbcdd37a52f6c67f1!2sAhmedabad%2C%20Gujarat!5e0!3m2!1sen!2sin!4v1640000000000!5m2!1sen!2sin"
      allowfullscreen=""
      loading="lazy"
      referrerpolicy="no-referrer-when-downgrade">
    </iframe>
  </div>

<?php include 'footer.php'; ?>

</body>
</html>
