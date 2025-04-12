CREATE DATABASE IF NOT EXISTS your_database_name;
USE your_database_name;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100),
    email VARCHAR(100),
    firstname VARCHAR(100),
    lastname VARCHAR(100),
    active INT
);

INSERT INTO users (username, email, firstname, lastname, active) VALUES
('amit123', 'amit.kumar@example.com', 'Amit', 'Kumar', 1),
('priya88', 'priya.sharma@example.com', 'Priya', 'Sharma', 1),
('rahul99', 'rahul.verma@example.com', 'Rahul', 'Verma', 1),
('neha01', 'neha.patel@example.com', 'Neha', 'Patel', 1),
('vikas78', 'vikas.jain@example.com', 'Vikas', 'Jain', 1),
('ben0', 'ben@example.com', 'Ben', 'Hacker', 0);
