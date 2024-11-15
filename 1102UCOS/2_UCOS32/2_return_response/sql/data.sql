CREATE TABLE user_accounts (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255),
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	password TEXT,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

-- CREATE TABLE branches (
-- 	branch_id INT AUTO_INCREMENT PRIMARY KEY,
-- 	address VARCHAR(255),
-- 	head_manager VARCHAR(255),
-- 	contact_number VARCHAR(255),
-- 	added_by VARCHAR (255),
-- 	last_updated TIMESTAMP,
-- 	last_updated_by VARCHAR (255)
-- );

CREATE TABLE courses (
	course_id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR (255),
	department VARCHAR (255),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE awards (
	award_id INT AUTO_INCREMENT PRIMARY KEY,
	event VARCHAR (255),
	course_id VARCHAR (255),
	medal_category VARCHAR (255),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

SELECT course.name, 
	   SUM (CASE WHEN awards.medal_category  = "Gold" THEN 1 ELSE 0) AS goldMedalCount,
	   SUM (CASE WHEN awards.medal_category  = "Silver" THEN 1 ELSE 0) AS silverMedalCount,
	   SUM (CASE WHEN awards.medal_category  = "Bronze" THEN 1 ELSE 0) AS bronzeMedalCount
FROM courses
JOIN awards ON courses.course_id = awards.course_id
GROUP BY course.name
ORDER BY goldMedalCount DESC;

-- Table schema
CREATE TABLE pagaent_events (
	pagaent_event_id INT AUTO_INCREMENT PRIMARY KEY,
	name VARCHAR (255),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE candidates (
	candidate_id INT AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR (255),
	last_name VARCHAR (255),
	gender VARCHAR (255),
	course_id INT,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE pagaent_awards (
	pagaent_award_id INT AUTO_INCREMENT PRIMARY KEY,
	candidate_id INT,
	pagaent_event_id INT,
	event_score INT,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

-- Get average score
SELECT 
	candidate.name,
	AVG(pagaent_awards.event_score) AS avgPagaentScore
FROM candidates
JOIN pagaent_awards ON 
	candidates.candidate_id = pagaent_awards.candidate_id  





