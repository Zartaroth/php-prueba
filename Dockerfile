FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html/

# Habilitar módulos de Apache si es necesario
RUN a2enmod rewrite

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]
