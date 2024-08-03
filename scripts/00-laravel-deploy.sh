#!/usr/bin/env bash
echo "Running composer"
composer global require hirak/prestissimo
composer install --no-dev --working-dir=/var/www/html

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

# Ensure the SQLite database file exists and has proper permissions
if [ ! -f /var/www/html/database/database.sqlite ]; then
    echo "Creating SQLite database..."
    touch /var/www/html/database/database.sqlite
    chmod 775 /var/www/html/database/database.sqlite
fi

echo "Running migrations for SQLite..."
php artisan migrate --database=sqlite --force

echo "Running migrations..."
php artisan migrate --force

echo "Generating Swagger documentation..."
php artisan l5-swagger:generate

echo "Deployment complete."