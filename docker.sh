#!/bin/bash

# Script para facilitar o uso do Docker no projeto PROTESA

case "$1" in
    "start")
        echo "🚀 Iniciando containers do PROTESA (modo desenvolvimento)..."
        docker-compose up -d --build
        echo "✅ Containers iniciados!"
        echo "📱 Aplicação: http://localhost:8080"
        echo "🗄️  phpMyAdmin: http://localhost:8081"
        echo "🔥 Hot reload ativado - mudanças no código aparecem instantaneamente!"
        ;;
    "start-prod")
        echo "🚀 Iniciando containers do PROTESA (modo produção)..."
        docker-compose -f docker-compose.prod.yml up -d --build
        echo "✅ Containers iniciados!"
        echo "📱 Aplicação: http://localhost:8080"
        echo "🗄️  phpMyAdmin: http://localhost:8081"
        ;;
    "stop")
        echo "🛑 Parando containers..."
        docker-compose down
        echo "✅ Containers parados!"
        ;;
    "restart")
        echo "🔄 Reiniciando containers..."
        docker-compose down
        docker-compose up -d --build
        echo "✅ Containers reiniciados!"
        ;;
    "logs")
        echo "📋 Mostrando logs..."
        docker-compose logs -f
        ;;
    "reset")
        echo "⚠️  ATENÇÃO: Isso vai apagar todos os dados do banco!"
        read -p "Tem certeza? (s/N): " -n 1 -r
        echo
        if [[ $REPLY =~ ^[Ss]$ ]]; then
            echo "🗑️  Removendo containers e volumes..."
            docker-compose down -v
            docker-compose up -d --build
            echo "✅ Reset completo realizado!"
        else
            echo "❌ Operação cancelada"
        fi
        ;;
    "status")
        echo "📊 Status dos containers:"
        docker-compose ps
        ;;
    *)
        echo "🐳 Script de gerenciamento do PROTESA Docker"
        echo ""
        echo "Uso: $0 {start|start-prod|stop|restart|logs|reset|status}"
        echo ""
        echo "Comandos:"
        echo "  start      - Inicia os containers (modo desenvolvimento com hot reload)"
        echo "  start-prod - Inicia os containers (modo produção)"
        echo "  stop       - Para os containers"
        echo "  restart    - Reinicia os containers"
        echo "  logs       - Mostra os logs em tempo real"
        echo "  reset      - Reset completo (apaga dados!)"
        echo "  status     - Mostra status dos containers"
        echo ""
        exit 1
        ;;
esac