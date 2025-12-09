<?php
echo "Testing MySQL connections...\n\n";

$passwords = ['', 'root', 'password', 'mysql', 'MyNewPass123!'];

foreach($passwords as $pwd) {
    try {
        $pdo = new PDO('mysql:host=localhost', 'root', $pwd);
        echo "✅ SUCCESS with password: '" . ($pwd ?: '(empty)') . "'\n";
        
        // Try to create database
        $pdo->exec("CREATE DATABASE IF NOT EXISTS internship_db");
        $pdo->exec("USE internship_db");
        $pdo->exec("CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )");
        echo "✅ Database and table created!\n";
        echo "\n👉 Update config/database.php line 5 to: \$password = '$pwd';\n";
        exit(0);
    } catch(Exception $e) {
        echo "❌ Failed with password: '" . ($pwd ?: '(empty)') . "'\n";
    }
}

echo "\n❌ None worked. Run: mysql_secure_installation\n";
?>
