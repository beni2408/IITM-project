# Internship Project - User Registration & Profile Management

## Tech Stack
- HTML5
- CSS3 (Bootstrap 5)
- JavaScript (jQuery)
- PHP
- MySQL
- MongoDB
- Redis

## Setup Instructions

### 1. Install Dependencies

#### Install Composer (if not installed)
```bash
brew install composer
```

#### Install MongoDB PHP Driver
```bash
pecl install mongodb
```

Add to php.ini:
```
extension=mongodb.so
```

#### Install Redis PHP Extension
```bash
pecl install redis
```

Add to php.ini:
```
extension=redis.so
```

#### Install MongoDB Library
```bash
cd "/Users/jascarbenish/Documents/GitHub/IITM project ! "
composer install
```

### 2. Start Services

#### Start MySQL
```bash
brew services start mysql
```

#### Start MongoDB
```bash
brew services start mongodb-community
```

#### Start Redis
```bash
brew services start redis
```

### 3. Setup Database
```bash
mysql -u root < setup.sql
```

### 4. Start PHP Server
```bash
php -S localhost:8000
```

### 5. Access Application
Open browser: http://localhost:8000/register.html

## Flow
1. Register → Create account
2. Login → Authenticate user
3. Profile → View and update profile details

## Features
- Separate HTML, CSS, JS, PHP files
- jQuery AJAX for all backend calls
- Bootstrap responsive design
- MySQL with prepared statements
- MongoDB for profile storage
- Redis for session management
- LocalStorage for client-side session
