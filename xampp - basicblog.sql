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
INSERT INTO Users (Username, FirstName, LastName, DateOfBirth, Password) VALUES
('user1', 'John', 'Doe', '1990-01-01', 'password1'),
('user2', 'Jane', 'Smith', '1992-02-02', 'password2'),
('user3', 'Alice', 'Johnson', '1988-03-03', 'password3'),
('user4', 'Bob', 'Brown', '1995-04-04', 'password4'),
('user5', 'Charlie', 'Davis', '1985-05-05', 'password5');

-- Insert 10 records into Posts Table
INSERT INTO Posts (PostDescription, PostedBy, IsVisible) VALUES
('Hello World!', 1, TRUE),
('My first post!', 2, TRUE),
('Learning SQL!', 3, TRUE),
('Group activities!', 4, TRUE),
('Happy to be here!', 5, TRUE),
('SQL is fun!', 1, TRUE),
('Join my group!', 2, TRUE),
('Post about coding!', 3, TRUE),
('Weekend plans!', 4, TRUE),
('Final project update!', 5, TRUE);

-- Insert 10 records into Comments Table
INSERT INTO Comments (CommentDescription, AddedBy, PostID) VALUES
('Great post!', 1, 1),
('Thanks for sharing!', 2, 2),
('Very informative!', 3, 3),
('I love this!', 4, 4),
('Nice work!', 5, 5),
('Interesting perspective!', 1, 6),
('Could you elaborate?', 2, 7),
('I disagree!', 3, 8),
('Looking forward to more!', 4, 9),
('Keep it up!', 5, 10);