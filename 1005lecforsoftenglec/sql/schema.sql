CREATE TABLE student_records (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR (50),
    last_name VARCHAR (50),
    gender VARCHAR (50),
    year_level VARCHAR (50),
    section VARCHAR (50),
    adviser VARCHAR (50),
    religion VARCHAR (50),
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


