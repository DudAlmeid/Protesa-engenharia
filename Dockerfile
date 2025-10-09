# Use a imagem oficial do PHP com Apache
FROM php:8.1-apache

# Instalar extensões necessárias do PHP
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilitar mod_rewrite do Apache
RUN a2enmod rewrite

# Configurar o DocumentRoot para apontar para o diretório correto
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Atualizar a configuração do Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copiar a configuração do Apache personalizada
COPY apache.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

# Copiar arquivos iniciais (serão sobrescritos pelos volumes em desenvolvimento)
COPY . .

# Habilitar site e módulos necessários
RUN a2ensite 000-default
RUN a2enmod rewrite

# Definir permissões adequadas
RUN chown -R www-data:www-data /var/www/html/
RUN chmod -R 755 /var/www/html/
RUN mkdir -p /var/www/html/src/Files_Protesa
RUN chmod -R 777 /var/www/html/src/Files_Protesa/

# Expor porta (Railway usa variável PORT)
EXPOSE 80
ENV PORT=80

# Script para configurar porta do Apache dinamicamente
RUN echo '#!/bin/bash\n\
sed -i "s/80/$PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf\n\
apache2-foreground' > /start.sh && chmod +x /start.sh

# Comando para iniciar o Apache
CMD ["/start.sh"]