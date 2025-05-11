<!-- CREATE TABLE books (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL,
    cover_image VARCHAR(255) NOT NULL);
    
    CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    book_id INT NOT NULL,
    user VARCHAR(255) NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    review TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (book_id) REFERENCES books(id) ON DELETE CASCADE
); -->


<?php
session_start();
include 'db_connect.php'; // Connect to the database

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $book_id = $_POST['book_id'];
    $user = $_SESSION['username']; // Assuming user is logged in
    $rating = $_POST['rating'];
    $review = $_POST['review'];

    $stmt = $conn->prepare("INSERT INTO reviews (book_id, user, rating, review) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isis", $book_id, $user, $rating, $review);
    $stmt->execute();
    $stmt->close();
}

// Fetch books for dropdown
$books = $conn->query("SELECT id, title FROM books");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Reviews</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <div class="review_form">
    <h1>Submit a Review</h1>
    <form action="review.php" method="POST">
        <label for="book">Select Book:</label>
        <select name="book_id" required>
            <?php while ($row = $books->fetch_assoc()) { ?>
                <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['title']) ?></option>
            <?php } ?>
        </select>

        <label for="rating">Rating (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required>

        <label for="review">Review:</label>
        <textarea name="review" required></textarea>

        <button type="submit">Submit Review</button>
    </form>
    </div>

    <h2>Recent Reviews</h2>
    <?php
    $reviews = $conn->query("SELECT books.title, reviews.user, reviews.rating, reviews.review, reviews.created_at 
                             FROM reviews 
                             JOIN books ON reviews.book_id = books.id 
                             ORDER BY reviews.created_at DESC");

    while ($row = $reviews->fetch_assoc()) {
        echo "<div class='review'>";
        echo "<h3>" . htmlspecialchars($row['title']) . " - " . htmlspecialchars($row['user']) . "</h3>";
        echo "<p>Rating: " . $row['rating'] . "/5</p>";
        echo "<p>" . htmlspecialchars($row['review']) . "</p>";
        echo "<small>Reviewed on " . $row['created_at'] . "</small>";
        echo "</div>";
    }
    ?>
</body>
</html>
