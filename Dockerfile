FROM php:8.0.13-fpm
RUN apt-get update && apt-get install -y \
mc \
ca-certificates \
curl \
git \
zip \
libzip-dev
RUN docker-php-ext-install mysqli pdo pdo_mysql zip
COPY src /var/www/src