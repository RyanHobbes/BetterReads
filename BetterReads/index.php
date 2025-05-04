<?php
$file_path = 'books_data.csv';
$bookCount = 0;
if (($file = fopen($file_path, 'r')) !== false) {
    $header = fgetcsv($file);
    while (($row = fgetcsv($file)) !== FALSE) {
        $bookCount++;
    }
    fclose($file);
} else {
    die("Error: Could not open $file_path");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book & Friends Layout</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php include('./include/header/php'); ?>
  <div class="header">
    <header>
      <h1>📚 My BetterReads</h1>
      <ul class="navbar">
        <li><a href="signup.php">SIGN UP</a></li>
        <li><a href="index.php">HOME</a></li>
        <li><a href="#s">Friends</a></li>
        <li><a href="#">TBR</a></li>
        <li><a href="#">MY REVIEWS</a></li>
      </ul>
    </header>
  </div>

  <div class="container">
    <aside class="sidebar">
      <h2>👥 Friends List</h2>
      <ul>
        <li>Alice</li>
        <li>Bob</li>
        <li>Charlie</li>
      </ul>

      <section>
        <h2>⭐ Rate a Book</h2>
        <form id="rating-form">
          <label for="book-select">Choose a book:</label>
          <select id="book-select" name="book">
            <option value="The Great Gatsby">The Great Gatsby</option>
            <option value="1984">1984</option>
          </select>

          <div class="star-rating">
            <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 stars">★</label>
            <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars">★</label>
            <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars">★</label>
            <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars">★</label>
            <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 star">★</label>
          </div>

          <button type="submit">Submit Rating</button>
        </form>

        <div id="rating-result"></div>
      </section>
    </aside>

    <main class="main-content">
      <section class="marquee-section">
        <h2>📸 Featured Books</h2>
        <div class="marquee">
          <div class="marquee-content">
            <img src="book-covers-big-2019101610.jpg" alt="Book Cover 1">
            <img src="HP.jpg" alt="Harry Potter Cover">
            <img src="image001.jpg" alt="Book Cover 3">
          </div>
        </div>
      </section>

      <section>
        <h2>Book Recommendations</h2>
        <!-- Replace this block with PHP include on server -->
        <ul>
          <li><strong>1984</strong> by George Orwell</li>
          <li><strong>The Hobbit</strong> by J.R.R. Tolkien</li>
          <li><strong>Pride and Prejudice</strong> by Jane Austen</li>
        </ul>
      </section>
    </main>
  </div>

  <footer>
    <p>&copy; 2025 BetterReads</p>
  </footer>
</body>
</html>
