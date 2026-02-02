#!/bin/bash

# SMK Al-Hidayah Lestari - Production Deployment Script
# Usage: ./deploy.sh

echo "🚀 Starting production deployment..."

# Set environment to production
export NODE_ENV=production

echo "📦 Installing dependencies..."
npm ci --production=false

echo "🏗️ Building assets for production..."
npm run build

echo "🔧 Optimizing for production..."
# Clear cache
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "⚡ Running optimizations..."
# Optimize autoloader
composer install --optimize-autoloader --no-dev

echo "🧹 Cleaning up..."
# Remove unnecessary files for production
rm -rf node_modules
rm -rf tests
rm -rf .git

echo "✅ Deployment complete!"
echo ""
echo "Don't forget to:"
echo "1. Set APP_ENV=production in .env"
echo "2. Set APP_DEBUG=false in .env"
echo "3. Configure your web server (Nginx/Apache)"
echo "4. Run: php artisan migrate --force (if needed)"
