FROM ubuntu:22.04
LABEL sevidor_crow="Corvoux <corvoux@crow.co>"
ARG DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt-get install -y \
    curl \
    git \
    software-properties-common \
    net-tools

RUN ln -sf /usr/share/zoneinfo/America/Bogota /etc/localtime
RUN echo "America/Bogota" | tee /etc/timezone
RUN add-apt-repository ppa:ondrej/php
#RUN apt-get update -y

# Instalación de PHP 8.3 y PHP-FPM
RUN apt-get update && \
    apt-get install -y \
    php8.3 \
    php8.3-cli \
    php8.3-mysql \
    php8.3-odbc \
    php8.3-fpm \
    php8.3-cgi \
    php8.3-mbstring \
    php8.3-curl \
    php8.3-soap \
    php8.3-xml \
    php8.3-ssh2 \
    php8.3-xdebug \
    php8.3-zip

ENV NODE_VERSION=20
RUN curl -sL https://deb.nodesource.com/setup_${NODE_VERSION}.x | bash - \
    && apt-get install -y nodejs

WORKDIR /var/www/reservas

COPY package.json ./
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Bootstrap
RUN composer require twbs/bootstrap
# Install npm packages and run devº
RUN npm install
# Genera la clave de la aplicación

CMD service php8.3-fpm start && tail -f /dev/null 
COPY ./.fpm/php-fpm.conf /etc/php/8.3/fpm/
EXPOSE 8000

