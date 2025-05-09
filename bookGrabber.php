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

    // preparing the sql to call the stored procedure
    $stmt = $pdo->prepare("CALL GetBooksReadByUser(:uid)");

    //bind the parameters
    $uid = 'AVCGYZL8FQQTD';
    $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);

    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "Book Title: ".$row['title']."<br>";
        echo "Date Read: ".$row['DateRead']."<br><br>";
    }

    $pdo = null;
} catch (PDOException $e) {
    echo "Connection failed: ".$e->getMessage();
}

?>
