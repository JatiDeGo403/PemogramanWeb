FROM php:8.2-apache

# Install ekstensi PostgreSQL untuk PHP
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql pgsql

# Perbaiki konflik MPM Apache di Debian/Ubuntu
RUN a2dismod mpm_event mpm_worker && a2enmod mpm_prefork

# Salin seluruh kode jobsheet_10 ke root web Apache
COPY . /var/www/html/

# Ubah konfigurasi port Apache agar membaca port dinamis dari Railway
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

EXPOSE 80