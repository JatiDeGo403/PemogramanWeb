FROM php:8.2-apache

# 1. Install ekstensi PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# 2. INI KUNCI PERBAIKANNYA: Matikan MPM yang bentrok, sisakan mpm_prefork
RUN a2dismod mpm_event mpm_worker && a2enmod mpm_prefork

# 3. Salin seluruh file PHP ke dalam container
COPY . /var/www/html/

# 4. Atur hak akses agar Apache bisa membaca file
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# 5. Konfigurasi Port dinamis untuk Railway
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# 6. Jalankan server Apache
EXPOSE 80
CMD ["apache2-foreground"]