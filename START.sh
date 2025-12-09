#!/bin/bash

echo "🚀 STARTING INTERNSHIP PROJECT"
echo "================================"
echo ""

# Check and start services
echo "📦 Checking Services..."
brew services list | grep -E "mysql|mongodb|redis"
echo ""

# Start PHP Server
echo "🌐 Starting PHP Server..."
lsof -ti:8000 | xargs kill -9 2>/dev/null
php -S localhost:8000 > /dev/null 2>&1 &
sleep 2

echo ""
echo "✅ PROJECT IS RUNNING!"
echo "================================"
echo "🌐 Frontend: http://localhost:8000/register.html"
echo ""
echo "⚠️  IMPORTANT: Setup MySQL database first!"
echo "Run: mysql -u root -p"
echo "Then paste the SQL from setup.sql"
echo ""
echo "Press Ctrl+C to stop the server"
echo ""

# Keep server running
wait
