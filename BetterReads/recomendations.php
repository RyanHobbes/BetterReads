<?php
// Database connection
$host = "localhost";
$dbname = "book_db";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Query to fetch the highest rated book with decent reviews (e.g., >10 reviews)
    $stmt = $pdo->prepare("
        SELECT * FROM books
        WHERE review_count >= 10
        ORDER BY rating DESC, review_count DESC
        LIMIT 1
    ");
    $stmt->execute();
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Recommended Book</title>
</head>
<body>
    <h1>📚 Book Recommendation</h1>
    <?php if ($book): ?>
        <h2><?php echo htmlspecialchars($book['title']); ?></h2>
        <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
        <p><strong>Rating:</strong> <?php echo number_format($book['rating'], 1); ?> ⭐</p>
        <p><strong>Reviews:</strong> <?php echo $book['review_count']; ?></p>
    <?php else: ?>
        <p>No suitable book found.</p>
    <?php endif; ?>
</body>
</html>
