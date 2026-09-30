FROM php:8.2-apache

# Install ekstensi PostgreSQL untuk PHP
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql pgsql && rm -rf /var/lib/apt/lists/*

# Perbaiki konflik MPM Apache di Debian/Ubuntu
#RUN a2dismod mpm_event mpm_worker && a2enmod mpm_prefork

RUN a2enmod rewrite
# Salin seluruh kode jobsheet_10 ke root web Apache
COPY . /var/www/html/

# Ubah konfigurasi port Apache agar membaca port dinamis dari Railway
# RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf


RUN chown -R www-data:www-data /var/www/html

EXPOSE 80