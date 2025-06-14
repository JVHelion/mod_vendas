/**
 * INICIO
 * Mascaras para formulários
 */
//Máscara para CPF
function cpf(v) {
    v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
    v = v.replace(/(\d{3})(\d)/, "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
    v = v.replace(/(\d{3})(\d)/, "$1.$2"); //Coloca um ponto entre o terceiro e o quarto dígitos
    //de novo (para o segundo bloco de números)
    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2"); //Coloca um hífen entre o terceiro e o quarto dígitos
    return v;
}

//Máscara para nome
function limparNome(v) {
    return v.replace(/[^a-zA-ZÀ-ÿ\s]/g, ""); // Remove tudo que não for letra ou espaço
}

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
    var modal = new bootstrap.Modal(document.getElementById("modalSucesso"));
    modal.show();
}
// Função para mostrar modal de falha
function mostrarFalha() {
    var modal = new bootstrap.Modal(document.getElementById("modalFalha"));
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
        nome_usuario_novo: document.getElementById("nome_de_usuario_novo")
            .value,
        cpf_usuario_novo: document.getElementById("cpf_de_usuario_novo").value,
    };

    fetch("/mod_vendas/criar_usuario", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify(dados),
    })
        .then((response) => response.json())
        .then((resposta) => {
            mostrarSucesso();
            atualizarSelectUsuarios();
            console.log("Funfou o post de criar usuario", resposta);
        })
        .catch((erro) => {
            mostrarFalha();
            console.error("Deu errado", erro);
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
        nome_Produto_novo: document.getElementById("nome_de_produto_novo")
            .value,
    };

    fetch("/mod_vendas/criar_produto", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify(dados),
    })
        .then((response) => response.json())
        .then((resposta) => {
            mostrarSucesso();
            atualizarSelectProdutos();
            console.log("Funfou o post de criar Produto", resposta);
        })
        .catch((erro) => {
            mostrarFalha();
            console.error("Deu errado", erro);
        });
}
/**
 * POST CRIAR PRODUTO
 * FINAL
 */

// Preencher produtos
function atualizarSelectProdutos() {
    fetch("/mod_vendas/listar_produtos")
        .then((response) => response.json())
        .then((produtos) => {
            const select = document.getElementById("select_produto");
            select.innerHTML = '<option value="">Selecione o Produto</option>';
            produtos.forEach((produto) => {
                const option = document.createElement("option");
                option.value = produto.id;
                option.textContent = produto.nome_produto;
                select.appendChild(option);
            });
        });
}

// Preencher clientes
function atualizarSelectUsuarios() {
    fetch("/mod_vendas/listar_usuarios")
        .then((response) => response.json())
        .then((usuarios) => {
            const select = document.getElementById("select_cliente");
            select.innerHTML = '<option value="">Selecione o Cliente</option>';
            usuarios.forEach((usuario) => {
                const option = document.createElement("option");
                option.value = usuario.id;
                option.textContent = usuario.name;
                select.appendChild(option);
            });
        });
}
/**
 * LISTAR USUARIO PRODUTOS
 * FINAL
 */

/**
 * INICIO
 * SISTEMA DE PEDIDOS
 */
let pedidos = [];
let tabelaPedidos;
let indexEditando = null;

// Adicionar Pedido
function adicionarPedido() {
    const selectProduto = document.getElementById("select_produto");
    const produtoId = selectProduto.value;
    const produtoNome = selectProduto.options[selectProduto.selectedIndex].text;
    const quantidade = document.getElementById("quantidade_produto").value;
    const valorUnitario = document
        .getElementById("valor_unitario_produto")
        .value.replace(".", "")
        .replace(",", ".");
    const valorUnitarioFormatado = document.getElementById(
        "valor_unitario_produto"
    ).value;
    const subtotal = (parseFloat(valorUnitario) * parseInt(quantidade)).toFixed(
        2
    );

    if (!produtoId || !quantidade || !valorUnitario) {
        mostrarFalha();
        return;
    }

    pedidos.push({
        produtoId,
        produtoNome,
        quantidade,
        valorUnitario: valorUnitarioFormatado,
        subtotal: subtotal.replace(".", ","),
    });

    atualizarTabelaPedidos();
}

function excluirPedido(index) {
    pedidos.splice(index, 1);
    atualizarTabelaPedidos();
}

function editarPedido(index) {
    indexEditando = index;
    const pedido = pedidos[index];

    // Preencher produtos no select do modal
    fetch("/mod_vendas/listar_produtos")
        .then((response) => response.json())
        .then((produtos) => {
            const select = document.getElementById("editar_produto");
            select.innerHTML = "";
            produtos.forEach((produto) => {
                const option = document.createElement("option");
                option.value = produto.id;
                option.textContent = produto.nome_produto;
                if (produto.id == pedido.produtoId) option.selected = true;
                select.appendChild(option);
            });

            // Preencher os outros campos
            document.getElementById("editar_quantidade").value =
                pedido.quantidade;
            document.getElementById("editar_valor_unitario").value =
                pedido.valorUnitario;

            // Abrir o modal
            var modal = new bootstrap.Modal(
                document.getElementById("editarPedidoModal")
            );
            modal.show();
        });
}

function enviarPedidos() {
    fetch("/mod_vendas/adicionar_pedido", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ pedidos }),
    })
        .then((response) => response.json())
        .then((resposta) => {
            mostrarSucesso();
            pedidos = [];
            atualizarTabelaPedidos();
        })
        .catch((erro) => {
            mostrarFalha();
            console.error("Erro ao enviar pedidos", erro);
        });
}

document
    .getElementById("salvarEdicaoPedido")
    .addEventListener("click", function () {
        if (indexEditando === null) return;

        const select = document.getElementById("editar_produto");
        const produtoId = select.value;
        const produtoNome = select.options[select.selectedIndex].text;
        const quantidade = document.getElementById("editar_quantidade").value;
        const valorUnitario = document.getElementById(
            "editar_valor_unitario"
        ).value;
        const valorUnitarioFloat = valorUnitario
            .replace(".", "")
            .replace(",", ".");
        const subtotal = (parseFloat(valorUnitarioFloat) * parseInt(quantidade))
            .toFixed(2)
            .replace(".", ",");

        pedidos[indexEditando] = {
            produtoId,
            produtoNome,
            quantidade,
            valorUnitario,
            subtotal,
        };

        atualizarTabelaPedidos();
        indexEditando = null;
        var modal = bootstrap.Modal.getInstance(
            document.getElementById("editarPedidoModal")
        );
        modal.hide();
    });
/**
 * SISTEMA DE PEDIDOS
 * FINAL
 * */

/**
 * INICIO
 * CALCULA TOTAL
 */
function atualizarTabelaPedidos() {
    tabelaPedidos.clear();
    let total = 0;
    pedidos.forEach((pedido, index) => {
        tabelaPedidos.row.add([
            pedido.produtoNome,
            pedido.quantidade,
            pedido.valorUnitario,
            pedido.subtotal,
            `<button class="btn btn-warning btn-sm" onclick="editarPedido(${index})">Editar</button>
             <button class="btn btn-danger btn-sm" onclick="excluirPedido(${index})">Excluir</button>`,
        ]);
        total += parseFloat(pedido.subtotal.replace(",", "."));
    });
    tabelaPedidos.draw();
    document.getElementById("total_da_linha").textContent =
        total.toLocaleString("pt-BR", {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        });
}
/**
 * CALCULA TOTAL
 * FINAL
 */

/**
 * INICIO
 * PESQUISA USUARIO
 */

$(document).ready(function () {
    $("#select_cliente").select2({
        theme: "bootstrap4",
        placeholder: "Selecione o Cliente",
        ajax: {
            url: "/mod_vendas/buscar_usuarios",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    term: params.term, // termo digitado
                };
            },
            processResults: function (data) {
                return data;
            },
            cache: true,
        },
        minimumInputLength: 1,
    });
});

/**
 * PESQUISA USUARIO
 * FINAL
 */

/**
 * INICIO
 * PESQUISA PRODUTO
 */

$(document).ready(function () {
    $("#select_produto").select2({
        theme: "bootstrap4",
        placeholder: "Selecione o Produto",
        ajax: {
            url: "/mod_vendas/buscar_produtos",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    term: params.term,
                };
            },
            processResults: function (data) {
                return data;
            },
            cache: true,
        },
        minimumInputLength: 1,
    });
});

/**
 * PESQUISA PRODUTO
 * FINAL
 */

/**
 * INICIO
 * PAGAMENTO
 */

function parcelamentos() {
    document.getElementById("parcelasContainer").innerHTML = "";
    document.getElementById("totalParcelas").textContent = "0,00";
    document.getElementById("totalVendaResumo").textContent =
    document.getElementById("total_da_linha").textContent;

    adicionarCampoParcela();

    var modal = new bootstrap.Modal(document.getElementById("modalPagamento"));
    modal.show();
}

// Adiciona um campo de parcela
function adicionarCampoParcela() {
    const totalVenda = parseFloat(document.getElementById("total_da_linha").textContent.replace('.', '').replace(',', '.'));
    const totalParcelas = parseFloat(document.getElementById("totalParcelas").textContent.replace('.', '').replace(',', '.'));
    const container = document.getElementById("parcelasContainer");
    const idx = container.children.length + 1;
    const div = document.createElement("div");

    if (totalParcelas >= totalVenda) {
        mostrarFalha();
        return;
    }

    div.className = "row mb-2 align-items-end";
    div.innerHTML = `
        <div class="col-5">
            <label>Qtd</label>
            <input type="number" min="1" value="1" class="form-control parcela-qtd" />
        </div>
        <div class="col-5">
            <label>Valor</label>
            <input type="text" class="form-control parcela-valor" placeholder="0,00" />
        </div>
        <div class="col-2">
            <button type="button" class="btn btn-danger btn-sm removerParcela">X</button>
        </div>
    `;
    container.appendChild(div);

    // Máscara Do valor
    new Cleave(div.querySelector(".parcela-valor"), {
        numeral: true,
        numeralThousandsGroupStyle: "thousand",
        delimiter: ".",
        numeralDecimalMark: ",",
        numeralDecimalScale: 2,
    });

    // Botão para tirar parcela
    div.querySelector(".removerParcela").onclick = function () {
        div.remove();
        atualizarTotalParcelas();
    };

    // Monitora digitação
    div.querySelector(".parcela-qtd").oninput = atualizarTotalParcelas;
    div.querySelector(".parcela-valor").oninput = atualizarTotalParcelas;
    atualizarTotalParcelas();
}

// Atualiza o total das parcelas
function atualizarTotalParcelas() {
    let total = 0;
    document.querySelectorAll("#parcelasContainer .row").forEach((row) => {
        const qtd = parseInt(row.querySelector(".parcela-qtd").value) || 0;
        const valor = row
            .querySelector(".parcela-valor")
            .value.replace(".", "")
            .replace(",", ".");
        total += qtd * (parseFloat(valor) || 0);
    });
    document.getElementById("totalParcelas").textContent = total.toLocaleString(
        "pt-BR",
        { minimumFractionDigits: 2, maximumFractionDigits: 2 }
    );
}

// Botão para adicionar nova parcela
document.getElementById("adicionarParcela").onclick = adicionarCampoParcela;

// Atualiza total ao editar parcelas
document.getElementById("parcelasContainer").oninput = atualizarTotalParcelas;

// Botão confirmar pagamento
document.getElementById("confirmarPagamento").onclick = function () {
    let parcelas = [];
    let totalParcelas = 0;
    document.querySelectorAll("#parcelasContainer .row").forEach((row) => {
        const qtd = parseInt(row.querySelector(".parcela-qtd").value) || 0;
        const valor = row.querySelector(".parcela-valor").value;
        const valorFloat = parseFloat(valor.replace('.', '').replace(',', '.')) || 0;
        if (qtd > 0 && valor) {
            parcelas.push({ qtd, valor });
            totalParcelas += qtd * valorFloat;
        }
    });

    const totalVenda = parseFloat(document.getElementById("total_da_linha").textContent.replace('.', '').replace(',', '.'));

    if (Math.abs(totalParcelas - totalVenda) > 0.01) {
        mostrarFalha();
        alert("O total das parcelas deve ser igual ao total da venda!");
        return;
    }

    // ...restante do código...
    var modal = bootstrap.Modal.getInstance(
        document.getElementById("modalPagamento")
    );
    modal.hide();
    mostrarSucesso();
};
/**
 * PAGAMENTO
 * FINAL
 */

/**
 * INICIO
 * TODOS OS CARREGAMENTOS DE DOM
 */
document.addEventListener("DOMContentLoaded", function () {
    // Inicializa DataTable
    tabelaPedidos = new DataTable("#tabela-pedidos", {
        searching: false,
        paging: false,
        info: false,
        ordering: false,
    });

    // Máscara Cleave.js
    new Cleave("#valor_unitario_produto", {
        numeral: true,
        numeralThousandsGroupStyle: "thousand",
        delimiter: ".",
        numeralDecimalMark: ",",
        numeralDecimalScale: 2,
        onValueChanged: function (e) {
            let partes = e.target.value.split(",");
            let inteiros = partes[0].replace(/\D/g, "");
            if (inteiros.length > 6) {
                inteiros = inteiros.slice(0, 6);
                partes[0] = parseInt(inteiros, 10).toLocaleString("pt-BR");
                e.target.value = partes.join(",");
            }
        },
    });

    new Cleave("#editar_valor_unitario", {
        numeral: true,
        numeralThousandsGroupStyle: "thousand",
        delimiter: ".",
        numeralDecimalMark: ",",
        numeralDecimalScale: 2,
    });

    // Preencher selects
    atualizarSelectUsuarios();
    atualizarSelectProdutos();

    // Máscaras para CPF e nome
    document
        .getElementById("cpf_de_usuario_novo")
        .addEventListener("input", function () {
            this.value = cpf(this.value);
        });
    document
        .getElementById("nome_de_usuario_novo")
        .addEventListener("input", function () {
            this.value = limparNome(this.value);
        });
});
/**
 * TODOS OS CARREGAMENTOS DE DOM
 * FINAL
 */
