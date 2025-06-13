<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Módulo de Vendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">

            </div>
            <div class="col-6 text-center">
                <h1>Bem vindo ao Módulo de Vendas!</h1><br>
                <h2>Feito por: João Helion</h2>
            </div>
            <div class="col">

            </div>
        </div>
        <div class='text-center mt-5'>
            <h3>Seção de Criação</h3>
            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#criarUsuarioModal">Criar Usuário</button>
            <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#criarProdutoModal">Criar Produto</button>
        </div>
        <div class='text-left mt-5'>
            <h3>Seção de Vendas</h3>
            <h4 class='mt-3'>Selecione o Usuário</h4>
            <select id="select_cliente" class="form-select">
                <option value="">Selecione o Cliente</option>
            </select>
            <h4 class='mt-3'>Selecione os Produtos</h4>
            <div class="row">
                <select id="select_produto" class="form-select">
                    <option value="">Selecione o Produto</option>
                </select>
                <div class="col">Selecione a Quantidade</div>
                <div class="col">Adicionar</div>
                <hr>
                <div>
                    <p>Subtotal: R$:<span id='subtotal_da_linha'>123</span></p>
                </div>
            </div>
            <h4>Seção de Pedidos:</h4>
            <p>ID, CODIGO DO PRODUTO, NOME, QUANTIDADE, VALOR, SUBTOTAL, EXCLUIR, EDITAR</p>

            <!-- Modal Criar Produto -->
            <div class="modal fade" id="criarProdutoModal" tabindex="-1" aria-labelledby="criarProdutoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="criarProdutoModalLabel">Criação de Produto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Nome Produto</span>
                                <input id='nome_de_produto_novo' type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick='criarProduto()'>Adicionar Produto</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Sucesso -->
            <div class="modal fade" id="modalSucesso" tabindex="-1" aria-labelledby="modalSucessoLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-success text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalSucessoLabel">Sucesso</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Criado com sucesso!
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Falha -->
            <div class="modal fade" id="modalFalha" tabindex="-1" aria-labelledby="modalFalhaLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content bg-danger text-white">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalFalhaLabel">Falha</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Ocorreu uma falha ao criar.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Criar Usuário -->
            <div class="modal fade" id="criarUsuarioModal" tabindex="-1" aria-labelledby="criarUsuarioModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="criarUsuarioModalLabel">Criação de Usuário</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Nome</span>
                                <input id='nome_de_usuario_novo' type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                            <div class="input-group input-group-sm mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-sm">CPF</span>
                                <input id='cpf_de_usuario_novo' maxlength="14" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="criarUsuario()">Criar Usuario</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        /**
         * INICIO
         * Mascaras para formulários
         */
        //Máscara para CPF
        function cpf(v) {
            v = v.replace(/\D/g, "") //Remove tudo o que não é dígito
            v = v.replace(/(\d{3})(\d)/, "$1.$2") //Coloca um ponto entre o terceiro e o quarto dígitos
            v = v.replace(/(\d{3})(\d)/, "$1.$2") //Coloca um ponto entre o terceiro e o quarto dígitos
            //de novo (para o segundo bloco de números)
            v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
            return v
        }

        document.getElementById('cpf_de_usuario_novo').addEventListener('input', function() {
            this.value = cpf(this.value);
        });

        //Máscara para nome
        function limparNome(v) {
            return v.replace(/[^a-zA-ZÀ-ÿ\s]/g, ''); // Remove tudo que não for letra ou espaço
        }

        document.getElementById('nome_de_usuario_novo').addEventListener('input', function() {
            this.value = limparNome(this.value);
        });
        /**
         * Mascaras para formulários
         * FINAL
         */

        /**
         * INICIO
         * POP-UPS
         */
        // Função para mostrar modal de sucesso
        function mostrarSucesso() {
            var modal = new bootstrap.Modal(document.getElementById('modalSucesso'));
            modal.show();
        }
        // Função para mostrar modal de falha
        function mostrarFalha() {
            var modal = new bootstrap.Modal(document.getElementById('modalFalha'));
            modal.show();
        }
        /**
         * POP-UPS
         * FINAL
         */

        /**
         * INICIO
         * POST CRIAR USUARIO
         */
        function criarUsuario() {
            const dados = {
                nome_usuario_novo: document.getElementById('nome_de_usuario_novo').value,
                cpf_usuario_novo: document.getElementById('cpf_de_usuario_novo').value
            };

            fetch('/mod_vendas/criar_usuario', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(dados)
                })
                .then(response => response.json())
                .then(resposta => {
                    mostrarSucesso();
                    console.log('Funfou o post de criar usuario', resposta);
                })
                .catch(erro => {
                    mostrarFalha();
                    console.error('Deu errado', erro);
                });
        }
        /**
         * POST CRIAR USUARIO
         * FINAL
         */

        /**
         * INICIO
         * POST CRIAR PRODUTO
         */
        function criarProduto() {
            const dados = {
                nome_Produto_novo: document.getElementById('nome_de_produto_novo').value
            };

            fetch('/mod_vendas/criar_produto', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(dados)
                })
                .then(response => response.json())
                .then(resposta => {
                    mostrarSucesso();
                    console.log('Funfou o post de criar Produto', resposta);
                })
                .catch(erro => {
                    mostrarFalha();
                    console.error('Deu errado', erro);
                });
        }
        /**
         * POST CRIAR PRODUTO
         * FINAL
         */

        /**
         * INICIO
         * LISTAR USUARIOS PRODUTOS
         */
        document.addEventListener('DOMContentLoaded', function() {
            // Preencher clientes
            fetch('/mod_vendas/listar_usuarios')
                .then(response => response.json())
                .then(usuarios => {
                    const select = document.getElementById('select_cliente');
                    usuarios.forEach(usuario => {
                        const option = document.createElement('option');
                        option.value = usuario.id;
                        option.textContent = usuario.name;
                        select.appendChild(option);
                    });
                });

            // Preencher produtos
            fetch('/mod_vendas/listar_produtos')
                .then(response => response.json())
                .then(produtos => {
                    const select = document.getElementById('select_produto');
                    produtos.forEach(produto => {
                        const option = document.createElement('option');
                        option.value = produto.id;
                        option.textContent = produto.nome_produto;
                        select.appendChild(option);
                    });
                });
        });
        /**
         * LISTAR USUARIO PRODUTOS
         * FINAL
         */
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>