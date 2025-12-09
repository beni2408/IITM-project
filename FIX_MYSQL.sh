#!/bin/bash

echo "🔧 Fixing MySQL..."

# Stop MySQL
brew services stop mysql
sleep 2

# Remove old data (backup first)
mv /opt/homebrew/var/mysql /opt/homebrew/var/mysql.backup 2>/dev/null

# Reinitialize MySQL with no password
mysqld --initialize-insecure --user=$(whoami) --datadir=/opt/homebrew/var/mysql

# Start MySQL
brew services start mysql
sleep 3

# Create database
mysql -u root << EOF
CREATE DATABASE IF NOT EXISTS internship_db;
USE internship_db;
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
EOF

echo "✅ MySQL fixed! Password is now EMPTY"
echo "✅ Database created!"
