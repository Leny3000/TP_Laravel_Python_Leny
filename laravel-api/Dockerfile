FROM php:8.2-fpm

# Installation des dépendances
RUN apt-get update && apt-get install -y \
    git curl libzip-dev zip unzip \
    && docker-php-ext-install zip

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Copie des fichiers
COPY . /var/www



EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000