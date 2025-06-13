<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <div >SELECT2-Selecione o Cliente</div>
            <h4 class='mt-3'>Selecione os Produtos</h4>
            <div class="row">
                <div class="col">SELECT2-Selecione o Produto</div>
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
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
                    ...
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>