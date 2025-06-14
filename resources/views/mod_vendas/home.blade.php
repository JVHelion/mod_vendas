<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Módulo de Vendas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.6.2/dist/select2-bootstrap4.min.css" rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class='dobra-1 d-flex justify-content-center align-items-center' style='height: 100vh;'>
            <div>
                <div class="row">

                    <div class="col-12 text-center">
                        <h1>Bem vindo ao Módulo de Vendas!</h1><br>
                        <h2>Feito por: João Helion</h2>
                    </div>

                </div>
                <div class='text-center mt-5'>
                    <h3>Seção de Criação</h3>
                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#criarUsuarioModal">Criar Usuário</button>
                    <button type="button" class="btn btn-info btn-lg" data-bs-toggle="modal" data-bs-target="#criarProdutoModal">Criar Produto</button>
                </div>
                <div class="animado text-center mt-5 animate__animated animate__bounce animate__infinite">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-chevron-double-down" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1.646 6.646a.5.5 0 0 1 .708 0L8 12.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"></path>
                        <path fill-rule="evenodd" d="M1.646 2.646a.5.5 0 0 1 .708 0L8 8.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708"></path>
                    </svg>

                </div>
            </div>
        </div>

        <div class='text-left'>
            <h3>Seção de Vendas</h3>
            <h4 class='mt-3'>Selecione o Usuário</h4>
            <select id="select_cliente" class="form-select">
                <option value="">Selecione o Cliente</option>
            </select>
            <h4 class='mt-3'>Realizar Vendas</h4>
            <div class='col d-flex gap-4'>
                <div class=' flex-fill'>
                    <div class="col">Selecione o Produto</div>
                    <select id="select_produto" class="form-select">
                        <option value=""></option>
                    </select>
                </div>
                <div>
                    <div class="col">Selecione a Quantidade</div>
                    <input type="number" id="quantidade_produto" class="form-control" min="1" step="1" pattern="\d*" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '')">
                </div>
                <div>
                    <div class="col">Valor Unitário</div>
                    <input type="text" id="valor_unitario_produto" class="form-control" placeholder="0,00" oninput="this.value = this.value.replace(/[^0-9,]/g, '').replace(/(,.*?),/g, '$1');">
                </div>
                <button type="button" class="btn btn-success mt-4" onclick="adicionarPedido()">Adicionar</button>
            </div>
            <h4 class='mt-3'>Seção de Pedidos:</h4>
            <table id="tabela-pedidos" class="table table-striped">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor Unitário</th>
                        <th>Subtotal</th>
                        <th>Ações</th>
                    </tr>
                </thead>
            </table>
            <hr>
            <div class='col text-end'>
                <span>Total: R$:<span id='total_da_linha'>0,00</span></span>
            </div>
            <button type="button" class="btn btn-primary mt-4 col text-end" onclick="parcelamentos()">Pagamento</button>


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

            <!-- Modal Editar Pedido -->
            <div class="modal fade" id="editarPedidoModal" tabindex="-1" aria-labelledby="editarPedidoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarPedidoModalLabel">Editar Pedido</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formEditarPedido">
                                <div class="mb-3">
                                    <label for="editar_produto" class="form-label">Produto</label>
                                    <select id="editar_produto" class="form-select"></select>
                                </div>
                                <div class="mb-3">
                                    <label for="editar_quantidade" class="form-label">Quantidade</label>
                                    <input type="number" id="editar_quantidade" class="form-control" min="1" step="1">
                                </div>
                                <div class="mb-3">
                                    <label for="editar_valor_unitario" class="form-label">Valor Unitário</label>
                                    <input type="text" id="editar_valor_unitario" class="form-control" placeholder="0,00">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="salvarEdicaoPedido">Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal Pagamento -->
            <div class="modal fade" id="modalPagamento" tabindex="-1" aria-labelledby="modalPagamentoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalPagamentoLabel">Pagamento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <form id="formParcelas">
                                <div id="parcelasContainer">
                                    <!-- Campos de parcelas serão adicionados aqui -->
                                </div>
                                <button type="button" class="btn btn-secondary mt-2" id="adicionarParcela">Adicionar Parcela</button>
                            </form>
                            <div class="mt-3">
                                <strong>Total das parcelas: R$ <span id="totalParcelas">0,00</span></strong>
                            </div>
                            <div class="mt-1">
                                <small>Total da venda: R$ <span id="totalVendaResumo">0,00</span></small>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary" id="confirmarPagamento">Confirmar Pagamento</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1/dist/cleave.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="public/js/mod_vendas/home.js?cache=<?= time() ?>"></script>
</body>

</html>