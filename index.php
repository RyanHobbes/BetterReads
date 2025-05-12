<?php
require_once 'bookGrabber.php'; // This should contain the getBookImage() function
// Connect to the database
$pdo = getpdo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Review & Recommendations</title>
    <link rel="stylesheet" href="style.css"> <!-- Linking CSS file -->
</head>
<body>
<header>
    <h1>Welcome to Your BetterReads 📚</h1>
    <p>Discover, review, and share your favorite books with friends!</p>
    
<!-- Reading Stats -->
<div id="reading-stats">
    <div class="stat">
        <p>
            Books Read This Year: <span id="books-read">0</span>
            <button class="add-btn" onclick="incrementStat('books-read')">➕</button>
        </p>
    </div>
    <div class="stat">
        <p>
            Hours Spent Reading: <span id="hours-read">0</span>
            <button class="add-btn" onclick="incrementStat('hours-read')">➕</button>
        </p>
    </div>
    <button id="update-reading">Update Progress</button>
</div>
<script>
function incrementStat(id) {
    const el = document.getElementById(id);
    let currentValue = parseInt(el.textContent);
    el.textContent = currentValue + 1;
}
</script>
        
    </header>
    <section id="book-carousel">
    <h2>Recommended Books</h2>
    <div class="carousel-container">
        <div class="carousel" id="carousel-content">
            <!-- Books will be loaded dynamically here -->
            <?php
            $bookTitle = "Whispers of the Wicked Saints";
            $images = $pdo ? getBookImagesByCategory($pdo, "['Computers']"): [];

            //$images = getBookImage($pdo, $bookTitle);
            foreach ($images as $image) {
    echo '<img src="' . htmlspecialchars($image['Image']) . '" alt="' . htmlspecialchars($bookTitle) . '" style="width:200px;height:auto;">';
}
            ?>
        </div>
    </div>
</section>


<h2>Your Book Lists</h2>
    <section id="book-lists">
        
        <br>
        <div class="to-be-read-list">
            <h3>Books You've Read</h3>
            <ul id="read-list">
                <li>Example Book 1</li>
                <li>Example Book 2</li>
                <?php $booksYouveRead = $pdo ? getUserBooksReadImages($pdo): [];
                echo $booksYouveRead;
                ?>
                <!-- More books will be dynamically loaded -->
            </ul>
        </div>

        <div class="read-list">
        <h3>Your Read List:</h3>
        <form method="POST">
        <input type="text" name="title" placeholder="Enter book title" required>
        <button type="submit">Add Book</button>
        </form>
    <?php 
    $pdo = getpdo();
    $results = $pdo ? getUserBooksReadImages($pdo): [];
            echo($results);
            echo 'Result count: ' . count($results);
    ?>
        </div>
    </section>



    <section id="friends-list">
        <h2>Your Friends</h2>
        <ul id="friends">
            <li>Friend 1</li>
            <li>Friend 2</li>
            <!-- More friends will be dynamically loaded -->
        </ul>
    </section>

    <section id="reviews">
    <h2>Leave a Review</h2>
    <form id="review-form">
        <label for="book-title">Book Title:</label>
        <input type="text" id="book-title" name="book-title" required>

        <label for="review-text">Your Review:</label>
        <textarea id="review-text" name="review-text" required></textarea>

        <!-- Star Rating System -->
        <div class="star-rating">
            <span class="star" data-value="1">★</span>
            <span class="star" data-value="2">★</span>
            <span class="star" data-value="3">★</span>
            <span class="star" data-value="4">★</span>
            <span class="star" data-value="5">★</span>
        </div>
        <input type="hidden" id="rating" name="rating" value="0"> <!-- Stores rating -->

        <button type="submit">Submit Review</button>
    </form>
</section>

<!-- Previous Reviews Section -->
 <div class = "previous-reviews">
<section id="previous-reviews">
    <h2>Previous Reviews</h2>
    <label for="review-select">Select a Review:</label>
    <select id="review-select">
        <option value="review-select">-- Choose a review --</option>
        <option value="review1">Review for "Example Book 1"</option>
        <option value="review2">Review for "Example Book 2"</option>
    </select>

    <div id="review-display" class="review-box">
        <p><strong>Selected Review:</strong></p>
        <p id="review-content">No review selected.</p>
    </div>
</section>
</div>

    <footer>
        <p>&copy; 2025 BetterReads. All rights reserved.</p>
    </footer>
</body>
</html>