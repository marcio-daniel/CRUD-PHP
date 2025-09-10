### **DOCUMENTAÇÃO DE SOFTWARE**

---

# **1. Visão Geral**
## **1.1 Introdução**
O sistema documentado é uma aplicação desenvolvida em PHP responsável por gerenciar registros de usuários, armazenamento de dados relacionados ao seu peso, e cálculo de IMC (Índice de Massa Corporal). Ele integra uma arquitetura robusta baseada em princípios de controle através de repositórios e serviços. Seu propósito é oferecer um ambiente seguro no qual usuários podem monitorar informações de saúde relacionadas ao peso e registrar dados no sistema.

---

# **2. Resumo Técnico**
Esta seção detalha aspectos técnicos do sistema, como arquitetura, segurança, e comportamento.

## **2.1 Arquitetura do Sistema**
O sistema utiliza o padrão MVC (Model-View-Controller) e uma configuração baseada em containers de serviços para injeção de dependências. As principais tecnologias e conceitos são:

- **Padrão MVC**: Organiza a lógica do sistema em camadas separadas.
- **Injeção de dependência**: Configurada através da classe `Container`.
- **Banco de Dados**: PostgreSQL, utilizando repositórios para interação.

O software é organizado em camadas:
1. Controladores (`Controller`): Manipulam as requisições HTTP.
2. Modelos (`Model`): Representam as entidades principais (usuário e peso).
3. Repositórios (`Repository`): Realizam a comunicação com o banco de dados.
4. Serviços (`Service`): Centralizam lógicas de negócios.
5. Classes auxiliares (`Helpers`, `Middleware`, etc.).

---

# **3. Especificação Técnica**
Nesta seção, detalhamos os componentes e suas funcionalidades.

## **3.1 Estrutura do Sistema**

### **3.1.1 Pastas Principais**
- **`src/app`**: Contém a lógica primária do sistema (controladores, modelos, repositórios, serviços, etc.).
- **`src/vendor`**: Gerenciamento de auto-load implementado com Composer.

---

### **3.1.2 Diagrama de Camada**
```plaintext
--------------------------------
|      Views (Interface)       | <-- ex.: home.php, login.php
--------------------------------
           |
Controller - Interpreta requisições e retorna respostas.
           |
         Services - (Validação, Regras). 
           |
Repository - Lida com armazenagem dos dados em BD.
           |
        Database Layer (PostgreSQL)
```

---

## **3.2 Componentes do Sistema**

### **3.2.1 Models (Domínio do Negócio)**
#### **User (Modelo de Usuário)**
- **Atributos**:
  - `id` - Identificador único no banco de dados.
  - `name` - Nome do usuário.
  - `email` - Endereço de e-mail, único.
  - `password` - Senha encriptada.
  - `height`, `current_weight`, `imc`.

- **Principais Métodos**:
  - `initializeUser()`: Recebe os dados do usuário e calcula IMC baseado no peso e altura.
  - `verifyPassword()`: Desencripta e valida a senha.

#### **Weight (Modelo de Peso do Usuário)**
- **Atributos**:
  - `id`, `weight_value`, `weight_date`, `user_id`.

- **Métodos**:
  - `initializeWeight()`: Registra peso, formata data e associa o peso a um ID de usuário.

---

### **3.2.2 Services (Regras de Negócio)**
#### **UserServices**
Fornece operações como:
- Criação de usuários (`create`): Gera novos usuários com as validações necessárias.
- Atualização (`update`): Altera propriedades do usuário garantindo restrições.

#### **WeightService**
Gerencia os dados de peso do usuário, oferecendo um serviço centralizado para armazenar alterações.

---

### **3.2.3 Repositories**
Responsáveis pela comunicação com o banco de dados para abstrair dados persistidos. Segue o padrão DAO (Data Access Object).
- `UserRepository`: Manipula os dados da tabela `users`.
- `WeightRepository`: Foca na tabela `weights`.

---

### **3.2.4 Controllers (Rotas e Gerenciamento HTTP)**
Cada controlador é responsável por lidar com um segmento específico da aplicação:
- **HomeController**:
  - `index`: Exibe a tela inicial ou "Home".
  - `filter`: Retorna o histórico de pesos com filtros (ex.: por mês).

- **LoginController**:
  - `index`: Exibe a página de login.
  - `login/logout`: Controla sessões.
  
- **UserController**:
  - `registration`, `create`: Permite cadastro de novos usuários.
  - `profile`, `update`: Exibe ou altera informações.

- **WeightController**:
  - `create`, `store`: Adiciona registros de peso ao banco.

---

### **3.2.5 Infraestrutura**
#### **Banco de Dados PostgreSQL**
- Configuração definida na classe `PostgreSQLDatabase`.
- Tabelas:
  - `users`: Registra cada usuário.
  - `weights`: Guarda entradas de peso.
  
#### **Autenticação e Hashtags**
- A classe `Hashing` fornece métodos para criptografar e verificar senhas.
- `Authenticator`: Verifica credenciais enviadas (e-mail/senha).

---

## **3.3 Fluxo Principal da Aplicação**

### **3.3.1 Cadastro**
1. Usuário visita `/registration`.
2. Submete formulário preenchido com nome, e-mail, senha e informações de peso.
3. Back-end valida senhas e confere duplicação de e-mail.
4. Novo registro criado na tabela `users`.

### **3.3.2 Login**
1. Usuário acessa a rota `/`.
2. Submete credenciais, que são verificadas por `Authenticator`.
3. Sessão inicializada e usuário é redirecionado à `/home`.

### **3.3.3 Registro de Peso**
1. Usuário logado acessa `/weight/create`.
2. Submete peso e data.
3. Este registro é atrelado ao `user_id` no PostgreSQL.

---

## **3.4 Segurança**
- **Criptografia segura para senhas**:
  - Funções oferecidas nativamente pelo PHP (`password_hash` e `password_verify`) garantem proteção.
- **Proteção de Rotas**:
  - Middleware impede acesso não autorizado conferindo credenciais da `$_SESSION`.

---

# **4. Conclusão**
Este projeto foi desenhado para ser modular, seguro e escalável. Ele implementa funções relacionadas ao gerenciamento de estado do usuário e acompanhamento fitness. Registros de segurança foram cuidados para suportar boas práticas.

O desenvolvimento modular permite fácil extensão. Caso novas funcionalidades sejam necessárias, será possível adicionar novos serviços ou componentes sem afetar drasticamente o sistema.