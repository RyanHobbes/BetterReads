<?php
$servername = "washington.uww.edu";
$username = "callahank18";
$password = "kc8958";
$dbname = "cs366-2251_callahank18";

// Connect to database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch books
$sql = "SELECT title, cover_image, link FROM books";
$result = $conn->query($sql);

$books = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
}

// Return JSON response
echo json_encode($books);

$conn->close();
?>
