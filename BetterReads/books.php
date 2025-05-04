<?php
$bookFile = 'books_data.csv';

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['book'])) {
    $book = htmlspecialchars(trim($_POST['book']));
    file_put_contents($bookFile, $book . PHP_EOL, FILE_APPEND);
}

// Display books
if (file_exists($bookFile)) {
    $books = file($bookFile, FILE_IGNORE_NEW_LINES);
    echo "<ul>";
    foreach ($books as $b) {
        echo "<li>" . htmlspecialchars($b) . "</li>";
    }
    echo "</ul>";
}
?>
