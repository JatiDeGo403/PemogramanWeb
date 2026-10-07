FROM php:8.2-apache

# 1. Install ekstensi PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# 2. CARA PAKSA (NUCLEAR OPTION): Hapus semua modul MPM yang aktif, lalu nyalakan ulang HANYA prefork
RUN rm -f /etc/apache2/mods-enabled/mpm_*.load \
    && rm -f /etc/apache2/mods-enabled/mpm_*.conf \
    && a2enmod mpm_prefork

# 3. Salin seluruh file PHP
COPY . /var/www/html/

# 4. Atur hak akses
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# 5. Konfigurasi Port Railway
RUN sed -i 's/80/${PORT}/g' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# 6. Jalankan server Apache di foreground
EXPOSE 80
CMD ["apache2-foreground"]