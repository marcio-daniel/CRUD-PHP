### Especificação Funcional em Português

Este sistema é uma aplicação web para controle de peso dos usuários. Ele permite que os usuários façam login, cadastrem-se, atualizem seu perfil, adicionem registros de peso, visualizem histórico de peso, filtrem os dados por mês, e verifiquem informações do perfil, como peso atual e índice de massa corporal (IMC). 

---

#### Recursos Principais:

1. **Autenticação de Usuário:**
   - Login com validação de email e senha.
   - Logout para destruir sessão ativa.

2. **Cadastro e Gerenciamento de Usuário:**
   - Cadastro de novos usuários com validação de campos de senha e altura/peso.
   - Atualização do perfil do usuário, incluindo alteração de senha e altura.

3. **Gerenciamento de Peso:**
   - Adicionar novos registros de peso com data associada.
   - Listagem e histórico de pesos ordenado por data.
   - Filtro de histórico de peso por meses.

4. **Relatório e Classificação de IMC:**
   - Exibição do peso atual do usuário e cálculo do IMC (Índice de Massa Corporal).
   - Classificação do status do IMC com base nos valores padrão.

5. **Controle de Acesso:**
   - Middleware para verificação de estado de autenticação.
   - Redirecionamento de usuários não autenticados para login ou home conforme o status.

---

### Detalhamento de Funcionalidades

#### 1. Registro de Usuário:
- Tela acessada pela rota `/registration`.
- O usuário insere informações como nome, e-mail, senha, altura e peso atual.
- Senhas digitadas têm validação para serem iguais.
- Caso o e-mail já exista no banco, exibe mensagem de erro.
- Exibe mensagens de sucesso ou erro após tentativa de cadastro.

#### 2. Login:
- Tela acessada pela rota `/`.
- Permite que o usuário insira e-mail e senha para se logar ao sistema.
- Caso as credenciais sejam inválidas, exibe mensagem de erro e retorna à tela de login.

#### 3. Gerenciamento de Perfil:
- Tela acessada pela rota `/user/profile`.
- Exibe e permite editar informações do perfil do usuário (nome, email e altura).
- Alteração de senha é ativada por botão.
- Ao salvar, atualiza os dados no banco e exibe mensagens de sucesso ou erro.

#### 4. Histórico de Pesos e Adição de Novo Peso:
- **Histórico de pesos**:
  - Visualização do histórico dos pesos registrados, acessível pela rota `/home`.
  - Possui filtro para exibir pesos registrados em determinado mês ou todos os pesos disponíveis.
- **Adição de peso**:
  - Tela acessada pela rota `/weight/create`.
  - Permite que o usuário insira o peso e a data associada em que foi medido.

#### 5. Gerenciamento do Middleware:
- Middleware para diferentes tipos de verificação de acesso:
  - `auth`: Garante que usuários não logados sejam redirecionados para a rota `/`.
  - `logged`: Garante que usuários logados sejam redirecionados para `/home`.

#### 6. Banco de Dados:
- Implementação feita com PostgreSQL.
- Tabelas utilizadas:
  - **`users`**: dados do usuário.
  - **`weights`**: registros de peso relacionados ao usuário.

#### 7. Rotas da Aplicação:
As rotas são definidas em `src/app/routes/routes.php`. Seguem listadas abaixo:
- **Rotas GET**:
  - `/`: LoginController@index:logged
  - `/registration`: UserController@registration
  - `/home`: HomeController@index:auth
  - `/logout`: LoginController@logout:auth
  - `/weight/create`: WeightController@create:auth
  - `/user/profile`: UserController@profile:auth
  - `/user/filter`: HomeController@filter:auth

- **Rotas POST**:
  - `/user/create`: UserController@create
  - `/user/update`: UserController@update:auth
  - `/login`: LoginController@login
  - `/weight/store`: WeightController@store:auth

---

### Diagrama de Fluxo de Controle - Login

```plaintext
+----------------------------+
| Início                    |
+----------------------------+
| Usuário acessa `/`        |
+----------------------------+
              |
              v
+-----------------------------+
| Preenche email e senha      |
+-----------------------------+
              |
              v
+-----------------------------+
| Envia POST para `/login`   |
+-----------------------------+
              |
              v
+-----------------------------+
| Autenticação via            |
| Authenticator -             |
| email e senha               |
+-----------------------------+
              |
      +-------+-----------------------+
      |Login com sucesso              |
      |Usuário logado -> Vai para `/home` |
      +-------------------+--------------------+
                                      |
                                      v
                          +------------------------+
                          |Login falhou:           |
                          |Retorna mensagem de erro|
                          |Redireciona para `/`    |
                          +------------------------+
```

---

### Diagrama de Fluxo Geral de Cadastro de Peso

```plaintext
+-----------------------------+
| Usuário acessa a rota       |
| `/weight/create`            |
+-----------------------------+
              |
              v
+-----------------------------+
| Preenche campos (Peso/Data)|
+-----------------------------+
              |
              v
+-----------------------------+
| Envia informações via POST |
| para rota `/weight/store`   |
+-----------------------------+
              |
      +-------+---------------------+
      | Registra Peso no BD         |
      | via WeightController/store  |
      | implementado por Service/   |
      | WeightRepository -> BD      |
      +-------------------+---------+
                              |
                              v
                  +-------------------+
                  | Redireciona       |
                  | para `/weight/create`|
                  +-------------------+
```

Essa especificação e os diagramas fornecem uma visão clara de como esse sistema funciona e detalham suas principais características e fluxos. Caso necessite algum ajuste ou seja necessário criar diagramas adicionais, sinta-se à vontade para solicitar.