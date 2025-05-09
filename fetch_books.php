<?php
include 'db_connect.php'; // Include database connection

$sql = "SELECT title, cover_image, link FROM books";
$result = $conn->query($sql);

$books = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($books);

$conn->close();
?>
