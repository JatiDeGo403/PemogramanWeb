#!/bin/bash

echo "===== START APACHE ====="
echo "Railway PORT = ${PORT}"

# Matikan semua MPM
a2dismod mpm_event 2>/dev/null || true
a2dismod mpm_worker 2>/dev/null || true
a2dismod mpm_prefork 2>/dev/null || true

# Hapus semua konfigurasi LoadModule MPM
sed -i '/LoadModule mpm_/d' /etc/apache2/apache2.conf
sed -i '/LoadModule mpm_/d' /etc/apache2/conf-enabled/*.conf 2>/dev/null || true
sed -i '/LoadModule mpm_/d' /etc/apache2/mods-enabled/*.load 2>/dev/null || true

# Aktifkan HANYA prefork
a2enmod mpm_prefork

# Bersihkan konfigurasi port
sed -i '/^Listen /d' /etc/apache2/ports.conf
echo "Listen ${PORT}" >> /etc/apache2/ports.conf

# Atur VirtualHost
sed -i -E "s/<VirtualHost \*:.*>/<VirtualHost *:${PORT}>/" \
/etc/apache2/sites-available/000-default.conf

echo "===== CHECK MPM ====="
apache2ctl -M 2>&1 | grep mpm || true

echo "===== CHECK PORT ====="
cat /etc/apache2/ports.conf

echo "===== STARTING APACHE ====="

apache2-foreground