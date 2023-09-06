ARG php_version

FROM php:${php_version}

WORKDIR /var/www/html

RUN apt-get update --fix-missing
RUN apt-get install -y build-essential libssl-dev zlib1g-dev libpng-dev libjpeg-dev libfreetype6-dev

RUN apt-get install -y libzip-dev libldap2-dev 
RUN docker-php-ext-install zip
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-install gd
RUN docker-php-ext-install ldap

RUN docker-php-ext-configure gd --with-freetype=/usr/include/
#RUN docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/
RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/

RUN a2enmod rewrite
RUN a2enmod headers

#RUN chmod -R 777 /var/www/html/assets
#RUN chmod -R 777 /var/www/html/protected/runtime