
FROM php:8.2-fpm

# Installation des dépendances
RUN apt-get update && apt-get install -y \
    git curl libzip-dev zip unzip \
    && docker-php-ext-install zip

# Installation de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www



# Installation Laravel dans un dossier temporaire
WORKDIR /tmp
RUN composer create-project laravel/laravel laravel-app "10.*" && \
    cd laravel-app && php artisan key:generate

# Déplacement de l'application Laravel dans /var/www (y compris fichiers cachés)
RUN rm -rf /var/www/* && cp -R /tmp/laravel-app/. /var/www/

WORKDIR /var/www

# Copie les fichiers d'exemple dans le bon dossier Laravel
COPY starter-files/routes-api.php /var/www/routes/api.php
COPY starter-files/UserController.php /var/www/app/Http/Controllers/UserController.php



EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=8000