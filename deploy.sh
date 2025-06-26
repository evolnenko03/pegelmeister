#!/bin/bash

echo "Starting deployment..."

# Navigate to app directory
cd /var/www/pegelmeister

# Pull latest changes
echo "Pulling latest changes..."
git pull origin main

# Install dependencies
echo "Installing dependencies..."
composer install --optimize-autoloader --no-dev

# Laravel optimization
echo "Optimizing Laravel..."
php artisan config:clear
php artisan config:cache
php artisan route:clear
php artisan route:cache
php artisan view:clear
php artisan view:cache

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Clear caches
php artisan cache:clear

# Set permissions
echo "Setting permissions..."
chown -R www-data:www-data /var/www/pegelmeister
chmod -R 755 /var/www/pegelmeister
chmod -R 775 /var/www/pegelmeister/storage
chmod -R 775 /var/www/pegelmeister/bootstrap/cache

# Restart services
echo "Restarting services..."
systemctl restart php8.2-fpm

echo "Deployment complete!"
