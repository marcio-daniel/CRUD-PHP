**Especificação Funcional do Sistema**

---

### Descrição Geral:
O sistema é uma aplicação web para gerenciamento de usuários e controle de pesos corporais, com foco em calcular o IMC (Índice de Massa Corporal) e fornecer histórico do peso. Ele permite funções como login, registro de novos usuários, perfil para gerenciamento de informações de peso e altura, e também exibição de estatísticas relacionadas ao IMC.

---

### Casos de uso funcionais:

#### 1. **Sistema de login:**
   - **Descrição:** Permite que um usuário existente realize login no sistema utilizando email e senha.
   - **Requisitos:**
     - Verificação de email registrado no banco de dados.
     - Validação de senha utilizando hash por meio da classe `Hashing`.
     - Armazena sessão para usuário logado.

#### 2. **Registro de novos usuários:**
   - **Descrição:** Cadastra um novo usuário no sistema com nome, email, senha, altura e peso inicial.
   - **Requisitos:**
     - Hash de senha ao salvar o usuário.
     - Cálculo inicial do IMC ao criar o usuário.
     - Evita cadastro duplicado com emails já existentes.

#### 3. **Gerenciamento de perfil:**
   - **Descrição:** Permite que o usuário visualize ou atualize as informações do perfil.
   - **Requisitos:**
     - Atualização de nome, email, altura e senha.
     - Recalcular IMC após a alteração da altura.
     - Senhas precisam ser iguais ao atualizar.

#### 4. **Controle de peso:**
   - **Descrição:** Permite adicionar registros de peso com data associada ao usuário.
   - **Requisitos:** 
     - Registro salvo no banco de dados.
     - Listagem de histórico baseado em filtro (exemplo: por mês).
     - Ordenação cronológica (mais recentes primeiro).

#### 5. **Cálculo e Exibição de IMC:**
   - **Descrição:** Cada usuário tem o cálculo do IMC atualizado e sua classificação é exibida.
   - **Requisitos:** 
     - Fórmula: `peso / (altura * altura)`.
     - Classificações geradas automaticamente com base no IMC (abaixo do peso, normal, sobrepeso, obesidade leve, obesidade grave).

#### 6. **Filtro de histórico por mês:**
   - **Descrição:** Exibe registros de peso baseados no mês selecionado pelo usuário.
   - **Requisitos:** 
     - Consultar valores do banco de dados.
     - Conversão e filtragem entre datas formatadas.

#### 7. **Sistema de rotas:**
   - **Descrição:** Mapeamento de todas as páginas e funcionalidades com base nos métodos POST e GET.
   - **Requisitos:**
     - Verificação de permissões para rotas protegidas (`auth`).
     - Redirecionamento condicional para usuários não logados ou logados.

---

### Tecnologias e Arquitetura:
#### 1. **Banco de Dados PostgreSQL:**
   - Tabelas:
     - `users`: Informações do usuário, incluindo password, altura, peso e IMC.
     - `weights`: Histórico de pesos associados ao usuário com data.

#### 2. **Classes Importantes:**
   - **`Hashing`**
     - Métodos: `encrypt` e `decrypt` para hashing de senhas.
   - **`Authenticator`**
     - Verifica email e senha de usuários.
   - **`Engine`**
     - Renderização de views.
     - Atualização de perfil de usuário logado.
   - **`Container`**
     - Gerenciamento de dependências e instâncias (Inversão de Controle).
   - **`MiddlewareManager`**
     - Verificação de restrições e autenticação nas rotas.
   - **`Router`**
     - Definição de rotas protegidas e funcionamento geral da navegação.
   - **`UserServices`**
     - Serviço de criação e atualização de informações do usuário.
   - **`WeightService`**
     - Serviço para gerenciar registros de peso.

#### 3. **Views (Frontend):**
Views HTML com Bootstrap para páginas de:
   - Login 
   - Cadastro 
   - Tela principal com dados de peso e IMC
   - Tela de adição de peso
   - Tela de perfil.

#### 4. **Arquitetura MVC (Model-View-Controller):**
Seguindo o padrão de MVC, possui:
   - **Modelos:** `User`, `Weight`.
   - **Controllers:** `LoginController`, `HomeController`, `UserController`, `WeightController`.
   - **View:** HTML para exibir as páginas para os usuários.

#### 5. **Sessões:**
   - Gerenciamento de estado do usuário via `$_SESSION`.

---

### Diagramas:

#### 1. **Diagrama de Arquitetura Geral (MVC com IoC):**

```
Controller <-----> Service <-----> Repository <-----> Database
                      |
                      |
                   Models
                      |
                      |
                    Views
                      |
                      |
         Middleware & Authentication Management
```

#### 2. **Diagrama de Fluxo funcional (Exemplo: Login):**

1. Usuário envia `email` e `password` através do formulário.
2. `LoginController` invoca a validação do `Authenticator`.
3. Interface de serviço (`ILoginService`) chamada para gerenciar sessões.
4. `UserRepository` consulta email e senha.
5. Resultado:
   - Se válido: Redirecionamento para `/home`.
   - Caso contrário: Mensagem de erro exibida na view de Login.

```plaintext
Usuário (Formulário) -------> Controller -------> Authenticator -------> Repository <------ DB
                                 |
                                 |
                              Session
                                 |
                                 |
                              View Home/Login
```

#### 3. **Diagrama de Classes Simplificado:**

**Classes Principais:**
- `User` (Model)
- `Weight` (Model)
- `Authenticator` (Serviço)
- `Router` (Controle de Rotas)
- `Engine` (Renderização de Views)

```
Container (IoC) --> [Authenticator, Router, etc.]
Router ---> (Middleware) ---> Controllers ---> Services ---> Models ---> Database
```

Com essa especificação funcional e estrutura de diagramas, o funcionamento, dependências e interações do sistema ficaram detalhadas.