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
            <p>Books Read This Year: <span id="books-read">0</span></p>
        </div>
        <div class="stat">
            <p>Hours Spent Reading: <span id="hours-read">0</span></p>
        </div>
        <button id="update-reading">Update Progress</button>
    </div>
</header>

        
    </header>
    <section id="book-carousel">
    <h2>Recommended Books</h2>
    <div class="carousel-container">
        <button id="prevBtn">❮</button>
        <div class="carousel" id="carousel-content">
            <!-- Books will be loaded dynamically here -->
        </div>
        <button id="nextBtn">❯</button>
    </div>
</section>


<h2>Your Book Lists</h2>
    <section id="book-lists">
        
        <br>
        <div class="read-list">
            <h3>Books You've Read</h3>
            <ul id="read-list">
                <li>Example Book 1</li>
                <li>Example Book 2</li>
                <!-- More books will be dynamically loaded -->
            </ul>
        </div>

        <div class="unread-list">
            <h3>Books You Want to Read</h3>
            <ul id="want-to-read-list">
                <li>Example Book 3</li>
                <li>Example Book 4</li>
                <!-- More books will be dynamically loaded -->
            </ul>
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

    <footer>
        <p>&copy; 2025 BetterReads. All rights reserved.</p>
    </footer>
</body>
</html>
