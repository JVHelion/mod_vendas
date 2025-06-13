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
a
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
- [ ] Campo de quantidade(vir pré-preenchido)
- [ ] Campo de valor unitário(vir pré-preenchido)
- [ ] Subtotal
- [ ] Adicionar
    - [ ] Após adicionado, permitir editar e excluir produtos  
        SEÇÃO PAGAMENTOS:
    - [ ] Quantidade de Parcelas
        - [ ] Valor da parcela  
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
        int id pk
        string name
        string email
        timestamp email_verified_at
        string password
        string remember_token
        timestamp created_at
        timestamp updated_at
        string mod_vendas_cpf
    }
    
    users ||--o{ mod_vendas_pedido : id
    
    mod_vendas_pedido {
        int id_pedido pk
        int id_users fk
        int id_pagamento fk
        datetime data_criacao
    }
    
    mod_vendas_pedido ||--|{ mod_vendas_item_pedido : id_pedido
    mod_vendas_pedido ||--|{ mod_vendas_pagamento : id_pagamento
    
    mod_vendas_item_pedido {
        int id_item_pedido pk
        int id_pedido fk
        int id_produto fk
    }
    
    mod_vendas_item_pedido ||--|| mod_vendas_produto : id_produto
    
    mod_vendas_produto {
        int id_produto pk
        string nome_produto
    }
    
    mod_vendas_pagamento {
        int id_pagamento pk
        int id_pedido fk
        int parcela_pagamento
        int valor_parcela
        datetime data_vencimento
    }







```