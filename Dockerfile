FROM php:8.0-apache
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html

RUN apt-get update && apt-get install -y unzip zip git \
    && docker-php-ext-install mysqli pdo pdo_mysql \
    && docker-php-ext-enable pdo_mysql

RUN a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

