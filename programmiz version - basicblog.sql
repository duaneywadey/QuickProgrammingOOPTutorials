-- Create Users Table
CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50),
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    DateOfBirth DATE,
    Password VARCHAR(255),
    DateRegistered TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Create Posts Table
CREATE TABLE Posts (
    PostID INT AUTO_INCREMENT PRIMARY KEY,
    PostDescription VARCHAR(255),
    PostedBy INT,
    IsVisible BOOLEAN,
    DatePosted TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Create Comments Table
CREATE TABLE Comments (
    CommentID INT AUTO_INCREMENT PRIMARY KEY,
    CommentDescription VARCHAR(255),
    AddedBy INT,
    PostID INT,
    DateAdded TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);



-- Insert 5 records into Users Table
INSERT INTO Users (UserID, Username, FirstName, LastName, DateOfBirth, Password) VALUES
(1,'user1', 'John', 'Doe', '1990-01-01', 'password1'),
(2,'user2', 'Jane', 'Smith', '1992-02-02', 'password2'),
(3,'user3', 'Alice', 'Johnson', '1988-03-03', 'password3'),
(4,'user4', 'Bob', 'Brown', '1995-04-04', 'password4'),
(5,'user5', 'Charlie', 'Davis', '1985-05-05', 'password5');

-- Insert 10 records into Posts Table
INSERT INTO Posts (PostID, PostDescription, PostedBy, IsVisible) VALUES
(1,'Hello World!', 1, TRUE),
(2,'My first post!', 2, FALSE),
(3,'Learning SQL!', 3, TRUE),
(4,'Group activities!', 4, FALSE),
(5,'Happy to be here!', 5, TRUE),
(6,'SQL is fun!', 1, FALSE),
(7,'Join my group!', 2, TRUE),
(8,'Post about coding!', 3, TRUE),
(9,'Weekend plans!', 4, TRUE),
(10,'Final project update!', 5, FALSE);

-- Insert 10 records into Comments Table
INSERT INTO Comments (CommentID, CommentDescription, AddedBy, PostID) VALUES
(1,'Great post!', 1, 1),
(2,'Thanks for sharing!', 2, 1),
(3,'Very informative!', 3, 1),
(4,'I love this!', 4, 2),
(5,'Nice work!', 5, 2),
(6,'Interesting perspective!', 1, 2),
(7,'Could you elaborate?', 2, 7),
(8,'I disagree!', 3, 8),
(9,'Looking forward to more!', 4, 9),
(10,'Keep it up!', 5, 10);