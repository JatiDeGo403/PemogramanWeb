#!/bin/bash

echo "Railway PORT = ${PORT}"

# Apache listen pada port Railway
sed -i "s/^Listen 80$/Listen ${PORT}/" /etc/apache2/ports.conf

# VirtualHost mengikuti port Railway
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:${PORT}>/" \
    /etc/apache2/sites-available/000-default.conf

echo "Apache configuration:"
grep -E "Listen|VirtualHost" /etc/apache2/ports.conf \
    /etc/apache2/sites-available/000-default.conf

apache2-foreground