CREATE TABLE user_accounts (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(50),
	first_name VARCHAR(50),
	last_name VARCHAR(50),
	password VARCHAR(50),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE user_posts (
	user_post_id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR (50),
	body TEXT,
	user_id INT,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)
