# DOCUMENTAÇÃO
## Veja em produção: https://mod-vendas.soberanium.com
# OBJETIVO

Criar um sistema simples onde é possível criar registros de vendas de produtos.

# VIEWS

- Vendas
    - Clientes(Cadastro de Clientes)
    - Itens(Cadastro de produtos)
    - Compra
    - Pagamento
- Pedidos Realizados
- Login(Opcional)

## VENDAS

### Clientes

#### **Campos:**

- [x] Cadastro
    - [x] Nome Completo
    - [x] CPF

### Produto

#### Campos:

- [x] Cadastrar Produto
    - [x] Nome do produto
    - [x] Valor do produto

### Vendas

#### **Campos:**

SEÇÃO DE VENDA:

- [x] Puxar uma lista de clientes existentes
- [x] Puxar uma lista de produtos
- [x] Subtotal
- [x] Adicionar
    - [x] Após adicionado, permitir editar e excluir produtos  
        SEÇÃO PAGAMENTOS:
    - [x] Quantidade de Parcelas
        - [x] Valor da parcela  
            Obs. Deixar disponível a possibilidade de valores diferentes em parcelas: 2x $500 e 10x $100 totalizando 12 parcelas.

## Pedidos Realizados

- Lista de pedidos realizados.
    - ID
    - Nome do Cliente
    - Data do pedido
    - Botão de editar
    - Botão de excluir
- Filtro de pesquisa(OPCIONAL)
- Baixar em PDF(OPCIONAL)

## Login(OPCIONAL)

Login de vendedor.(Usuário e Senha)

# BANCO DE DADOS RELACIONAL

```mermaid
erDiagram

    users {
        int id PK
        string name
        string email
        timestamp email_verified_at
        string password
        string remember_token
        timestamp created_at
        timestamp updated_at
        string mod_vendas_cpf
    }

    mod_vendas_pedido {
        int id PK
        int id_users FK
        timestamp created_at
        timestamp updated_at
    }

    mod_vendas_item_pedido {
        int id PK
        int id_pedido FK
        int id_produto FK
        int quantidade
        int valor_unitario
        timestamp created_at
        timestamp updated_at
    }

    mod_vendas_produto {
        int id PK
        string nome_produto
        timestamp created_at
        timestamp updated_at
    }

    mod_vendas_pagamento {
        int id PK
        int id_pedido FK
        int parcela_pagamento
        int valor_parcela
        datetime data_vencimento
        timestamp created_at
        timestamp updated_at
    }

    users ||--o{ mod_vendas_pedido : "id_users"
    mod_vendas_pedido ||--o{ mod_vendas_item_pedido : "id_pedido"
    mod_vendas_pedido ||--o{ mod_vendas_pagamento : "id_pedido"
    mod_vendas_produto ||--o{ mod_vendas_item_pedido : "id_produto"

```
