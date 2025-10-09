# 🚀 Deploy Rápido - Railway.app

## ⏱️ Tempo estimado: 10 minutos

### ✅ Checklist Pré-Deploy

- [ ] Código commitado no Git
- [ ] Repositório no GitHub
- [ ] Dockerfile presente (já está ✅)
- [ ] docker-compose.yml presente (já está ✅)

---

## 📋 Passo a Passo

### 1️⃣ Criar Conta no Railway
```
🌐 https://railway.app
👉 Clique em "Start a New Project"
🔐 Login com GitHub
```

### 2️⃣ Fazer Push para GitHub (se ainda não fez)
```bash
# No terminal, dentro da pasta do projeto:
cd /Users/ramongiovanibsilva/estudos/Protesa

# Inicializar git (se ainda não fez)
git init
git add .
git commit -m "Projeto PROTESA pronto para deploy"

# Criar repositório no GitHub e fazer push
git remote add origin https://github.com/SEU_USUARIO/Protesa.git
git branch -M main
git push -u origin main
```

### 3️⃣ Criar Projeto no Railway

**No Railway Dashboard:**
```
1. Clique em "+ New Project"
2. Selecione "Deploy from GitHub repo"
3. Autorize Railway a acessar GitHub (se necessário)
4. Escolha o repositório "Protesa"
5. Aguarde o deploy automático
```

### 4️⃣ Adicionar Banco de Dados MySQL

**No seu projeto Railway:**
```
1. Clique em "+ New" 
2. Selecione "Database"
3. Escolha "MySQL"
4. Aguarde a criação (1-2 minutos)
```

### 5️⃣ Configurar Variáveis de Ambiente

**No serviço da aplicação (não no banco):**
```
1. Clique no serviço "protesa" (ou nome da sua app)
2. Vá na aba "Variables"
3. Clique em "Raw Editor"
4. Cole estas variáveis:
```

```bash
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_USER=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}
DB_NAME=db_protesa
```

Railway vai substituir automaticamente os valores `${{}}` !

### 6️⃣ Importar Estrutura do Banco

**Opção A: Via Railway CLI** (Recomendado)
```bash
# Instalar Railway CLI
npm i -g @railway/cli

# Fazer login
railway login

# Conectar ao projeto
railway link

# Importar SQL
railway run mysql -u root -p db_protesa < sql/init.sql
```

**Opção B: Via phpMyAdmin Local**
```bash
# 1. Obter credenciais do MySQL no Railway
# 2. Conectar via MySQL Workbench ou phpMyAdmin
# 3. Importar arquivo sql/init.sql
```

**Opção C: Direto pelo Railway**
```bash
# No Railway, no serviço MySQL:
# 1. Clique em "Connect"
# 2. Use o comando fornecido para conectar
# 3. Execute o SQL manualmente ou via comando
```

### 7️⃣ Gerar Domínio Público

```
1. No serviço da aplicação
2. Vá em "Settings"
3. Clique em "Generate Domain"
4. Copie a URL gerada (ex: protesa-production.up.railway.app)
```

### 8️⃣ Testar a Aplicação

```
✅ Acesse a URL gerada
✅ Teste login
✅ Verifique banco de dados
```

---

## 🎉 Pronto! Sua aplicação está na nuvem!

### URLs:
- **Aplicação**: https://seu-projeto.up.railway.app
- **Railway Dashboard**: https://railway.app/project/SEU_ID

---

## 🔧 Comandos Úteis Railway CLI

```bash
# Ver logs em tempo real
railway logs

# Abrir shell no container
railway shell

# Redeploy
railway up

# Ver variáveis
railway variables

# Conectar ao MySQL
railway connect MySQL
```

---

## 💡 Dicas

1. **Deploy automático**: Cada push no GitHub faz deploy automático
2. **Branches**: Pode criar ambientes para cada branch
3. **Rollback**: Pode voltar para versões anteriores
4. **Logs**: Sempre monitore os logs após deploy
5. **Custos**: Monitore uso no dashboard

---

## 🐛 Troubleshooting

### Erro: "Application failed to respond"
```bash
# Verificar logs
railway logs

# Verificar se porta está correta (80)
# Verificar se Dockerfile está correto
```

### Erro: "Database connection failed"
```bash
# Verificar variáveis de ambiente
railway variables

# Verificar se MySQL está rodando
# Ver serviços ativos no dashboard
```

### Erro: "Build failed"
```bash
# Ver logs de build
# Verificar Dockerfile
# Verificar se todos arquivos foram commitados
```

---

## 📊 Monitoramento

No Railway Dashboard você pode ver:
- ✅ Status dos serviços
- ✅ Uso de recursos (CPU, RAM)
- ✅ Logs em tempo real
- ✅ Métricas de rede
- ✅ Custos estimados

---

## 💰 Custos Railway

**Plano Hobby (Grátis):**
- $5 de crédito/mês
- Suficiente para:
  - 1 aplicação PHP
  - 1 banco MySQL pequeno
  - Tráfego moderado

**Plano Pro ($20/mês):**
- $20 de crédito incluso
- Recursos ilimitados
- Suporte prioritário

---

## 🔐 Segurança em Produção

**IMPORTANTE! Antes de abrir para público:**

1. ✅ Alterar senhas padrão no código
2. ✅ Usar variáveis de ambiente para senhas
3. ✅ Habilitar HTTPS (automático no Railway)
4. ✅ Configurar backup do banco
5. ✅ Implementar rate limiting
6. ✅ Validar todas as entradas de usuário
7. ✅ Usar prepared statements (já usa mysqli ✅)