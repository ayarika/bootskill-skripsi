FROM php:8.2-cli

WORKDIR /var/www/html

COPY . .

RUN docker-php-ext-install pdo pdo_mysql

EXPOSE 8080

CMD ["sh", "-c", "php -S 0.0.0.0:${PORT} -t public"]