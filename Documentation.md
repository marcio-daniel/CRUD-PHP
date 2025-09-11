## Documentação do Software

---

### **Índice**
1. **Introdução**
2. **Visão Geral do Sistema**
3. **Arquitetura do Sistema**
4. **Descrição do Código**
5. **Rotas e Fluxo de Uso**
6. **Diagrama de Arquitetura**
7. **Conclusão**

---

### **1. Introdução**

O sistema descrito visa gerenciar registros de usuários e seus dados biométricos, mais especificamente peso e altura, para calcular e exibir o Índice de Massa Corporal (IMC). Ele conta com funcionalidades como autenticação de usuários, registro de novos usuários, registro de pesos, filtragem de dados e visualização de perfil.

O software foi desenvolvido em **PHP** com suporte a banco de dados PostgreSQL e segue um padrão arquitetural baseado em Injeção de Dependência e Componentização. Ele apresenta uma estrutura modular clara e utiliza ferramentas como o Composer para gerenciar dependências.

---

### **2. Visão Geral do Sistema**

O sistema oferece as seguintes funcionalidades principais:

- Registro e autenticação de usuários.
- Gerenciamento de perfis de usuários (alteração de informações como nome, email, senha e altura).
- Registro e histórico de pesos dos usuários.
- Cálculo do IMC e classificação em categorias específicas.
- Implementação de controle de acesso por middleware para proteger rotas.

---

### **3. Arquitetura do Sistema**

O sistema está dividido em várias categorias principais:

1. **Controllers (Controladores)**: Responsáveis por gerenciar a interação entre os usuários e a lógica de negócios.
   - Exemplos: `HomeController`, `LoginController`, `UserController`, `WeightController`.

2. **Services (Serviços)**: Camada intermediária responsável por gerenciar a lógica de negócios e interações com o repositório.
   - Exemplos: `UserServices`, `LoginService`, `WeightService`.

3. **Repositories (Repositórios)**: Gerenciam o acesso e manipulação dos dados armazenados no banco de dados.
   - Exemplos: `UserRepository`, `WeightRepository`.

4. **Helpers**: Contêm funções auxiliares compartilhadas globalmente.
   - Exemplos: `helpers.php`.

5. **Models**: Representam a estrutura e os comportamentos das entidades no sistema.
   - Exemplos: `User`, `Weight`.

6. **Views**: Interfaces com o usuário renderizadas em HTML e JavaScript.

7. **Configuração (Container e Rotas)**:
   - O padrão de Inversão de Controle (IoC) é utilizado, permitindo a injeção de dependências por meio de um container chamado `Container`.

---

### **4. Descrição do Código**

A seguir está uma descrição técnica e detalhada de cada componente do sistema:

#### a. **Usuários**
- **Modelo:** `User`
  - Contém informações como `id`, `nome`, `email`, `senha`, `altura`, `peso_atual`, `imc`.
  - Realiza cálculos de IMC com base no peso e altura.

- **Repositório:** `UserRepository`
  - Gerencia ações diretas no banco de dados, como salvar e editar usuários, além de recuperar informações com base em **ID** ou **email**.

- **Serviço:** `UserServices`
  - Serviços de criação e atualização de perfis, validando dados e gerenciando possíveis erros.

#### b. **Pesos**
- **Modelo:** `Weight`
  - Modela as entradas do usuário relacionadas ao peso.
  
- **Repositório:** `WeightRepository`
  - Manipula os dados de peso armazenados, filtrando por histórico e mês.

- **Serviço:** `WeightService`
  - Gerencia a lógica de negócios para armazenamento das informações de peso.

#### c. **Autenticação**
- Gerenciamento de autenticação implementado pela classe `Authenticator`, verificando e validando email e senhas criptografadas pelo sistema.

- **Serviços de Login:**
  1. **LoginService**: Lida com a autenticação e manipulação da sessão.
  2. **MiddlewareManager**: Protege rotas sensíveis do sistema contra acesso não autenticado.

---

### **5. Rotas e Fluxo de Uso**

As rotas do sistema estão configuradas no arquivo `routes.php` e são divididas em:

#### **Rotas GET:**
- `/` -> Tela de login.
- `/registration` -> Tela de registro do usuário.
- `/home` -> Página inicial (Protegida - Middleware Auth).
- `/logout` -> Realiza logout e redireciona.
- `/weight/create` -> Página para adicionar pesos (Protegida).
- `/user/profile` -> Perfil do usuário (Protegida).
- `/user/filter` -> Filtra histórico de pesos por mês (Protegida).

#### **Rotas POST:**
- `/login` -> Realiza autenticação do usuário.
- `/user/create` -> Cria um novo perfil de usuário.
- `/user/update` -> Atualiza os dados do usuário (Perfil).
- `/weight/store` -> Armazena um novo peso do usuário.

---

### **6. Diagrama de Arquitetura**

#### **Diagrama do Sistema**

```plaintext
┌──────────────┐       ┌───────────────┐       ┌───────────────┐       ┌──────────────┐
│              │       │               │       │               │       │              │
│  Controllers │──────▶│   Services    │──────▶│  Repositories │──────▶│    Models    │
│              │       │               │       │               │       │              │
└──────────────┘       └───────────────┘       └───────────────┘       └──────────────┘
       ▲                                                            ┌─────┐
       │                          ┌────────────────────────────────▶│ DB  │
       │                          │                                 └─────┘
       │                ┌───────────────────────┐
       │                │      Middleware       │
       │                └───────────────────────┘
       │                          ▲
       │                          │
       │                    ┌────────────┐
       │                    │   Views    │
       │                    └────────────┘
       │                          ▲
       │                          │
       │                    ┌───────────┐
       │                    │  Routers  │
       │                    └───────────┘
```

#### **Fluxo de Registro e Login**

1. Usuário acessa a página de login/cadastro.
2. Sistema autentica credenciais (se fornecidas) usando `Authenticator` e `LoginService`.
3. Dados de sessão são criados para gerenciar o acesso do usuário.

---

### **7. Conclusão**

O sistema é uma solução web que integra uma arquitetura de software bem estruturada com foco em modularidade e boas práticas de desenvolvimento (como Inversão de Controle). Trata-se de um projeto ideal para gerenciar dados biométricos básicos e apresentar um cálculo de IMC de forma interativa e segura.

### Pontos Positivos:
1. **Modularização:** Código dividido em camadas distintas e reutilizáveis.
2. **Segurança:** Middleware protege rotas sensíveis.
3. **Flexibilidade:** Fácil extensão da lógica de negócio e reuso de componentes.

### Pontos de Melhoria:
- Melhorar a validação de dados de entrada para maior robustez.
- Implementar testes automatizados para a manutenção contínua.
