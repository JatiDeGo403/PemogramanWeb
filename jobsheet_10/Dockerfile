FROM php:8.2-cli

# 1. Install ekstensi PostgreSQL untuk PHP
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql pgsql \
    && rm -rf /var/lib/apt/lists/*

# 2. Tentukan direktori kerja di dalam container
WORKDIR /var/www/html

# 3. Salin seluruh file proyek ke dalam container
COPY . /var/www/html/

# 4. Jalankan menggunakan PHP Built-in Server yang otomatis mendeteksi port Railway
EXPOSE 8080
CMD ["sh", "-c", "php -S 0.0.0.0:${PORT} -t ."]