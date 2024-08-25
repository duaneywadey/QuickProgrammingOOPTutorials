-- Create Users Table
CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50),
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    DateOfBirth DATE,
    Password VARCHAR(255),
    DateAdded TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert 5 records into Users Table
INSERT INTO Users (Username, FirstName, LastName, DateOfBirth, Password) VALUES
('user1', 'John', 'Doe', '1990-01-01', 'password1'),
('user2', 'Jane', 'Smith', '1992-02-02', 'password2'),
('user3', 'Alice', 'Johnson', '1988-03-03', 'password3'),
('user4', 'Bob', 'Brown', '1995-04-04', 'password4'),
('user5', 'Charlie', 'Davis', '1985-05-05', 'password5');

-- Create Friends Table
CREATE TABLE Friends (
    FriendID INT AUTO_INCREMENT PRIMARY KEY,
    FriendWhoAdded INT,
    FriendBeingAdded INT,
    IsAccepted BOOLEAN,
    DateAdded TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert 10 records into Friends Table
INSERT INTO Friends (FriendWhoAdded, FriendBeingAdded, IsAccepted) VALUES
(1, 2, TRUE),
(2, 3, TRUE),
(3, 4, FALSE),
(4, 5, TRUE),
(5, 1, TRUE),
(1, 3, TRUE),
(2, 4, FALSE),
(3, 5, TRUE),
(4, 1, TRUE),
(5, 2, FALSE);

-- Create Groups Table
CREATE TABLE Groups (
    GroupID INT AUTO_INCREMENT PRIMARY KEY,
    GroupName VARCHAR(100),
    CreatedBy INT,
    DateAdded TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert 3 records into Groups Table
INSERT INTO Groups (GroupName, CreatedBy) VALUES
('Group A', 1),
('Group B', 2),
('Group C', 3);

-- Create Posts Table
CREATE TABLE Posts (
    PostID INT AUTO_INCREMENT PRIMARY KEY,
    PostDescription VARCHAR(255),
    PostedBy INT,
    IsPublic BOOLEAN,
    IsOnlyForFriends BOOLEAN,
    GroupID INT,
    DatePosted TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert 10 records into Posts Table
INSERT INTO Posts (PostDescription, PostedBy, IsPublic, IsOnlyForFriends, GroupID) VALUES
('Hello World!', 1, TRUE, FALSE, 1),
('My first post!', 2, TRUE, TRUE, 2),
('Learning SQL!', 3, FALSE, TRUE, 1),
('Group activities!', 4, TRUE, FALSE, 3),
('Happy to be here!', 5, TRUE, FALSE, 1),
('SQL is fun!', 1, TRUE, TRUE, 2),
('Join my group!', 2, FALSE, TRUE, 3),
('Post about coding!', 3, TRUE, FALSE, 1),
('Weekend plans!', 4, TRUE, TRUE, 2),
('Final project update!', 5, FALSE, TRUE, 3);

-- Create Group Membership Requests Table
CREATE TABLE GroupMembershipRequests (
    GroupMemberShipRequestsID INT AUTO_INCREMENT PRIMARY KEY,
    GroupID INT,
    GroupMemberUserID INT,
    IsGroupMemberShipAccepted BOOLEAN,
    DateAccepted TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert 10 records into Group Membership Requests Table
INSERT INTO GroupMembershipRequests (GroupID, GroupMemberUserID, IsGroupMemberShipAccepted) VALUES
(1, 2, TRUE),
(2, 3, FALSE),
(3, 4, TRUE),
(1, 5, TRUE),
(2, 1, FALSE),
(3, 2, TRUE),
(1, 3, TRUE),
(2, 4, FALSE),
(3, 5, TRUE),
(1, 1, FALSE);
