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

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'incrementHours') {
    addHours($pdo);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

    ?>


<form method="POST">
    <?php
            $hoursReading = getHours($pdo);
            ?>
            Hours Read This Year: <span id="hours-read"><?php echo $hoursReading[0]['HoursRead'];?> </span>
    <input type="hidden" name="action" value="incrementHours">
    <button type="submit">➕</button>
</form>

    </div>
</div>

        
    </header>
    <section id="book-carousel">
    <h2>Recommended Books</h2>
    <div class="carousel-container">
        <button id="prevBtn">❮</button>
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
        <button id="nextBtn">❯</button>
    </div>
</section>


<h2>Your Book Lists</h2>
    <section id="book-lists">

        <br>
        <div class="to-be-read-list">
            <h3>Books You've Read</h3>
            <ul id="read-list">
                <?php 
                $booksYouveRead = $pdo ? getUserBooksReadImages($pdo): [];

                foreach ($booksYouveRead as $book){
                    echo '<img src="' . htmlspecialchars($book) . '" alt="Book cover" style="width:200px;height:auto;">';

                }
                ?>
                <!-- More books will be dynamically loaded -->
            </ul>
        </div>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addBook'])) {
          $title = trim($_POST['title']);
          if (!empty($title) && $pdo) {
              addBookToWillReadList($pdo, $title);
           }
        }
        ?>


        <div class="read-list">
        <h3>Your Read List:</h3>
        <form method="POST">
        <input type="text" name="title" placeholder="Enter book title" required>
        <button type="submit"name = "addBook">Add Book</button>
        </form>

          <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['removeBook'])) {
          $title = trim($_POST['title']);
          if (!empty($title) && $pdo) {
              removeBookFromWillReadList($pdo, $title);
           }
        }
        ?>


        <form method="POST">
        <input type="text" name="title" placeholder="Enter book title" required>
        <button type="submit" name="removeBook">Remove Book</button>
        </form>
    <?php 
    $results = $pdo ? getUserBooksReadImages($pdo): [];
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

   <?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submitReview') {
    $title = trim($_POST['title']);
    $text = trim($_POST['text']);
    $score = intval($_POST['score']); // Make sure it's an integer

    if (!empty($title) && !empty($text) && $score > 0) {
        leaveBookReview($pdo, $title, $score, $text);
        header("Location: " . $_SERVER['PHP_SELF']); // Refresh to clear POST
        exit();
    } else {
        echo "<p>Please fill out all fields and select a rating.</p>";
    }
}

?>

<section id="reviews">
    <h2>Leave a Review</h2>
    <form id="review-form" method="POST">
        <input type="hidden" name="action" value="submitReview">

        <label for="book-title">Book Title:</label>
        <input type="text" id="book-title" name="title" required>

        <label for="review-text">Your Review:</label>
        <textarea id="review-text" name="text" required></textarea>

        <div class="star-rating">
            <label>
                <input type="radio" name="score" value="1" required>
                ★
            </label>
            <label>
                <input type="radio" name="score" value="2">
                ★★
            </label>
            <label>
                <input type="radio" name="score" value="3">
                ★★★
            </label>
            <label>
                <input type="radio" name="score" value="4">
                ★★★★
            </label>
            <label>
                <input type="radio" name="score" value="5">
                ★★★★★
            </label>
        </div>

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