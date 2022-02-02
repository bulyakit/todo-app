FROM php:8.0.13-fpm
RUN apt-get update && apt-get install -y \
mc \
ca-certificates \
wget \
ssh \
curl \
git \
zip \
less \
libzip-dev
RUN docker-php-ext-install mysqli pdo pdo_mysql zip
COPY src /var/www/src

# Composer
RUN wget https://getcomposer.org/installer -O - -q | php -- --quiet && \
    mv composer.phar /usr/local/bin/composer