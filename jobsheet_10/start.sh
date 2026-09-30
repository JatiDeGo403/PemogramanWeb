#!/bin/bash

echo "===== STARTING CONTAINER ====="
echo "Railway PORT = ${PORT}"

# Matikan semua MPM Apache
rm -f /etc/apache2/mods-enabled/mpm_*.load
rm -f /etc/apache2/mods-enabled/mpm_*.conf

# Aktifkan hanya prefork
a2enmod mpm_prefork

# Atur port sesuai Railway
sed -i '/^Listen /d' /etc/apache2/ports.conf
echo "Listen ${PORT}" >> /etc/apache2/ports.conf

# Atur VirtualHost
sed -i -E "s/<VirtualHost \*:.*>/<VirtualHost *:${PORT}>/" \
    /etc/apache2/sites-available/000-default.conf

echo "===== ACTIVE MPM ====="
ls -la /etc/apache2/mods-enabled/ | grep mpm || true

echo "===== APACHE PORT ====="
cat /etc/apache2/ports.conf

echo "===== START APACHE ====="
exec apache2-foreground