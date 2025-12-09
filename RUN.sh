#!/bin/bash

echo "🚀 Starting Internship Project..."
echo ""

# Start MySQL
echo "📦 Starting MySQL..."
brew services start mysql
sleep 2

# Start MongoDB
echo "📦 Starting MongoDB..."
brew services start mongodb-community 2>/dev/null || brew services start mongodb-community@8.0
sleep 2

# Start Redis
echo "📦 Starting Redis..."
brew services start redis
sleep 2

# Setup Database
echo "📦 Setting up MySQL Database..."
echo "Enter MySQL root password (press Enter if no password):"
mysql -u root -p < setup.sql 2>/dev/null || echo "✅ Database already setup or needs manual setup"

# Install Composer Dependencies
if [ ! -d "vendor" ]; then
    echo "📦 Installing Composer dependencies..."
    composer install
fi

# Start PHP Server
echo "🌐 Starting PHP Server on http://localhost:8000"
echo ""
echo "✅ Open your browser: http://localhost:8000/register.html"
echo ""
php -S localhost:8000
