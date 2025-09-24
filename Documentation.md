### Especificação Funcional do Sistema

O sistema implementado consiste em uma aplicação web que permite gerenciamento de usuários e rastreamento de peso. Abaixo está a especificação funcional:

#### **1. Autenticação e Sessões**
- **Cadastro de usuário**
  - Um usuário pode ser registrado com os seguintes campos: nome, e-mail (único), senha, altura e peso atual.
  - Senhas diferentes na confirmação são validadas, e o cadastro não é concluído.

- **Login/Logout**
  - Um usuário pode fazer login informando um e-mail e senha.
  - O sistema verifica a existência do e-mail e valida a senha.
  - Após login bem-sucedido, as informações do usuário são armazenadas em uma sessão.
  - O logout limpa os dados da sessão do usuário.

- **Proteção de Rotas**
  - As rotas são protegidas por um middleware (`MiddlewareManager`).
    - O middleware `auth` protege rotas contra acessos não autenticados.
    - O middleware `logged` redireciona usuários logados que tentam acessar rotas públicas (ex: login e registro).

#### **2. Core Functionality**
- **IMC (Índice de Massa Corporal)**
  - O IMC do usuário é calculado e exibido na página inicial após o login.
  - Baseado no IMC, o sistema classifica o peso do usuário em categorias como "normal", "acima do peso", "obesidade", etc.

- **Rastreamento de Peso**
  - Um usuário pode salvar um ou mais registros de peso associados a uma data.
  - Os pesos salvos podem ser consultados em um histórico através de filtros mensais.

#### **3. Estrutura do Sistema**
- **Roteamento**
  - O sistema utiliza rotas definidas em `routes.php`.
  - Rotas do tipo `GET` e `POST` são gerenciadas pela classe `Router`.

- **Armazenamento de Dados**
  - Há conexão com um banco de dados PostgreSQL.
  - O sistema armazena informações sobre:
    - Usuários (tabela `users`).
    - Pesos associados aos usuários (tabela `weights`).

- **Serviços**
  - Serviços especializados facilitam ações do controlador, como manipulação de usuários (`UserServices`) e pesos (`WeightService`).

- **Contêiner de Injeção de Dependência**
  - O sistema utiliza um contêiner para gerenciamento de dependências (`Container`), permitindo a resolução de classes e seus serviços relacionados.

---

### Descrição de Funcionalidades

#### **1. Controllers (Controladores)**
  
- **LoginController**
  - Manage login e logout.
  - Renderiza a página de login.
  - Autentica o usuário com verificação de e-mail e senha.
  - Provê logout através da destruição da sessão atual.

- **UserController**
  - Gerencia a interface do usuário para registro e atualização de perfil.
  - Renderiza as páginas de registro e perfil.
  - Manipula o salvamento de novos usuários e atualizações de perfil.

- **WeightController**
  - Fornece uma interface para registrar o peso do usuário.
  - Exibe a página "Adicionar Peso" e armazena dados submetidos.

#### **2. Repositórios**
- Implementa acesso ao banco de dados para usuários e pesos.
  - **UserRepository**: salva/atualiza/extrai dados relacionados aos usuários.
  - **WeightRepository**: gerencia dados de pesos.

#### **3. Views**
- Templates dinâmicos PHP para páginas front-end, como:
  - Página inicial (`home`): Mostra IMC do usuário e histórico de pesos.
  - Registro (`registration`): Permite criar uma nova conta.
  - Perfil (`profile`): Exibe os dados do perfil (com função de edição).
  - Adicionar Peso (`weight`): Formulário para registrar novos pesos.

#### **4. Middleware**
- `MiddlewareManager` redireciona usuários autenticados ou não-autenticados para rotas apropriadas.

---

### **Diagramas**

#### **1. Diagrama Geral de Arquitetura**

```plaintext
+---------------+               +------------------+
|   Navegador   | <-- HTTP -->  |      Servidor    |
+---------------+               +--------+---------+
                                       |
                                       v
                   +---------------------------------------+
                   |     Estrutura Principal da Aplicação  |
                   +---------------------------------------+
                    | Controllers | Services | Repositories|
                    +-------------+----------+-------------+

Fluxo Geral de Requisições:
1. Request --> Router --> MiddlewareManager (verifica autenticação e permissões)
2. Controlador aciona Service (regra de negócio e validações).
3. Serviços chamam o Repositório (CRUD no banco de dados).
4. Resposta exibida via Engine/View.

```

#### **2. Diagrama de Classes (Simplificado)**

```plaintext
+------------------+
|    Container     |
+------------------+
| instances        |
| set(key, value)  |
| get(key)         |
+------------------+

+----------------------+      +------------------+
|   Authenticator      |      |  MiddlewareManager|
+----------------------+      +------------------+
| verifyEmail()        |<-->  | verify(type)     |
| verifyPassword()     |      |                 |
+----------------------+      +------------------+

+------------------+   +----------------------+
|   UserController |   |   UserServices       |
| create/update()  |<--> save/update UserRepo |
+------------------+   +----------------------+

+----------------------+      +---------------------+
|  PostgreSQLDatabase  |<---->|   UserRepository    |
| connect              |      | findById(), save() |
+----------------------+      +---------------------+

```

#### **3. Modelagem Representacional do Dados**

```plaintext
Tabela: `users`
+-------------+--------------+
| Campo       | Tipo         |
+-------------+--------------+
| id          | INT (PK)     |
| name        | STRING       |
| email       | STRING (UNQ) |
| password    | STRING       |
| height      | FLOAT        |
| current_weight | FLOAT     |
+-------------+--------------+

Tabela: `weights`
+-------------+--------------+
| Campo       | Tipo         |
+-------------+--------------+
| id          | INT (PK)     |
| user_id     | INT (FK)     |
| weight_val  | FLOAT        |
| weight_date | DATE         |
+-------------+--------------+
```

### **Conclusão**
O sistema implementado baseia-se fortemente em princípios de design limpo, como injeção de dependência, separação de camadas e uso de middleware para controle de autorização. Além disso, fornece uma interface simples para rastreamento de peso e análise de IMC. As rotas e views são responsivas e bem definidas.