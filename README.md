# Desafio backend

## Endpoints
Foram criado os seguintes endpoints:

### POST - api/users
Campos: `name`, `email`, `phone_number`, `password`, `document`. Esses campos são todos obrigatórios para o cadastro de um novo usuário.

### GET - api/users
Nesse endpoint é possível retornar todos os usuários cadastrados, assim como suas contas e transações realizadas pelas mesmas.

### GET - api/users/{id}
Nesse endpoint é possível retornar um usuário específico, assim como suas contas e transações realizadas pelas mesmas.

### POST - api/accounts
Campos: `agency`, `number`, `digit`, `name`, `social_reason`, `type`, `document`, `user_id`. 
Esses campos são todos obrigatórios (menos o social_reason, que só é obrigatório em contas Company) para o cadastro de um novo usuário.
Type: enum com as seguintes opções: Company e Person.

### GET - api/accounts
Nesse endpoint é possível retornar todas os contas cadastradas, assim como suas transações realizadas.

### GET - api/accounts/{id}
Nesse endpoint é possível retornar uma conta específica, assim como suas  transações.

### POST - api/transactions
Campos: `amount`, `type`, `account_id`, `password`.
Nesse endpoint é possível cadastrar uma transação em uma conta. É necessário informar o id da conta e a senha do usuário.
Tipos de transações: Pagamento de Conta, Depósito, Transferência, Recarga de Celular, Compra (Crédito)

Os endpoints foram criados atrelados a um Request com algumas Rules personalizadas afim de evitar problema na inserção e apresentar mensagens de erro na validação dos campos.

## Regras

### Usuário
Para cadastrar um usuário o campo `document` e o campo `email` devem ser únicos.
Cada usuário pode ter até uma conta de cada tipo.

### Conta
Para cadastar uma conta, o campo `document` deve ser único (até mesmo para contas de tipos diferentes).

### Transações
Para criar uma transação, é necessário informar a senha do usuário da conta.
