### Especificação Funcional do Sistema

O sistema descrito é uma aplicação web desenvolvida para gerenciar usuários, suas informações de saúde, como altura, peso e IMC, e permitir a manipulação de históricos de peso. A seguir estão as funcionalidades descritas detalhadamente:

---

#### Funcionalidades Gerais:
1. **Registro de Novos Usuários**:
    - Formulário na view `registration.php` para registrar um novo usuário.
    - Validações de senha, altura e peso.
    - Integração com o banco de dados para salvar os dados do usuário.
    - Mensagem de erro em caso de e-mail duplicado.

2. **Login**:
    - Formulário de autenticação na view `login.php`.
    - Verificação do e-mail e senha usando a classe `Authenticator`.
    - Uso de serviços para login.
    - Redirecionamento para a página inicial (`/home`) em caso de autenticação bem-sucedida.

3. **Logout**:
    - Permite que o usuário saia da aplicação.
    - Limpa a sessão ativa.

4. **Página Inicial (Home)**:
    - Exibe informações do usuário, como peso atual, IMC e sua classificação.
    - Possui filtro por mês para o histórico de pesos.
    - Requisição de lista filtrada com `AJAX` da rota `/user/filter`.

5. **Gestão de Peso**:
    - Permite ao usuário adicionar novos registros de peso.
    - Página de cadastro na view `weight.php`.

6. **Perfil**:
    - Permite editar dados do perfil do usuário (nome, e-mail, altura e senha).
    - Mensagens de sucesso ou erro em caso de problemas.

---

#### Funcionalidades Técnicas:
1. **Injeção de Dependência (Container)**:
    - A classe `Container` é usada para gerenciar dependências do sistema.
    - Permite instanciar classes automaticamente com dependências usando reflexão (`Reflection`).

2. **Autenticação**:
    - A classe `Authenticator` verifica e-mails e senhas no repositório de usuários.
    - Trabalha com sessões para controle de autenticação.

3. **Modelos**:
    - `User.php`: Representa o usuário e calcula seu IMC.
    - `Weight.php`: Representa o histórico de peso do usuário.

4. **Repositórios**:
    - Manipulação de dados (`insert`, `select`, `update`) através de repositórios específicos:
      - `UserRepository`
      - `WeightRepository`

5. **Serviços**:
    - Gerenciamento de ações da aplicação relacionados a:
      - Usuário (`UserService`)
      - Login (`LoginService`)
      - Peso (`WeightService`).

6. **Middleware**:
    - Verificação de autenticação e estado de login antes de executar rotas específicas (`MiddlewareManager`).

7. **Roteamento**:
    - Mapeamento de rotas definido em `routes.php`.
    - Suporte a `GET` e `POST` para diferentes funcionalidades.

8. **Criptografia**:
    - Implementação de hashing de senha com BCrypt (`Hashing`).

9. **Visualizações (Views)**:
    - Utilização de arquivos `PHP` para renderizar páginas web dinâmicas com dados do usuário.

10. **Database**:
    - Uso do PDO com PostgreSQL.
    - Classes e interfaces como `DbConnection`, `IPostgreSQLDatabase`, e `PostgreSQLDatabase` permitem interações com o banco.

---

### Diagramas

#### 1. Diagrama de Classes (UML):
Mostra as principais classes do sistema e suas relações:

```
    [Router] --> [MiddlewareManager]
    [Router] --> [Container]
    [Router] --> [Controllers]
    [Controllers] --> [Services]
    [Services] --> [Repository]
    [UserRepository] --> [PostgreSQLDatabase]
    [WeightRepository] --> [PostgreSQLDatabase]
    [Authenticator] --> [Container]
    [Container] --> [Service]
    [Service] --> [Repository]
```

---

#### 2. Diagrama de Contexto (Arquitetura Simplificada):
Representa as principais interações presentes no sistema:

```
Usuario -> [Interface Web] <--> [Servidor PHP]
Servidor PHP:
  |- [Roteador]
  |- [Controladores (Controllers)]
  |- [Serviços (Services)]
  |- [Repositorios]
  |- [Banco de Dados PostgreSQL]
Banco de Dados -> [Tabela Usuários e Pesos]
```

---

#### 3. Diagrama de Fluxo de Login:
Representa o processo de autenticação.

```
[Usuário] -> [LoginController@index()] -> Exibir view Login
[LoginController@login()] -> Verificar (email e senha)
    - Email existe? -> NÃO -> Exibir erro de e-mail.
                         -> SIM -> Verifica senha.
    - Senha válida? -> NÃO -> Exibir erro de senha.
                       -> SIM -> Chama UserService e inicializa sessão.
[Redirect para /Home]
```

---

#### 4. Estrutura do Container (Injeção de Dependência):
Representa a estrutura do container.

```
[Container] ---> [Instances Array]
  -->
  |- IUserRepository -> UserRepository
  |- IWeightRepository -> WeightRepository
  |- ILoginService -> LoginService
  |- IUserService -> UserServices
  |- IWeightService -> WeightService
```

---

Esse design fornece estrutura e escalabilidade com serviços, repositórios, e injeção de dependência. 