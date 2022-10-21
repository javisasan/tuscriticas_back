FROM php:8.1-apache
WORKDIR /app
COPY . .
COPY ./apache-vhost.cnf /etc/apache2/sites-enabled/000-default.conf
RUN apt update && apt install -y \
        git \
        zip \
    && docker-php-ext-install pdo_mysql \
    && a2enmod rewrite \
    && php bin/composer.phar install
EXPOSE 80
CMD ["apachectl", "-DFOREGROUND"]

