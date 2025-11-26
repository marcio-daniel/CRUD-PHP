## Especificação Funcional do Sistema

O sistema desenvolvido é uma aplicação web que possibilita o gerenciamento de peso dos usuários, permitindo o cadastro, login, manipulação de pesos e cálculo de Índice de Massa Corporal (IMC). Abaixo estão as funcionalidades detalhadas:

---

### 1. **Rotas e Navegação**
O sistema mapeia endereços HTTP através de rotas especificadas, utilizando um roteador para ligar rotas às ações dos controladores.

- **Rotas GET:**
  - `/` - Página inicial de login.
  - `/registration` - Página de registro para criação de conta.
  - `/home` - Página inicial/logada do sistema.
  - `/logout` - Desloga o usuário.
  - `/weight/create` - Formulário para adicionar um novo peso.
  - `/user/profile` - Página de visualização e edição do perfil do usuário.
  - `/user/filter` - Consulta o histórico de pesos filtrado por mês.

- **Rotas POST:**
  - `/user/create` - Realiza o cadastro de um usuário no sistema.
  - `/user/update` - Atualiza as informações cadastrais do usuário logado.
  - `/login` - Realiza login no sistema.
  - `/weight/store` - Salva o peso inserido pelo usuário.

---

### 2. **Controle de Sessão**
- **MiddlewareManager**: Gerencia verificações antes da execução de certas ações, como:
  - **`auth`**: Bloqueia acesso não logado.
  - **`logged`**: Evita acesso à página de login quando o usuário está autenticado.

---

### 3. **Funcionamento do Sistema**
#### a. **Autenticação**
- **Login**:
  - A classe `Authenticator` autentica o usuário verificando o e-mail e senha.
  - Após validação, o serviço de login (`LoginService`) armazena o usuário na sessão para controle.

- **Logout**:
  - Remove os dados de sessão e desloga o usuário.

#### b. **Cadastro de Usuário**
- Um novo usuário pode ser cadastrado verificando:
  - E-mails duplicados.
  - Validação da senha e confirmação.

#### c. **Gerenciamento de Peso**
- Os usuários podem:
  - Salvar seus pesos com data específica.
  - Consultar históricos de peso filtrando por mês.
  - Calcular automaticamente o IMC (armazenado no perfil do usuário).

#### d. **Perfil do Usuário**
- Os usuários podem:
  - Atualizar dados pessoais (nome, e-mail e senha).
  - Editar altura, o que impacta no cálculo do IMC.

---

### 4. **Regras de Negócio**
- Senhas são armazenadas de forma segura utilizando hashing.
- Apenas usuários autenticados podem acessar funcionalidades protegidas (home, adicionar peso, editar perfil).
- O IMC é atualizado automaticamente sempre que o peso ou altura é alterado.

---

### 5. **Estrutura de Banco de Dados**
- **Tabela de Usuários (`users`)**
  - Campos: `id`, `name`, `email`, `password`, `height`, `current_weight`, `imc`.

- **Tabela de Pesos (`weights`)**
  - Campos: `id`, `weight_value`, `weight_date`, `user_id`.

---

### 6. **Configuração de Dependências (Injeção de Dependências)**
- O sistema utiliza um container para resolução de dependências e injeção automática de serviços, repositórios e controladores.

---

### 7. **Interface do Usuário**
- O sistema utiliza **HTML** e **Bootstrap** para interface amigável e responsiva.
- As páginas incluem:
  1. Login.
  2. Registro.
  3. Página inicial com histórico de peso e cálculo de IMC.
  4. Adição de novo peso.
  5. Gerenciamento do perfil.

---

## Diagrama de Arquitetura

### Arquitetura Global do Sistema
```plaintext
[Rotas (Routes.php)]
         |
 [Roteador (Router.php)]  
         |
[Controladores (Controllers - Login, User, Weight, Home)]
         |
 [Serviços (Services)]
         |
 [Repositórios (Repositories)] -> [Banco de Dados PostgreSQL (users, weights)]
```

1. **Rotas (`routes.php`)** mapeiam as URLs para os controladores.
2. **Roteador (`Router.php`)** interpreta requisições HTTP e chama métodos nos controladores.
3. **Controladores (`Controllers`)** contêm a lógica de ações específicas (login, registro, perfil).
4. **Serviços (`Services`)** encapsulam a lógica de negócio.
5. **Repositórios (`Repositories`)** acessam e manipulam o banco através de SQL.

---

### Diagrama de Classe Simplificado

```plaintext
+---------------------+
|     Authenticator   |
+---------------------+
| - email             |
| - password          |
| + verifyEmail()     |
| + verifyPassword()  |
+---------------------+

+-------------------+             +----------------+
|  LoginController  |             |   User         |
+-------------------+    uses     +----------------+
| + login()         |<------------| - id           |
| + logout()        |             | - email        |
+-------------------+             | - password*    |
                                  +----------------+
+-------------------+
|  UserController   |
+-------------------+
| + create()        |
| + profile()       |
| + update()        |
+-------------------+
```

---

### Diagrama de Sequência de Login

```plaintext
Usuário -> LoginController -> Authenticator -> UserRepository
   |              |                 |                 |
  /login  -----> index() -------> verifyEmail() -> busca no banco
   |              |                 |                 |
  Insere credenciais verifica senha -> true -----------------
      |
 Sessão criada e redireciona "/home"
```