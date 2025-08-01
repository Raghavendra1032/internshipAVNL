CREATE TABLE visitors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    letter_no VARCHAR(255),
    firm VARCHAR(255),
    visitor_name VARCHAR(255),
    designation VARCHAR(255),
    officer VARCHAR(255),
    officer_desig VARCHAR(255),
    section VARCHAR(255),
    purpose VARCHAR(255),
    from_date DATE,
    to_date DATE,
    photo LONGBLOB,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
