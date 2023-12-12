FROM php:7.3-apache

WORKDIR /var/www/html

EXPOSE 80

CMD ["apache2-foreground"]

# Build
# docker build -t linux-ime .

# Run
# docker run -dp 8080:80 -v .:/var/www/html --name linux-ime linux-ime
