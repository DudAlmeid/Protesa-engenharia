#!/bin/bash

# Script para importar SQL no Railway
# 
# INSTRUÇÕES:
# 1. No Railway Dashboard, clique no serviço MySQL
# 2. Clique em "Connect"
# 3. Copie os valores e cole aqui:

MYSQLHOST="seu-host-aqui.proxy.rlwy.net"
MYSQLPORT="sua-porta"
MYSQLUSER="root"
MYSQLPASSWORD="sua-senha"
MYSQLDATABASE="railway"  # ou db_protesa se você já criou

# Criar o banco db_protesa se não existir
echo "Criando banco db_protesa..."
mysql -h "$MYSQLHOST" -P "$MYSQLPORT" -u "$MYSQLUSER" -p"$MYSQLPASSWORD" -e "CREATE DATABASE IF NOT EXISTS db_protesa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Importar o SQL
echo "Importando sql/init.sql..."
mysql -h "$MYSQLHOST" -P "$MYSQLPORT" -u "$MYSQLUSER" -p"$MYSQLPASSWORD" db_protesa < sql/init.sql

echo "✅ Concluído!"