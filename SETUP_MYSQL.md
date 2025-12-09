# MySQL Setup Required

Your MySQL has a root password set. Run this command:

```bash
mysql -u root -p
```

Then paste these commands:

```sql
CREATE DATABASE IF NOT EXISTS internship_db;
USE internship_db;
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
EXIT;
```

Or reset MySQL password:
```bash
mysql.server stop
mysqld_safe --skip-grant-tables &
mysql -u root
```

Then in MySQL:
```sql
FLUSH PRIVILEGES;
ALTER USER 'root'@'localhost' IDENTIFIED BY '';
EXIT;
```
