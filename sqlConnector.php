<?php
$databasePrefix = "cs366-2251_callahank18";
$netID = "callahank18";
$hostName = "washington.uww.edu";
$password = "kc8958";

//Construct Data Source Name
$dsn = "mysql:host=$hostName;dbname=$databasePrefix";

try {
    //Establish a connection
    $pdo = new PDO($dsn, $netID, $password);
    echo "Sucessfully connected to the database";


    $pdo = null;
} catch (PDOException $e) {
    echo "Connection failed: ".$e->getMessage();
}

function getBooksByAuthor($pdo, $authorName){
    $stmt = $pdo->prepare("CALL GetBooksByAuthor(:author)");
    $stmt ->bindParam(':author', $authorName, PDO::PARAM_STR);
    $stmt -> execute();
    $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}
?>
