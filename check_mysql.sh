#!/bin/bash
echo "Testing MySQL connections..."
for pwd in "" "root" "password" "mysql"; do
    echo "Trying password: '$pwd'"
    mysql -u root -p"$pwd" -e "SELECT 1;" 2>&1 | grep -q "ERROR" || { echo "SUCCESS with password: '$pwd'"; exit 0; }
done
echo "None worked. Run: mysql -u root -p"
