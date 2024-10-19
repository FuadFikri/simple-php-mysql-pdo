FROM php:8.2-apache

# Install PDO and PDO_MySQL extensions
RUN docker-php-ext-install pdo pdo_mysql

# Enable Apache mod_rewrite if needed
RUN a2enmod rewrite

# Set the working directory
WORKDIR /var/www/html

# Copy your application files into the container
COPY . /var/www/html
