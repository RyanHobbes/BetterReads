<?php
function getpdo() {
    $databasePrefix = "cs366-2251_callahank18";
    $netID = "callahank18";
    $hostName = "washington.uww.edu";
    $password = "kc8958";

    // Construct Data Source Name
    $dsn = "mysql:host=$hostName;dbname=$databasePrefix";

    try {
        // Establish a connection
        $pdo = new PDO($dsn, $netID, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Successfully connected to the database<br>";
        return $pdo;
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}
function connectToDatabase(){
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
}


function getBooksByAuthor($pdo, $authorName){
    $stmt = $pdo->prepare("CALL GetBooksByAuthor(:author)");
    $stmt ->bindParam(':author', $authorName, PDO::PARAM_STR);
    $stmt -> execute();
    $results = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}
/**
 * Retrieves Reviews and Book titles by joining the Reviews and Books tables.
 * 
 * This function calls the stored procedure `GetReviewsAndBooks()` to fetch the review ID and corresponding book title.
 * It doesn't take any input parameters.
 */
function getReviewsAndBooks($pdo){
    $stmt = $pdo->prepare("CALL GetReviewsAndBooks()");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}

/**
 * Retrieves books read by a user, identified by the user ID.
 * 
 * This function calls the stored procedure `GetBooksReadByUser()` and passes the user ID to it. It fetches the book titles and the corresponding dates when the books were read by the specified user.
 */
function getBooksReadByUser($pdo, $uid){
    $stmt = $pdo->prepare("CALL GetBooksReadByUser(:uid)");
    $stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}

/**
 * Retrieves the email addresses of all users.
 * 
 * This function calls the stored procedure `GetAllUserEmails()` and fetches the email addresses of all users in the User table.
 * It doesn't take any input parameters.
 */
function getAllUserEmails($pdo){
    $stmt = $pdo->prepare("CALL GetAllUserEmails()");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}
/**
 * Retrieves the image associated with a specific book by its title.
 * 
 * This function calls the stored procedure `GetBookImage()` and passes the book title to it. It fetches the image of the book from the Book table.
 */
function getBookImage($pdo, $bookTitle){
    $stmt = $pdo->prepare("CALL GetBookImage(:bookTitle)");
    $stmt->bindParam(':bookTitle', $bookTitle, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}
/**
 * Retrieves the review IDs of reviews made within a specific date range.
 * 
 * This function calls the stored procedure `getReviewsOnDate()` to retrieve reviews made within a given time range.
 * It doesn't take any input parameters and filters reviews by a fixed time range in the procedure.
 */
function getReviewsOnDate($pdo){
    $stmt = $pdo->prepare("CALL getReviewsOnDate()");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}
/**
 * Retrieves the titles of books published by 'Scholastic'.
 * 
 * This function calls the stored procedure `publisherOfBook()` and fetches the titles of books published by the 'Scholastic' publisher.
 * It doesn't take any input parameters.
 */
function publisherOfBook($pdo, $publisherName){
    $stmt = $pdo->prepare("CALL publisherOfBook()");
    $stmt->bindParam(':publisherName', $publisherName, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}

/**
 * Retrieves all mutual friends of a user based on the username.
 * 
 * This function calls the stored procedure `getAllMutualFriendsOf()` to fetch mutual friends from the Friend and User tables.
 * It doesn't take any input parameters.
 */
function getAllMutualFriendsOf($pdo){
    $stmt = $pdo->prepare("CALL getAllMutualFriendsOf()");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}
/**
 * Retrieves all friends from the Friend table.
 * 
 * This function calls the stored procedure `GetAllFriends()` and retrieves all friend relationships from the Friend table.
 * It doesn't take any input parameters.
 */
function getAllFriends($pdo){
    $stmt = $pdo->prepare("CALL GetAllFriends()");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}
/**
 * Retrieves all users from the User table.
 * 
 * This function calls the stored procedure `GetAllUsers()` and fetches all user records from the User table.
 * It doesn't take any input parameters.
 */
function getAllUsers($pdo){
    $stmt = $pdo->prepare("CALL GetAllUsers()");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}
/**
 * Retrieves all reviews from the Reviews table.
 * 
 * This function calls the stored procedure `GetAllReviews()` to fetch all review records from the Reviews table.
 * It doesn't take any input parameters.
 */
function getAllReviews($pdo){
    $stmt = $pdo->prepare("CALL GetAllReviews()");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}
/**
 * Retrieves all books from the Book table. This function call will crash the server. Database too large
 * 
 * This function calls the stored procedure `GetAllBooks()` to fetch all book records from the Book table.
 * It doesn't take any input parameters.
 
*function getAllBooks($pdo){
*    $stmt = $pdo->prepare("CALL GetAllBooks()");
*    $stmt->execute();
*    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
*    $stmt->closeCursor();
*    return $results;
*}
    */
/**
 * Retrieves books by their category.
 * 
 * This function calls the stored procedure `GetBooksByCategory()` and passes a category name to it. It retrieves the titles of books belonging to that category.
 */

 function getBooksPaginated($pdo, $limit = 100, $offset = 0) {
    $stmt = $pdo->prepare("SELECT * FROM books LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}

function getBooksByCategory($pdo, $category){
    $stmt = $pdo->prepare("CALL getBooksByCategory(:category)");
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}
/**
 * Retrieves the titles of books ordered by the date they were read.
 * 
 * This function calls the stored procedure `OrderOfBooksRead()` to fetch books in the order they were read, based on a 'hasRead' condition.
 * It doesn't take any input parameters.
 */
function orderOfBooksRead($pdo){
    $stmt = $pdo->prepare("CALL OrderOfBooksRead()");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}
/**
 * Retrieves a single user's email address.
 * 
 * This function calls the stored procedure `GetUserEmail()` and fetches one email address from the User table.
 * It doesn't take any input parameters.
 */
function getUserEmail($pdo){
    $stmt = $pdo->prepare("CALL GetUserEmail()");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}
/**
 * Retrieves the friends of a specific user.
 * 
 * This function calls the stored procedure `getFriendsOf()` and fetches the friends of a specific user from the Friend and User tables.
 * It doesn't take any input parameters.
 */

function getFriendsOf($pdo){
    $stmt = $pdo->prepare("CALL getFriendsOf()");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}
/**
 * Retrieves user ratings above a certain threshold.
 * 
 * This function calls the stored procedure `ofUserRatingsAbove()` and fetches ratings for the user 'Cardinal' that are above the threshold of 4.
 * It doesn't take any input parameters.
 */
function ofUserRatingsAbove($pdo){
    $stmt = $pdo->prepare("CALL ofUserRatingsAbove()");
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $results;
}
function addHours($pdo) {
    $stmt = $pdo->prepare("CALL AddBooks(:amount)");
    $amount = 1;
    $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
}
function subHours($pdo) {
    $stmt = $pdo->prepare("CALL AddHours(:amount)");
    $amount = -1;
    $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
}
function addBooks($pdo) {
    $stmt = $pdo->prepare("CALL AddBooks(:amount)");
    $amount = 1;
    $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
}

function subBooks($pdo) {
    $stmt = $pdo->prepare("CALL AddBooks(:amount)");
    $amount = -1;
    $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
}

function addBookToReadList($pdo, $title){
    $userID = "USER12345";
    $stmt = $pdo->prepare("CALL addToReadList(:userID, :title)");
    $stmt->bindParam(':userID', $userID, PDO::PARAM_STR);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);

    try {
        $stmt->execute();
        echo "Book added to the read list successfully.";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $stmt->closeCursor();
}

function addBookToWillReadList($pdo, $title){
    $userID = "USER12345";
    $stmt = $pdo->prepare("CALL addToWillReadList(:userID, :title)");
    $stmt->bindParam(':userID', $userID, PDO::PARAM_STR);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);

    try {
        $stmt->execute();
        echo "Book added to the read list successfully.";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $stmt->closeCursor();
}

function getBookImagesByCategory($pdo, $category) {
    // Prepare the SQL query to select the category and randomize the results
    $stmt = $pdo->prepare("CALL getBookImagesByCategory(:category)");
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    $stmt->execute();
    
    // Fetch all books in the category
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->closeCursor();
    return $results;
}
function getUserBooksReadImages($pdo) {
    try {
        $stmt = $pdo->prepare("CALL getUserBooksReadImages()");
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_COLUMN); // fetches just the 'Image' values
        $stmt->closeCursor();
        return $images;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}
function getUserBooksWillReadImages($pdo) {
    try {
        $stmt = $pdo->prepare("CALL getUserBooksWillReadImages()");
        $stmt->execute();
        $images = $stmt->fetchAll(PDO::FETCH_COLUMN); // fetches just the 'Image' values
        $stmt->closeCursor();
        return $images;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}
/*
Example of how to use Leavebookreview

// Example data
$title = "Dr. Seuss: American Icon";
$score = 4.0;
$text = "Great book on the legacy of Dr. Seuss! Thorough and informative.";

leaveBookReview($pdo, $title, $userId, $score, $text);
*/
function leaveBookReview($pdo, $title, $score, $text) {
    try {
        $stmt = $pdo->prepare("CALL addBookReview(:title, :score, :text)");
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':score', $score);
        $stmt->bindParam(':text', $text, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->closeCursor();
        return true;
    } catch (PDOException $e) {
        echo "Error adding review: " . $e->getMessage();
        return false;
    }
}
function removeBookFromWillReadList($pdo, $title) {
    $userID = "USER12345";
    $stmt = $pdo->prepare("DELETE FROM UserBooksRead WHERE Title = :title");
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);

    try {
        $stmt->execute();
        echo "Book removed from the list.";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    $stmt->closeCursor();
}



?>
