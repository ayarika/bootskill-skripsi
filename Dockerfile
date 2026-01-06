FROM php:8.2-cli

WORKDIR /var/www

COPY . .

RUN apt-get update && apt-get install -y zip unzip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring bcmath tokenizer fileinfo

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "public"]