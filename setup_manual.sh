#!/bin/bash

echo "=== MySQL Setup ==="
echo "Please run the following command manually with your MySQL root password:"
echo "/usr/local/mysql/bin/mysql -u root -p < setup.sql"
echo ""
echo "Or create the database manually:"
echo "1. Login: /usr/local/mysql/bin/mysql -u root -p"
echo "2. Run: CREATE DATABASE IF NOT EXISTS internship_db;"
echo "3. Run: USE internship_db;"
echo "4. Run: CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(100) NOT NULL, email VARCHAR(100) NOT NULL UNIQUE, password VARCHAR(255) NOT NULL, created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);"
echo ""
