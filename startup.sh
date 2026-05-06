#!/bin/bash
cd /home/site/wwwroot
/usr/local/bin/composer install --no-dev --optimize-autoloader
php artisan migrate --force
php artisan config:clear
php artisan storage:link