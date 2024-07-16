# Documentação Funcional

## Resumo

O sistema é uma plataforma de gerenciamento e controle de dados de usuários relacionados ao peso e Índice de Massa Corporal (IMC). Ele permite que os usuários se registrem, façam login, atualizem suas informações, registrem novos dados de peso e visualizem históricos de pesos e cálculos de IMC. O sistema é baseado em PHP e usa PostgreSQL como banco de dados.

## Funcionalidades Principais

1. **Autenticação de Usuários**
    - Registro de usuários com validação de dados.
    - Login com verificação de email e senha.
    - Logout para encerrar a sessão.

2. **Gestão de Perfis**
    - Visualização e atualização de perfis, incluindo alteração de senha e dados pessoais.
    - Cálculo de IMC baseado na altura e peso atual.

3. **Gestão de Pesos**
    - Adição de novos registros de peso.
    - Visualização de histórico de pesos filtrado por mês.

4. **Roteamento e Middleware**
    - Gerenciamento de rotas para diferentes ações e páginas dentro do sistema.
    - Uso de middlewares para verificação de acesso baseado na sessão do usuário.

5. **Integração com Banco de Dados**
    - Conexão e interação com um banco de dados PostgreSQL para CRUD de dados dos usuários e pesos.

# Documentação Técnica

## Estrutura do Projeto

```
src/
│
├── app/
│   ├── classes/
│   │   ├── Authenticator.php
│   │   ├── Container.php
│   │   ├── Engine.php
│   │   ├── Hashing.php
│   │   ├── MiddlewareManager.php
│   │   ├── Router.php
│   ├── controllers/
│   │   ├── HomeController.php
│   │   ├── LoginController.php
│   │   ├── UserController.php
│   │   ├── WeightController.php
│   ├── database/
│   │   ├── DbConnection.php
│   │   ├── IPostgreSQLDatabase.php
│   │   ├── IUserRepository.php
│   │   ├── IWeightRepository.php
│   │   ├── PostgreSQLDatabase.php
│   │   ├── UserRepository.php
│   │   ├── WeightRepository.php
│   ├── helpers/
│   │   ├── config.php
│   │   ├── helpers.php
│   ├── models/
│   │   ├── User.php
│   │   ├── Weight.php
│   ├── routes/
│   │   ├── routes.php
│   ├── services/
│   │   ├── ILoginService.php
│   │   ├── IUserService.php
│   │   ├── IWeightService.php
│   │   ├── LoginService.php
│   │   ├── UserServices.php
│   │   ├── WeightService.php
│   ├── views/
│   │   ├── filter.php
│   │   ├── home.php
│   │   ├── login.php
│   │   ├── profile.php
│   │   ├── registration.php
│   │   ├── weight.php
├── public/
│   ├── index.php
│   
└── vendor/
    ├── autoload.php
    ├── composer/
        ├── ClassLoader.php
```

## Descrição Técnica

### Arquivos de Classes

- **Authenticator.php**
    - Classe responsável por autenticacao do usuário (email e senha).
    
- **Container.php**
    - Classe singleton responsável por gerenciar instâncias/configurações de dependências e serviços.
    
- **Engine.php**
    - Classe que gerencia a renderização de views e atualização de informações de sessão do usuário logado.

- **Hashing.php**
    - Classe para criptografar as senhas dos usuários.

- **MiddlewareManager.php**
    - Classe responsável por gerenciar middlewares para verificação de sessões.

- **Router.php**
    - Classe que gerencia o roteamento das URLs e associações com controladores e métodos.

### Arquivos de Controllers

- **HomeController.php**
    - Controlador para a página inicial dos usuários autenticados e para a filtragem de histórico de pesos.
    
- **LoginController.php**
    - Controlador responsável pelas funções de login e logout.

- **UserController.php**
    - Controlador responsável pela gestão dos perfis dos usuários, criação e atualização de informações.

- **WeightController.php**
    - Controlador responsável pela gestão dos dados de peso dos usuários.

### Arquivos de Banco de Dados

- **DbConnection.php**
    - Classe abstrata para estabelecer conexão com o banco de dados.
    
- **IPostgreSQLDatabase.php**
    - Interface para operações básicas em banco de dados PostgreSQL.

- **IUserRepository.php**
    - Interface para operações de CRUD relacionadas aos usuários.

- **IWeightRepository.php**
    - Interface para operações de CRUD relacionadas aos registros de peso.

- **PostgreSQLDatabase.php**
    - Implementação concreta da conexão e operações no banco de dados PostgreSQL.

- **UserRepository.php**
    - Implementação concreta para operações específicas de usuários no banco de dados.

- **WeightRepository.php**
    - Implementação concreta para operações específicas de registros de peso no banco de dados.

### Arquivos de Configuração e Helpers

- **config.php**
    - Configura e instância serviços e injeções de dependência usando o container.

- **helpers.php**
    - Funções auxiliares para operações comuns como request, response, roteamento, etc.

### Arquivos de Modelos

- **User.php**
    - Modelo representando a entidade de usuário, com propriedades e métodos relevantes para um usuário.

- **Weight.php**
    - Modelo representando a entidade de registro de peso, com propriedades e métodos relevantes para um peso.

### Arquivos de Views

- **filter.php**
    - View para exibir o histórico de pesos filtrado por mês.

- **home.php**
    - View da página inicial do usuário logado, mostrando o peso atual e histórico.

- **login.php**
    - View para o formulário de login.

- **profile.php**
    - View para exibir e atualizar o perfil do usuário.

- **registration.php**
    - View para o formulário de registro de novos usuários.

- **weight.php**
    - View para o formulário de adição de novos registros de peso.

### Arquivo de Roteamento

- **routes.php**
    - Define as rotas GET e POST associadas às ações do sistema e controladores.

### Serviços

- **ILoginService.php**
    - Interface para serviços relacionados ao login.

- **IUserService.php**
    - Interface para serviços relacionados aos usuários.

- **IWeightService.php**
    - Interface para serviços relacionados aos registros de peso.

- **LoginService.php**
    - Implementação do serviço de login, validação e gestão de sessōes de usuários.

- **UserServices.php**
    - Implementação dos serviços de criação e atualização de usuários.

- **WeightService.php**
    - Implementação dos serviços para adicionar registros de peso ao sistema.

### Arquivo de Entrada

- **index.php**
    - Arquivo inicial que carrega o autoloader, inicia a sessão e executa o roteamento com base nas configurações definidas.

Concluído.