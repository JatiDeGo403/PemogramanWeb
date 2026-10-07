FROM php:8.2-apache

# 1. Install dependensi sistem dan ekstensi PostgreSQL untuk PHP
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# 2. Atasi konflik MPM Apache dengan aman (Non-aktifkan event/worker, aktifkan prefork)
RUN a2dismod mpm_event mpm_worker && a2enmod mpm_prefork

# 3. Salin seluruh kode proyek ke dalam direktori web Apache
COPY . /var/www/html/

# 4. Atur hak akses folder
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# 5. Konfigurasi Apache agar otomatis membaca port dinamis dari Railway
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# 6. Jalankan Apache langsung di foreground
EXPOSE 80
CMD ["apache2-foreground"]