<?php
include 'db.php'; // Ensure this file sets up $conn

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs
    $book_title = trim($_POST['book-title']);
    $review_text = trim($_POST['review-text']);
    $rating = (int)$_POST['rating'];

    if (!empty($book_title) && !empty($review_text)) {
        $stmt = $conn->prepare("INSERT INTO reviews (book_title, review_text, rating) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $book_title, $review_text, $rating);

        if ($stmt->execute()) {
            header("Location: index.php?success=1");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill in all required fields.";
    }
}

$conn->close();
?>
