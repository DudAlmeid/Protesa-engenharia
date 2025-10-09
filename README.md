# PROTESA ENGENHARIA - Sistema de Gestão

Sistema de gestão de solicitações e projetos para a PROTESA ENGENHARIA, especialista em atividades de coordenação e controle da operação de energia elétrica.

## 🚀 Deploy na Nuvem

📖 **[Guia Completo de Deploy na Nuvem](DEPLOY_CLOUD.md)**
📖 **[Deploy Railway - Passo a Passo](DEPLOY_RAILWAY.md)**

### Opções de Hospedagem:
- ⭐ **Railway.app** (Recomendado) - Fácil e grátis para começar
- **Render.com** - Deploy automático
- **DigitalOcean, AWS, Azure** - Para produção em larga escala

## 💻 Desenvolvimento Local

Este projeto foi configurado para rodar com Docker, facilitando o desenvolvimento e deploy.

### Pré-requisitos

- Docker
- Docker Compose

## Estrutura dos Containers

- **app**: Aplicação PHP com Apache
- **db**: Banco de dados MySQL 8.0
- **phpmyadmin**: Interface web para gerenciar o banco de dados

## Como usar

### 1. Configuração inicial

```bash
# Clone o repositório (se necessário)
git clone [repository-url]
cd Protesa

# Copie o arquivo de exemplo de configuração (opcional)
cp .env.example .env
```

### 2. Subir os containers

```bash
# Construir e iniciar todos os serviços
docker-compose up -d --build

# Ou apenas iniciar (após a primeira construção)
docker-compose up -d
```

### 3. Acessar a aplicação

- **Aplicação principal**: http://localhost:8080
- **phpMyAdmin**: http://localhost:8081
  - Usuário: `root`
  - Senha: `protesa123`

### 4. Configuração do Banco de Dados

O banco de dados será criado automaticamente com:
- Nome: `db_protesa`
- Usuário root: `root` / `protesa123`
- Usuário aplicação: `protesa_user` / `protesa123`

#### Estrutura inicial

O arquivo `sql/init.sql` contém a estrutura básica das tabelas e alguns dados iniciais.

### 5. Comandos úteis

```bash
# Ver logs dos containers
docker-compose logs -f

# Parar os containers
docker-compose down

# Parar e remover volumes (apaga dados do banco)
docker-compose down -v

# Executar comandos no container da aplicação
docker-compose exec app bash

# Executar comandos no container do banco
docker-compose exec db mysql -u root -p db_protesa
```

### 6. Estrutura de Arquivos

```
Protesa/
├── Controller/          # Controllers da aplicação
├── Model/              # Models e conexão com banco
├── View/               # Views (páginas)
├── Template/           # Templates e assets
├── Files_Protesa/      # Arquivos uploadados
├── sql/                # Scripts SQL iniciais
├── Dockerfile          # Configuração do container PHP
├── docker-compose.yml  # Orquestração dos containers
└── README.md          # Este arquivo
```

### 7. Personalização

#### Alterar configurações do banco

Edite o arquivo `docker-compose.yml` ou crie um arquivo `.env` baseado no `.env.example`.

#### Usar connection.php para Docker

Para usar a configuração de banco específica para Docker, substitua os includes de `connection.php` por `connection.docker.php` nos arquivos PHP.

#### Adicionar mais dados iniciais

Edite o arquivo `sql/init.sql` para adicionar mais tabelas ou dados iniciais.

### 8. Troubleshooting

#### Erro de conexão com banco
- Verifique se todos os containers estão rodando: `docker-compose ps`
- Verifique os logs: `docker-compose logs db`

#### Permissões de arquivos
```bash
# Ajustar permissões se necessário
docker-compose exec app chown -R www-data:www-data /var/www/html/
docker-compose exec app chmod -R 755 /var/www/html/
```

#### Reset completo
```bash
# Parar tudo e remover volumes
docker-compose down -v

# Remover imagens (opcional)
docker-compose down --rmi all

# Reconstruir tudo
docker-compose up -d --build
```

## Produção

Para usar em produção:

1. Altere as senhas padrão
2. Configure SSL/HTTPS
3. Use volumes externos para dados persistentes
4. Configure backup do banco de dados
5. Ajuste as configurações de segurança do MySQL