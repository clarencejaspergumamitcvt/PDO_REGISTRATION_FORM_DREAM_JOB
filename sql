CREATE DATABASE IF NOT EXISTS corporate_job_db;
USE corporate_job_db;

CREATE TABLE IF NOT EXISTS corporate_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    department_applied VARCHAR(50) NOT NULL,
    highest_education VARCHAR(50) NOT NULL,
    years_experience INT NOT NULL,
    expected_salary DECIMAL(12, 2) NOT NULL,
    notice_period_days INT NOT NULL,
    application_status VARCHAR(30) DEFAULT 'Under Review',
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
