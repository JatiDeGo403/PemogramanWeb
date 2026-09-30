# Gunakan image PHP resmi yang sudah sepaket dengan server web Apache
FROM php:8.2-apache

# Install paket dependensi sistem operasi (Debian) yang dibutuhkan untuk PostgreSQL
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/*

# Install dan aktifkan ekstensi PDO PostgreSQL untuk PHP
RUN docker-php-ext-install pdo pdo_pgsql pgsql

# Aktifkan modul rewrite Apache (berguna jika nanti butuh URL rapi tanpa .php)
RUN a2enmod rewrite

# Copy seluruh file proyek jobsheet_10 Anda ke folder publik Apache di dalam container
COPY . /var/www/html/

# Atur hak akses agar Apache bisa membaca file dengan benar
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Ekspos port 80 untuk akses web
EXPOSE 80