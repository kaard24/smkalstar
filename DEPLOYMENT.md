# 🚀 Deployment Guide - SMK Al-Hidayah Lestari

## Prerequisites

- PHP 8.2+
- MySQL 8.0+ / MariaDB 10.6+
- Node.js 18+
- Composer 2.x
- Nginx atau Apache

## Installation Steps

### 1. Clone Repository
```bash
git clone https://github.com/yourusername/smk-alstar.git
cd smk-alstar
```

### 2. Install PHP Dependencies
```bash
composer install --optimize-autoloader --no-dev
```

### 3. Environment Configuration
```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` file:
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://smk-alstar.sch.id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=smk_alstar
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

### 4. Database Setup
```bash
php artisan migrate --force
php artisan db:seed --force
```

### 5. Build Assets
```bash
npm ci
npm run build
```

### 6. Cache Optimization
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### 7. Storage Link
```bash
php artisan storage:link
```

### 8. Set Permissions
```bash
# Linux/Mac
chmod -R 755 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## Web Server Configuration

### Nginx (Recommended)
Lihat file `nginx.conf` untuk konfigurasi lengkap.

```bash
sudo ln -s /etc/nginx/sites-available/smk-alstar /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

### Apache
Aktifkan modul yang diperlukan:
```bash
sudo a2enmod rewrite
sudo a2enmod deflate
sudo a2enmod expires
sudo a2enmod headers
sudo systemctl restart apache2
```

## SSL Certificate (Let's Encrypt)
```bash
sudo certbot --nginx -d smk-alstar.sch.id -d www.smk-alstar.sch.id
```

## Performance Optimization

### 1. Enable OPcache
Tambahkan ke `php.ini`:
```ini
opcache.enable=1
opcache.memory_consumption=256
opcache.interned_strings_buffer=16
opcache.max_accelerated_files=10000
opcache.revalidate_freq=2
opcache.fast_shutdown=1
```

### 2. Redis Cache (Optional)
```bash
sudo apt install redis-server
```

Edit `.env`:
```env
CACHE_DRIVER=redis
SESSION_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 3. Queue Worker (Untuk fitur async)
```bash
php artisan queue:work --sleep=3 --tries=3 --max-time=3600
```

Setup Supervisor:
```ini
[program:smk-alstar-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/smk-alstar/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
user=www-data
numprocs=2
redirect_stderr=true
stdout_logfile=/var/www/smk-alstar/storage/logs/worker.log
stopwaitsecs=3600
```

## Maintenance

### Update Application
```bash
git pull origin main
composer install --optimize-autoloader --no-dev --no-interaction --prefer-dist
php artisan migrate --force
npm ci
npm run build
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Clear All Cache
```bash
php artisan optimize:clear
```

### Generate Sitemap
```bash
php artisan sitemap:generate
```

### Backup Database
```bash
php artisan backup:run --only-db
```

## Monitoring

### Log Files
- Application: `storage/logs/laravel.log`
- Nginx: `/var/log/nginx/smk-alstar-error.log`
- PHP-FPM: `/var/log/php8.2-fpm.log`

### Health Check
```bash
curl https://smk-alstar.sch.id/up
```

## Security Checklist

- [ ] Change default admin password
- [ ] Enable HTTPS only
- [ ] Set strong database password
- [ ] Disable debug mode in production
- [ ] Set proper file permissions
- [ ] Enable automatic security updates
- [ ] Configure firewall (UFW/iptables)
- [ ] Setup fail2ban for brute force protection

## Troubleshooting

### 500 Error
```bash
php artisan optimize:clear
chmod -R 755 storage bootstrap/cache
```

### Permission Denied
```bash
chown -R www-data:www-data /var/www/smk-alstar
```

### Assets not loading
```bash
php artisan storage:link
npm run build
```

## Support

Untuk bantuan lebih lanjut, hubungi tim IT SMK Al-Hidayah Lestari.
