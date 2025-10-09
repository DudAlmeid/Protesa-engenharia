-- Script de inicialização do banco de dados PROTESA ENGENHARIA
-- Este arquivo será executado automaticamente quando o container MySQL for criado

-- Criar database se não existir
CREATE DATABASE IF NOT EXISTS db_protesa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_protesa;

-- Tabela de empresas
CREATE TABLE IF NOT EXISTS tb_cad_empresa (
    idEmpresa INT AUTO_INCREMENT PRIMARY KEY,
    nmRazaoSocial VARCHAR(255) NOT NULL,
    idCNPJ VARCHAR(18) UNIQUE,
    icSituacaoEmpresa TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Tabela de perfis de usuário
CREATE TABLE IF NOT EXISTS tb_item_perfil (
    idPerfil INT AUTO_INCREMENT PRIMARY KEY,
    nmPerfil VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de usuários
CREATE TABLE IF NOT EXISTS tb_cad_user (
    idUser INT AUTO_INCREMENT PRIMARY KEY,
    nmUser VARCHAR(255) NOT NULL,
    nmLoginUser VARCHAR(100) UNIQUE NOT NULL,
    nmSenhaUser VARCHAR(255) NOT NULL,
    idCPF VARCHAR(14) UNIQUE NOT NULL,
    idTelefone VARCHAR(20),
    auxSenha VARCHAR(255),
    idEmpresa INT,
    idPerfil INT,
    icSituacaoUser TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (idEmpresa) REFERENCES tb_cad_empresa(idEmpresa) ON DELETE SET NULL,
    FOREIGN KEY (idPerfil) REFERENCES tb_item_perfil(idPerfil) ON DELETE SET NULL
);

-- Tabela de status de solicitações
CREATE TABLE IF NOT EXISTS tb_status_solicitacao (
    idStatusSolicitacao INT AUTO_INCREMENT PRIMARY KEY,
    nmStatusSolicitacao VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de solicitações/cotações
CREATE TABLE IF NOT EXISTS tb_solicitacao (
    idSolicitacao INT AUTO_INCREMENT PRIMARY KEY,
    nmTituloSolicitacao VARCHAR(255) NOT NULL,
    dsSolicitacao TEXT NOT NULL,
    idStatusSolicitacao INT DEFAULT 1,
    dtSolicitacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    idUserSolicitacao INT,
    idEmpresa INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (idStatusSolicitacao) REFERENCES tb_status_solicitacao(idStatusSolicitacao),
    FOREIGN KEY (idUserSolicitacao) REFERENCES tb_cad_user(idUser) ON DELETE SET NULL,
    FOREIGN KEY (idEmpresa) REFERENCES tb_cad_empresa(idEmpresa) ON DELETE SET NULL
);

-- Tabela de situações de projeto
CREATE TABLE IF NOT EXISTS tb_situacao_projeto (
    idSituacaoProjeto INT AUTO_INCREMENT PRIMARY KEY,
    nmSituacaoProjeto VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabela de projetos
CREATE TABLE IF NOT EXISTS tb_projeto (
    idProjeto INT AUTO_INCREMENT PRIMARY KEY,
    idUserTecnico INT,
    idSituacaoProjeto INT DEFAULT 1,
    idSolicitacaoProjeto INT UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (idUserTecnico) REFERENCES tb_cad_user(idUser) ON DELETE SET NULL,
    FOREIGN KEY (idSituacaoProjeto) REFERENCES tb_situacao_projeto(idSituacaoProjeto),
    FOREIGN KEY (idSolicitacaoProjeto) REFERENCES tb_solicitacao(idSolicitacao) ON DELETE CASCADE
);

-- Tabela de itens do projeto (tramites)
CREATE TABLE IF NOT EXISTS tb_item_projeto (
    idItemProjeto INT AUTO_INCREMENT PRIMARY KEY,
    idProjeto INT,
    dsItemProjeto TEXT NOT NULL,
    dtItemProjeto TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    idItemUser INT,
    docItemProjeto VARCHAR(255),
    imgItemProjeto VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idProjeto) REFERENCES tb_projeto(idProjeto) ON DELETE CASCADE,
    FOREIGN KEY (idItemUser) REFERENCES tb_cad_user(idUser) ON DELETE SET NULL
);

-- =============================================================================
-- INSERIR DADOS INICIAIS
-- =============================================================================

-- Inserir perfis de usuário
INSERT IGNORE INTO tb_item_perfil (idPerfil, nmPerfil) VALUES 
(1, 'Administrador'),
(2, 'Usuário'),
(3, 'Gestor'),
(4, 'Técnico');

-- Inserir status de solicitações
INSERT IGNORE INTO tb_status_solicitacao (idStatusSolicitacao, nmStatusSolicitacao) VALUES 
(1, 'Pendente'),
(2, 'Em Análise'),
(3, 'Aprovada'),
(4, 'Rejeitada'),
(5, 'Em Andamento'),
(6, 'Concluída'),
(7, 'Cancelada');

-- Inserir situações de projeto
INSERT IGNORE INTO tb_situacao_projeto (idSituacaoProjeto, nmSituacaoProjeto) VALUES 
(1, 'Não Iniciado'),
(2, 'Em Andamento'),
(3, 'Pausado'),
(4, 'Concluído'),
(5, 'Cancelado');

-- Inserir empresa principal
INSERT IGNORE INTO tb_cad_empresa (idEmpresa, nmRazaoSocial, idCNPJ, icSituacaoEmpresa) VALUES 
(1, 'PROTESA ENGENHARIA LTDA', '00.000.000/0001-00', 1),
(2, 'EMPRESA CLIENTE EXEMPLO 1', '11.111.111/0001-11', 1),
(3, 'EMPRESA CLIENTE EXEMPLO 2', '22.222.222/0001-22', 1);

-- Inserir usuários iniciais (senha: admin123 para admin, senha123 para outros)
INSERT IGNORE INTO tb_cad_user (idUser, nmUser, nmLoginUser, nmSenhaUser, idCPF, idTelefone, idEmpresa, idPerfil, icSituacaoUser) VALUES 
(1, 'Administrador Sistema', 'admin', 'admin123', '000.000.000-00', '(11) 99999-9999', 1, 1, 1),
(2, 'João Silva - Gestor', 'joao.gestor', 'senha123', '111.111.111-11', '(11) 98888-8888', 1, 3, 1),
(3, 'Maria Santos - Técnica', 'maria.tec', 'senha123', '222.222.222-22', '(11) 97777-7777', 1, 4, 1),
(4, 'Pedro Oliveira - Usuário', 'pedro.user', 'senha123', '333.333.333-33', '(11) 96666-6666', 2, 2, 1),
(5, 'Ana Costa - Usuária', 'ana.user', 'senha123', '444.444.444-44', '(11) 95555-5555', 3, 2, 1);

-- Inserir solicitações de exemplo
INSERT IGNORE INTO tb_solicitacao (nmTituloSolicitacao, dsSolicitacao, idStatusSolicitacao, idUserSolicitacao, idEmpresa) VALUES 
('Solicitação de Projeto Elétrico', 'Necessidade de desenvolvimento de projeto elétrico para nova unidade industrial com dimensionamento de carga e especificação de materiais.', 1, 4, 2),
('Análise de Eficiência Energética', 'Estudo para melhoria da eficiência energética na planta atual, com análise de consumo e proposta de melhorias.', 2, 5, 3),
('Manutenção Preventiva Sistema', 'Solicitação de manutenção preventiva no sistema elétrico principal da fábrica.', 5, 4, 2);

-- Inserir projetos de exemplo
INSERT IGNORE INTO tb_projeto (idUserTecnico, idSituacaoProjeto, idSolicitacaoProjeto) VALUES 
(3, 2, 1),
(3, 1, 2),
(NULL, 1, 3);

-- Inserir itens/tramites de projeto
INSERT IGNORE INTO tb_item_projeto (idProjeto, dsItemProjeto, idItemUser) VALUES 
(1, 'Início da análise técnica do projeto elétrico', 3),
(1, 'Coleta de dados e requisitos do cliente', 3),
(1, 'Dimensionamento preliminar das cargas', 3),
(2, 'Solicitação recebida e aguardando alocação de técnico', 1);

-- =============================================================================
-- CRIAÇÃO DE INDEXES PARA MELHOR PERFORMANCE
-- =============================================================================

CREATE INDEX idx_user_login ON tb_cad_user(nmLoginUser);
CREATE INDEX idx_user_empresa ON tb_cad_user(idEmpresa);
CREATE INDEX idx_user_perfil ON tb_cad_user(idPerfil);
CREATE INDEX idx_solicitacao_status ON tb_solicitacao(idStatusSolicitacao);
CREATE INDEX idx_solicitacao_user ON tb_solicitacao(idUserSolicitacao);
CREATE INDEX idx_solicitacao_empresa ON tb_solicitacao(idEmpresa);
CREATE INDEX idx_projeto_solicitacao ON tb_projeto(idSolicitacaoProjeto);
CREATE INDEX idx_item_projeto ON tb_item_projeto(idProjeto);

-- =============================================================================
-- MENSAGEM DE CONFIRMAÇÃO
-- =============================================================================

SELECT 'Banco de dados PROTESA ENGENHARIA inicializado com sucesso!' as Status;