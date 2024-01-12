# Wyb�r obrazu bazowego z PHP i serwerem Apache
FROM php:7.4-apache

# Instalacja dodatkowych rozszerze� PHP, je�li s� potrzebne
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Ustawienie uprawnie� dla katalogu, aby Apache m�g� z niego korzysta�
RUN chown -R www-data:www/data /var/www/html

# Ewentualne dodatkowe polecenia, np. w��czenie mod_rewrite dla Apache
RUN a2enmod rewrite