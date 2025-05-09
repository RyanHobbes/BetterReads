-- 1. Creates a stored procedure to select Reviews ID and Book title by joining Reviews and Book tables.
DELIMITER $$
CREATE PROCEDURE GetReviewsAndBooks()
BEGIN
    SELECT Reviews.ID, Book.title
    FROM Reviews
    JOIN Book ON Reviews.title = Book.title;
END $$

DELIMITER;

-- 2. Creates a stored procedure to get the books read by a user, identified by the user ID.
DELIMITER $$
CREATE PROCEDURE GetBooksReadByUser (IN uid VARCHAR(40))
BEGIN
      SELECT b.title, h.DateRead
      FROM HasRead h
      JOIN Books b ON h.bookID=b.BookID
      WHERE h.UserID = uid;
END $$

DELIMITER;

-- 3. Creates a stored procedure to select the email addresses of all users.
DELIMITER $$
CREATE PROCEDURE GetAllUserEmails()
BEGIN
    SELECT Email FROM User;
END $$

DELIMITER;

-- 4. Creates a stored procedure to retrieve the image of a book by its title.
DELIMITER $$
CREATE PROCEDURE GetBookImage (IN bookTitle VARCHAR(255))
BEGIN
	SELECT Image
	FROM Book
	WHERE Title = bookTitle;
END $$

DELIMITER;

-- 5. Creates a stored procedure to get reviews made on a specific date range based on time.
DELIMITER $$

CREATE PROCEDURE getReviewsOnDate()
BEGIN 
	SELECT ID FROM Review
	WHERE Time > '30000000' AND Time < '40000000';
END $$

DELIMITER;

-- 6. Creates a stored procedure to get the title of books published by 'scholastic'.
DELIMITER $$

CREATE PROCEDURE publisherOfBook()
BEGIN 
	SELECT b.Title FROM Book b, Publisher p
	WHERE p.name = 'scholastic';
END $$

DELIMITER;

-- 7. Creates a stored procedure to get all mutual friends of a user based on the username.
DELIMITER $$

CREATE PROCEDURE getAllMutualFriendsOf()
BEGIN 
    SELECT f.Mutual_Friends FROM Friend f, User u
    WHERE f.Username = u.name;
END $$

DELIMITER;

-- 8. Creates a stored procedure to retrieve all friends of the user.
DELIMITER $$

CREATE PROCEDURE GetAllFriends()
BEGIN
	SELECT * FROM Friend;
END $$

DELIMITER;

-- 9. Creates a stored procedure to retrieve all users from the User table.
DELIMITER $$

CREATE PROCEDURE GetAllUsers()
BEGIN
	SELECT * FROM User;
END $$

DELIMITER;

-- 10. Creates a stored procedure to retrieve all reviews from the Reviews table.
DELIMITER $$

CREATE PROCEDURE GetAllReviews()
BEGIN
	SELECT * FROM Reviews;
END $$

DELIMITER;

-- 11. Creates a stored procedure to retrieve all books from the Book table.
DELIMITER $$

CREATE PROCEDURE GetAllBooks()
BEGIN
	SELECT * FROM Book;
END $$

DELIMITER;

-- 12. Creates a stored procedure to get books by their category.
DELIMITER $$

CREATE PROCEDURE GetBooksByCategory (IN category VARCHAR(255))
BEGIN
	SELECT Title
	FROM Book
	WHERE Categories = category;
END $$

DELIMITER;

-- 13. Creates a stored procedure to get books ordered by the date they were read.
DELIMITER $$

CREATE PROCEDURE OrderOfBooksRead()
BEGIN
     SELECT title
     FROM Book
     WHERE hasRead
     ORDER BY dateRead;
END $$

DELIMITER;

-- 14. Creates a stored procedure to get books by their author.
DELIMITER $$

CREATE PROCEDURE GetBooksByAuthor (IN Author VARCHAR(255))
BEGIN
	SELECT Title
	FROM Book
	WHERE Author = author;
END $$

DELIMITER;

-- 15. Creates a stored procedure to get all user emails from the User table.
DELIMITER $$

CREATE PROCEDURE GetAllUserEmails()
BEGIN
	SELECT Email
	FROM User;
END $$

DELIMITER;

-- 16. Creates a stored procedure to get a single user email from the User table.
DELIMITER $$

CREATE PROCEDURE GetUserEmail()
BEGIN
	SELECT Email
	FROM User
	LIMIT 1;
END $$

DELIMITER;

-- 17. Creates a stored procedure to get the friends of a user named 'FrogMaster'.
DELIMITER $$

BEGIN
CREATE PROCEDURE getFriendsOf()
	SELECT f.Username FROM Friend f, User u
	WHERE u.Name = 'FrogMaster';
END $$

DELIMITER;

-- 18. Creates a stored procedure to get user ratings above a certain threshold for a user named 'Cardinal'.
DELIMITER $$

CREATE PROCEDURE ofUserRatingsAbove()
BEGIN
	SELECT r.Rating_Count FROM Reviews r, User u
	WHERE u.Name = 'Cardinal' AND r.Rating_Count > 4;
END $$

DELIMITER;
