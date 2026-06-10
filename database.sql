-- DENR DTR System Database Schema

CREATE DATABASE IF NOT EXISTS dtr_system;
USE dtr_system;

-- Departments Table
CREATE TABLE IF NOT EXISTS departments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    head VARCHAR(255),
    am_arrival TIME,
    am_departure TIME,
    pm_arrival TIME,
    pm_departure TIME,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Employees Table
CREATE TABLE IF NOT EXISTS employees (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    id_num VARCHAR(50) UNIQUE NOT NULL, -- Machine ID
    employee_num VARCHAR(50) UNIQUE NOT NULL, -- HR ID
    employee_type ENUM('Regular', 'Contractual', 'JO') DEFAULT 'Regular',
    department_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE SET NULL
);

-- Attendance Logs Table
CREATE TABLE IF NOT EXISTS attendance_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    employee_id INT NOT NULL,
    log_type ENUM('in', 'out') NOT NULL,
    log_timestamp DATETIME NOT NULL,
    source ENUM('biometric', 'manual') DEFAULT 'biometric',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
);

-- Insert initial departments
INSERT INTO departments (name, head, am_arrival, am_departure, pm_arrival, pm_departure) VALUES
('Administrative', 'Juan Dela Cruz, Chief Admin Officer', '08:00:00', '12:00:00', '13:00:00', '17:00:00'),
('Finance', 'Maria Clara, Chief Finance Officer', '08:00:00', '12:00:00', '13:00:00', '17:00:00'),
('Operations', 'Crisostomo Ibarra, Operations Manager', '08:00:00', '12:00:00', '13:00:00', '17:00:00');

-- Insert initial employees for testing
INSERT INTO employees (name, id_num, employee_num, employee_type, department_id) VALUES
('Alice Smith', '101', 'HR-2023-001', 'Regular', 1),
('Bob Jones', '102', 'HR-2023-002', 'Contractual', 1),
('Charlie Brown', '201', 'HR-2023-003', 'JO', 2),
('David Miller', '301', 'HR-2023-004', 'Regular', 3),
('Eve Adams', '401', 'HR-2023-005', 'Regular', 2),
('Frank Wright', '501', 'HR-2023-006', 'Contractual', 3);
