### Especificação Funcional

O código recebido consiste em um sistema de gerenciamento de usuários e histórico de pesos, sua principal funcionalidade é permitir que os usuários possam registrar informações relativas ao peso, altura, perfil, e calcular o Índice de Massa Corporal (IMC). O sistema foi escrito em PHP com um padrão de organização baseado em OOP (Programação Orientada a Objetos) distribuído em diversas classes e módulos. Ele utiliza conceitos como injeção de dependência, PSR-4 autoload e interfaces para abstração.

---

#### Principais Funcionalidades:

1. **Gerenciamento de Usuários**
   - Cadastro de novos usuários.
   - Login e autenticação de usuários com validação de credenciais.
   - Atualização dos dados de perfil do usuário, como nome, senha e altura.
   - Função para listar e buscar usuários.

2. **Gerenciamento de Pesos**
   - Adição de registros de pesos com data.
   - Visualização de histórico de pesos por mês ou todos os registros.
   - Filtragem de pesos do histórico.

3. **Cálculo de IMC**
   - O índice de massa corporal (IMC) é calculado automaticamente com base na altura e peso atual registrado pelo usuário.

4. **Sistema de Rotas**
   - Gerenciamento de endereços de páginas para acesso das diferentes funcionalidades.
   - Suporte a metodologia GET e POST.
   - Middleware para controle de acesso baseado na sessão do usuário.

5. **Persistência de Dados**
   - Interação com banco de dados PostgreSQL por meio de PDO (PHP Data Objects), implementado com métodos para criar, ler, atualizar e excluir dados.
   - Repositórios implementam interfaces para padronizar os métodos de manipulação de dados.

6. **Sistema de Template Engine para renderização de views**
   - Atualização de elementos de interface com base nos dados do usuário.
   - Manuseio de arquivos PHP vivos e uso de Bootstrap para estilização.

---

#### Arquitetura do Sistema

1. **Camada de UI (Views)**
   - Arquivos dentro do diretório `src/app/views/`, são responsáveis por renderizar o HTML com base nas informações recebidas dos controladores e serviços.

2. **Camada de Controladores**
   - Arquivos dentro de `src/app/controllers/` manipulam as requisições e interagem com os serviços para realizar as operações no sistema.

3. **Camada de Serviços**
   - Arquivos dentro do diretório `src/app/services/` contêm a lógica de negócios, como criação, atualização de perfil e manipulação dos dados de pesos.

4. **Camada de Repositórios**
   - Arquivos localizados em `src/app/database/` são responsáveis por interagir diretamente com o banco de dados PostgreSQL. Eles utilizam classes e interfaces para separar responsabilidades.

5. **Extensões e Utilitários**
   - Funções auxiliares em `src/app/helpers/helpers.php` e `src/app/classes/Container.php`, além do gerenciamento automático de dependência implementado pelo Composer (arquivos em `src/vendor/composer`).

---

#### Fluxo de Dados

1. O usuário faz o login através da tela de login (`src/app/views/login.php`) informando email e senha.
2. O controlador `LoginController.php` utiliza a classe `Authenticator.php` para verificar a autenticidade das credenciais do usuário.
3. Após o sucesso no login, uma sessão é iniciada pelo serviço de login: `LoginService.php`. O usuário é redirecionado para a página inicial (home).
4. Na página inicial (`src/app/views/home.php`), são exibidas informações como peso atual do usuário e a lista de histórico de pesos.
5. A funcionalidade para adicionar novos pesos é acessada através do controlador `WeightController.php`, permitindo que os usuários registrem novos valores personalizados de peso e data. Este processo é realizado pelo serviço `WeightService.php`, que persiste os dados via `WeightRepository.php` no banco PostgreSQL.
6. A página de perfil permite atualizações de informações pessoais no controlador `UserController.php`, utilizando o serviço `UserService.php` que interage com o repositório `UserRepository.php`.

---

#### Diagrama de Classes

**Diagrama de Classes**  
```plaintext
+--------------------+
|      User          |
+--------------------+
| id                 |
| name               |
| email              |
| password           |
| height             |
| current_weight     |
| imc                |
+--------------------+
| initializeUser()   |
| getId()            |
| getImc()           |
| getCurrent_weight()|
| verifyPassword()   |
| setId()            |
+--------------------+

+--------------------+
|      Weight        |
+--------------------+
| id                 |
| weight_value       |
| weight_date        |
| user_id            |
+--------------------+
| initializeWeight() |
| setId()            |
| getWeight_value()  |
| getWeight_date()   |
+--------------------+
 
+--------------------+                    +---------------+
|  Authenticator     |  ...........(1)---|   User         |
+--------------------+                    +---------------+
| email              |                   | name           |
| password           |                   | email          |
| verifyEmail()      |                   | password       |
| verifyPassword()   |                   | height         |
+----------------------------------------+ current_weight |

+--------------------+                    
|  Container         |                    
+--------------------+                    
| instances[]        |                    
| getInstance()      |                    
| set()              |
| get()              |
+--------------------+
```

---

#### **Diagrama de Fluxo de Funções: Autenticação do Usuário**

```plaintext
Usuário -> View Login -> LoginController@index -> Autenticator.php -> User (Data Validation) -> LoginService@login -> Redirect('/home')
```

---

#### **Requisições e Tratamento**

**Configuração de Rotas no Arquivo `routes.php`:**  
Exemplo:  
- Rota GET `/home` chama método `index` no `HomeController` com middleware de autenticação `auth`.  

**Middleware Manager:**  
- Middleware verifica se conta está logada via sessão `$_SESSION`. Caso contrário, redireciona.

---

#### **Resumo Funcional**

O sistema implementa autenticação robusta, manipulação de dados, interface interativa com Bootstrap, e fácil adaptação de funcionalidades adicionais.