# Imagem base com Apache + PHP 8.2
FROM php:8.2-apache

# Copia os arquivos do projeto para a pasta padrão do Apache
COPY . /var/www/html/

# Define o diretório de trabalho
WORKDIR /var/www/html

# Corrige permissões para o Apache ler os arquivos
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expõe a porta padrão do Apache
EXPOSE 80
