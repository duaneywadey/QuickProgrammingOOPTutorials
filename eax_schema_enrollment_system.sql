CREATE TABLE school_years (
    school_year_id INT PRIMARY KEY,
    year_start INT NOT NULL,
    year_end INT NOT NULL
);

CREATE TABLE periods (
    period_id INT PRIMARY KEY,
    school_year_id INT,
    grading_period VARCHAR(50) NOT NULL,
    semester VARCHAR(50) NOT NULL
);

CREATE TABLE registrar_staffs (
    registrar_id INT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    date_added DATE NOT NULL
);

CREATE TABLE departments (
    department_id INT PRIMARY KEY,
    department_name VARCHAR(100) NOT NULL,
    dean_id INT,
    added_by INT,
    date_added DATE NOT NULL,
    school_year_id INT
);

CREATE TABLE programs (
    program_id INT PRIMARY KEY,
    registrar_id INT,
    department_id INT,
    school_year_id INT,
    program_name VARCHAR(100) NOT NULL,
    date_added TIMESTAMP NOT NULL
);

CREATE TABLE available_subjects (
    available_subject_id INT PRIMARY KEY,
    program_id INT,
    school_year_id INT,
    period_id INT,
    registrar_id INT,
    is_minor_subject BOOLEAN,
    available_subject_name VARCHAR(100) NOT NULL,
    year_level INT,
    date_added DATE NOT NULL
);

CREATE TABLE students (
    student_id INT PRIMARY KEY,
    program_id INT,
    username VARCHAR(50) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    year_level INT,
    date_of_birth DATE NOT NULL,
    date_added DATE NOT NULL
);

CREATE TABLE faculty (
    faculty_id INT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    dean_id INT,
    date_of_birth DATE NOT NULL,
    date_added DATE NOT NULL
);

CREATE TABLE deans (
    dean_id INT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    date_of_birth DATE NOT NULL,
    registrar_id INT,
    dept_id INT,
    date_added DATE NOT NULL
);

CREATE TABLE grades (
    grade_id INT PRIMARY KEY,
    class_id INT,
    faculty_id INT,
    student_id INT,
    school_year_id INT,
    period_id INT,
    grade DECIMAL(5, 2)
);

CREATE TABLE classes (
    class_id INT PRIMARY KEY,
    available_subject_id INT,
    room_id INT,
    program_id INT,
    faculty_id INT,
    registrar_id INT,
    section_number VARCHAR(10),
    day VARCHAR(10),
    time_start TIME,
    time_end TIME,
    date_added DATE NOT NULL
);

CREATE TABLE rooms (
    room_id INT PRIMARY KEY,
    room_number VARCHAR(10) NOT NULL,
    registrar_id INT,
    date_added DATE NOT NULL
);

CREATE TABLE enrolled_subjects (
    enrolled_subject_id INT PRIMARY KEY,
    student_id INT,
    class_id INT,
    period_id INT,
    registrar_id INT,
    is_paid BOOLEAN,
    date_added DATE NOT NULL
);




