FROM php:8.1-apache
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN a2enmod rewrite

ENV APACHE_DOCUMENT_ROOT /var/www/html
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN apt-get update && apt-get install -y default-mysql-client && rm -rf /var/lib/apt/lists/*

COPY apache.conf /etc/apache2/sites-available/000-default.conf
WORKDIR /var/www/html
COPY . .

RUN a2ensite 000-default && a2enmod rewrite
RUN chown -R www-data:www-data /var/www/html/ && chmod -R 755 /var/www/html/
RUN mkdir -p /var/www/html/src/Files_Protesa && chmod -R 777 /var/www/html/src/Files_Protesa/


EXPOSE 80
ENV PORT=80

COPY sql/ /sql/

RUN echo '#!/bin/bash\n\
set -e\n\
\n\
# Corrige valores com aspas das variáveis do Railway\n\
MYSQLPORT=$(echo $MYSQLPORT | tr -d "\"")\n\
MYSQLHOST=$(echo $MYSQLHOST | tr -d "\"")\n\
MYSQLUSER=$(echo $MYSQLUSER | tr -d "\"")\n\
MYSQLPASSWORD=$(echo $MYSQLPASSWORD | tr -d "\"")\n\
MYSQLDATABASE=$(echo $MYSQLDATABASE | tr -d "\"")\n\
\n\
PORT_NUMBER=$(echo $PORT | sed "s/[^0-9]*//g")\n\
if [ -z "$PORT_NUMBER" ]; then PORT_NUMBER=80; fi\n\
sed -i "s/Listen .*/Listen ${PORT_NUMBER}/" /etc/apache2/ports.conf\n\
sed -i "s/<VirtualHost .*>/<VirtualHost *:${PORT_NUMBER}>/" /etc/apache2/sites-available/000-default.conf\n\
\n\
echo \"⏳ Aguardando conexão com MySQL em $MYSQLHOST:$MYSQLPORT...\"\n\
until mysql -h \"$MYSQLHOST\" -P \"$MYSQLPORT\" -u \"$MYSQLUSER\" -p\"$MYSQLPASSWORD\" -e \"SELECT 1\" \"$MYSQLDATABASE\" &>/dev/null; do\n\
  sleep 2\n\
done\n\
\n\
if [ -f /sql/init.sql ]; then\n\
  echo \"🚀 Executando /sql/init.sql...\"\n\
  mysql -h \"$MYSQLHOST\" -P \"$MYSQLPORT\" -u \"$MYSQLUSER\" -p\"$MYSQLPASSWORD\" \"$MYSQLDATABASE\" < /sql/init.sql || {\n\
    echo \"❌ Erro ao executar init.sql\"; exit 1;\n\
  }\n\
  echo \"✅ Script SQL executado com sucesso!\"\n\
else\n\
  echo \"⚠️ Nenhum arquivo /sql/init.sql encontrado.\"\n\
fi\n\
\n\
exec apache2-foreground' > /start.sh && chmod +x /start.sh

CMD ["/start.sh"]
