# Deploy PROTESA no Railway.app

## 🚂 Railway - Deploy Automático

### Passo 1: Preparar o Projeto

O projeto já está pronto com Docker! ✅

### Passo 2: Criar Conta no Railway

1. Acesse: https://railway.app
2. Clique em "Start a New Project"
3. Faça login com GitHub

### Passo 3: Deploy do Repositório

1. No Railway Dashboard:
   - Clique em "New Project"
   - Selecione "Deploy from GitHub repo"
   - Escolha o repositório "Protesa"

2. Railway vai detectar automaticamente o Dockerfile

### Passo 4: Adicionar MySQL

1. No seu projeto Railway:
   - Clique em "+ New"
   - Selecione "Database"
   - Escolha "MySQL"

2. Railway vai criar um banco MySQL automaticamente

### Passo 5: Configurar Variáveis de Ambiente

No serviço da aplicação, adicione as variáveis:

```bash
DB_HOST=<copie do serviço MySQL>
DB_NAME=db_protesa
DB_USER=root
DB_PASSWORD=<copie do serviço MySQL>
```

Railway fornece essas variáveis automaticamente!

### Passo 6: Deploy

1. Railway faz deploy automático
2. Acesse a URL gerada
3. Pronto! 🎉

### Custos

- **Gratuito**: $5 de crédito/mês
- Suficiente para desenvolvimento e testes
- Upgrade disponível se necessário

---

## 🌐 Alternativa: Render.com

### Vantagens Render
- PostgreSQL grátis (precisaria migrar)
- Deploy automático do GitHub
- SSL incluso

### Passos:

1. Acesse: https://render.com
2. Conecte com GitHub
3. New > Web Service
4. Selecione repositório
5. Render detecta Dockerfile
6. Adicione PostgreSQL grátis

**Nota:** Precisaria converter MySQL para PostgreSQL

---

## 💰 Comparação de Custos

| Serviço | Gratuito | MySQL | PHP/Docker |
|---------|----------|-------|------------|
| Railway | ✅ $5 crédito | ✅ Incluso | ✅ |
| Render | ✅ | ❌ Pago | ✅ |
| Heroku | ⚠️ Limitado | ❌ Add-on pago | ✅ |
| DigitalOcean | ❌ $5-12/mês | ✅ | ✅ |
| AWS | ✅ 12 meses | ✅ RDS | ✅ |

---

## 🔧 Arquivos Necessários (Já criados!)

- ✅ `Dockerfile` - Para container PHP
- ✅ `docker-compose.yml` - Configuração local
- ✅ `sql/init.sql` - Estrutura do banco
- ✅ `Model/connection.docker.php` - Conexão com variáveis de ambiente

---

## 📝 Próximos Passos

1. **Fazer push do código para GitHub** (se ainda não fez)
2. **Escolher Railway ou Render**
3. **Seguir os passos acima**
4. **Testar a aplicação na nuvem**

---

## ⚙️ Configurações Adicionais

### Para produção, considere:

1. **Alterar senhas padrão**
2. **Configurar backup do banco**
3. **Adicionar SSL (automático no Railway/Render)**
4. **Configurar domínio customizado** (opcional)
5. **Monitoramento e logs**

---

## 🆘 Problemas Comuns

### Erro de conexão com banco
- Verifique as variáveis de ambiente
- Confirme que o banco está rodando
- Verifique logs: `railway logs` ou painel do Render

### Aplicação não inicia
- Verifique Dockerfile
- Veja logs de build
- Confirme portas (80 para PHP)

### Arquivos não aparecem
- Verifique permissões de `Files_Protesa/`
- Configure volume persistente se necessário