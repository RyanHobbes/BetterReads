<?php
$friendsFile = 'friends.txt';

if ($_SERVER["REQUEST_METHOD"] === "POST" && !empty($_POST['friend'])) {
    $friend = htmlspecialchars(trim($_POST['friend']));
    file_put_contents($friendsFile, $friend . PHP_EOL, FILE_APPEND);
}

// Display friends
if (file_exists($friendsFile)) {
    $friends = file($friendsFile, FILE_IGNORE_NEW_LINES);
    echo "<ul>";
    foreach ($friends as $f) {
        echo "<li>" . htmlspecialchars($f) . "</li>";
    }
    echo "</ul>";
}
?>
