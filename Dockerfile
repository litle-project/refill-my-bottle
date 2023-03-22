FROM php:7.4-apache

COPY . /var/www/html

RUN apt-get update && apt-get install -y \
  git \
  curl \
  build-essential \
  libpng-dev \
  libonig-dev \
  libxml2-dev \
  zip \
  unzip

RUN a2enmod rewrite

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo mysqli pdo_mysql gd

RUN docker-php-ext-configure gd
