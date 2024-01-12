# Wybór obrazu bazowego z PHP i serwerem Apache
FROM php:7.4-apache

# Instalacja dodatkowych rozszerzeñ PHP, jeœli s¹ potrzebne
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Ustawienie uprawnieñ dla katalogu, aby Apache móg³ z niego korzystaæ
RUN chown -R www-data:www/data /var/www/html

# Ewentualne dodatkowe polecenia, np. w³¹czenie mod_rewrite dla Apache
RUN a2enmod rewrite