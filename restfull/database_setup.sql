CREATE DATABASE restful;
USE restful;

CREATE TABLE horizonstudents (
    index_no INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    city VARCHAR(50),
    district VARCHAR(50),
    province VARCHAR(50),
    email VARCHAR(100),
    mobile VARCHAR(15)
);

INSERT INTO horizonstudents (first_name, last_name, city, district, province, email, mobile)
VALUES
('John', 'Doe', 'Beijing', 'District1', 'Province1', 'john@example.com', '1234567890'),
('Jane', 'Smith', 'Shanghai', 'District2', 'Province2', 'jane@example.com', '9876543210');
