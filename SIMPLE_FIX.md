# 🔥 SIMPLE FIX - Run These Commands

## Option 1: Use SQLite Instead (NO MySQL password needed!)

```bash
cd "/Users/jascarbenish/Documents/GitHub/IITM-project"

# Update config to use SQLite
cat > config/database.php << 'EOF'
<?php
try {
    $pdo = new PDO('sqlite:internship.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Create table
    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
} catch(PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'message' => 'DB Error']);
    exit;
}
?>
EOF

# Start server
php -S localhost:8000
```

## Option 2: Find Your MySQL Password

Run this in terminal:
```bash
grep -r "password" ~/.my.cnf ~/.mysql_secret /opt/homebrew/etc/my.cnf 2>/dev/null
```

Then update `config/database.php` line 5 with your password.

## Option 3: Reset MySQL Password to Empty

```bash
sudo mysql
ALTER USER 'root'@'localhost' IDENTIFIED BY '';
FLUSH PRIVILEGES;
EXIT;
```

Then restart:
```bash
brew services restart mysql
php -S localhost:8000
```
