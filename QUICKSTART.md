# 🚀 Quick Start Guide

## Run the Project (One Command)

```bash
./RUN.sh
```

## Manual Setup (If needed)

### 1. Start Services
```bash
brew services start mysql
brew services start mongodb-community
brew services start redis
```

### 2. Setup Database
```bash
mysql -u root -p < setup.sql
```

### 3. Install Dependencies
```bash
composer install
```

### 4. Start Server
```bash
php -S localhost:8000
```

## 🌐 Access Application

**Open Browser:** http://localhost:8000/register.html

## 📋 Test Flow

1. **Register** → http://localhost:8000/register.html
2. **Login** → http://localhost:8000/login.html
3. **Profile** → http://localhost:8000/profile.html

## ⚠️ Troubleshooting

If MySQL fails, run manually:
```bash
mysql -u root -p < setup.sql
```

Then restart:
```bash
./RUN.sh
```
