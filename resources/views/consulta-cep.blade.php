<!DOCTYPE html>
<html>
<head>
    <title>Simulação de Frete</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
    <style>
        .form-group {
            margin-bottom: 10px;
        }

        .cards-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .card {
            width: calc(25% - 20px);
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .card.selected {
            border-color: blue;
        }

        .card img {
            max-width: 20%;
            height: auto;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ route('bandeiras') }}" class="btn btn-outline-success">Calculadora de Bandeira</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}" class="btn btn-outline-success">Cálculo de Frete</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        <h1>Calcular Frete</h1>
        <div class="row">
            <div class="col-md-6">
                <form id="produto-form" method="POST" action="">
                    @csrf
                    <div class="form-group">
                        <label for="produto">Produto:</label>
                        <select class="form-control" id="produto" name="produto">
                            <option value="">Selecione um produto</option>
                            <?php
                                // Conexão com o banco de dados
                                $servername = "localhost";
                                $username = "root";
                                $password = "1234";
                                $dbname = "db_artearena";

                                // Criar conexão
                                $conn = new mysqli($servername, $username, $password, $dbname);

                                // Verificar conexão
                                if ($conn->connect_error) {
                                    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
                                }

                                // Consulta para recuperar os produtos do banco de dados
                                $sql = "SELECT ID, nome FROM tabela_produtos";
                                $result = $conn->query($sql);

                                // Exibir os produtos no select2
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<option value="' . $row["ID"] . '">' . $row["nome"] . '</option>';
                                    }
                                }

                                // Fechar conexão
                                $conn->close();
                            ?>
                        </select>
                    </div>
                </form>
                <div class="form-group mt-4">
                    <label for="valor">Valor:</label>
                    <input type="text" class="form-control" id="valor" name="valor">
                </div>
                <div class="form-group">
                    <label for="peso">Peso:</label>
                    <input type="text" class="form-control" id="peso" name="peso" readonly>
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" min="1" value="1">
                </div>
            </div>
            <div class="col-md-6">
                <form id="cep-form" method="POST" action="">
                    @csrf
                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="text" class="form-control" id="cep" name="cep" placeholder="CEP">
                    </div>
                    <div class="form-group">
                        <label for="logradouro">Logradouro:</label>
                        <input type="text" class="form-control" id="logradouro" name="logradouro" readonly>
                    </div>
                    <div class="form-group">
                        <label for="bairro">Bairro:</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" readonly>
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade:</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" readonly>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <input type="text" class="form-control" id="estado" name="estado" readonly>
                    </div>
                </form>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3>Transportadoras:</h3>
                <div class="cards-container" id="cardsContainer"></div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <h4>Detalhes do Frete:</h4>
                <textarea class="form-control" id="campoTexto" rows="5"></textarea>
                <button type="button" class="btn btn-primary mt-2" id="botaoCopiar">Copiar</button>
                <p class="text-success mt-2" id="avisoCopiado" style="display: none;">Copiado com sucesso!</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script>
        $(function() {
            // Inicializar o select2 para o campo de produto
            $('#produto').select2();

            function consultarProduto() {
                var produto = $('#produto').val();

                // Lógica para consultar dados do produto
                if (produto === 'produto1') {
                    $('#valor').val('10.00');
                    $('#peso').val('1.5');
                } else if (produto === 'produto2') {
                    $('#valor').val('15.00');
                    $('#peso').val('2.0');
                } else if (produto === 'produto3') {
                    $('#valor').val('20.00');
                    $('#peso').val('0.5');
                } else {
                    // Realizar requisição AJAX para obter dados do produto do Tiny API
                    $.get('https://api.tiny.com.br/api2/produto.obter.php', {
                        token: 'bc3cdea243d8687963fa642580057531456d34fa',
                        id: produto,
                        formato: 'json'
                    }, function(response) {
                        var produtoData = JSON.parse(response);
                        $('#valor').val(produtoData.retorno.produto.preco);
                        $('#peso').val(produtoData.retorno.produto.peso_bruto);
                    });
                }
            }

            $('#produto').change(function() {
                consultarProduto();
            });

            function consultarCep() {
                var cep = $('#cep').val();

                $.get('https://viacep.com.br/ws/' + cep + '/json/', function(response) {
                    $('#logradouro').val('');
                    $('#bairro').val('');
                    $('#cidade').val('');
                    $('#estado').val('');

                    if (!response.erro) {
                        $('#logradouro').val(response.logradouro);
                        $('#bairro').val(response.bairro);
                        $('#cidade').val(response.localidade);
                        $('#estado').val(response.uf);
                    }
                });
            }

            $('#cep').on('input', function() {
                $(this).val($(this).val().replace(/\D/g, ''));
            });

            $('#cep').on('keydown', function(event) {
                if (event.keyCode === 13 || event.keyCode === 9) {
                    event.preventDefault();
                    consultarCep();
                }
            });

            $('#cep').on('blur', function() {
                consultarCep();
            });

            $('#cep').on('blur', function(event) {
                event.preventDefault();

                const url = "https://0239-2804-1b3-a243-1d72-9ca5-3867-e169-bef4.ngrok-free.app/consultar-kangu";

                const cepDestino = $('#cep').val();
                const peso = parseFloat($('#peso').val());
                const valor = parseFloat($('#valor').val());
                const quantidade = parseInt($('#quantidade').val());
                const peso_total = peso * quantidade;
                const valor_total = valor * quantidade;
                const produto = [
                    {
                        peso: peso,
                        valor: valor,
                        quantidade: quantidade
                    }
                ];
                const bodyData = {
                    cepDestino: cepDestino,
                    vlrMerc: valor_total,
                    pesoMerc: peso_total,
                    produtos: produto
                };

                fetch(url, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(bodyData)
                })
                    .then(response => response.json())
                    .then(data => {
                        const cardsContainer = document.getElementById("cardsContainer");

                        while (cardsContainer.firstChild) {
                            cardsContainer.removeChild(cardsContainer.firstChild);
                        }

                        if (data.alertas && data.alertas.length > 0) {
                            data.alertas.forEach(alerta => {
                                const alertElement = document.createElement("p");
                                alertElement.textContent = alerta;
                                cardsContainer.appendChild(alertElement);
                            });
                        }

                        data.forEach(transportadora => {
                            const cardElement = document.createElement("div");
                            cardElement.classList.add("card");

                            const nomeElement = document.createElement("h3");
                            nomeElement.textContent = transportadora.transp_nome;

                            const logoElement = document.createElement("img");
                            logoElement.src = transportadora.url_logo;

                            const valorFreteElement = document.createElement("p");
                            valorFreteElement.textContent = `Valor do Frete: ${transportadora.vlrFrete}`;

                            const prazoEntregaElement = document.createElement("p");
                            prazoEntregaElement.textContent = `Prazo de Entrega: ${transportadora.prazoEnt}`;

                            const dataPrevEntregaElement = document.createElement("p");
                            dataPrevEntregaElement.textContent = `Previsão de Entrega: ${transportadora.dtPrevEnt}`;

                            cardElement.appendChild(nomeElement);
                            cardElement.appendChild(logoElement);
                            cardElement.appendChild(valorFreteElement);
                            cardElement.appendChild(prazoEntregaElement);
                            cardElement.appendChild(dataPrevEntregaElement);

                            cardsContainer.appendChild(cardElement);

                            // Adicionar evento de seleção ao card
                            cardElement.addEventListener("click", function() {
                                // Remover classe "selected" de todos os cards
                                const allCards = document.getElementsByClassName("card");
                                for (let i = 0; i < allCards.length; i++) {
                                    allCards[i].classList.remove("selected");
                                }

                                // Adicionar classe "selected" ao card selecionado
                                this.classList.add("selected");

                                // Exibir detalhes do frete no campo de texto
                                const campoTexto = document.getElementById("campoTexto");
                                const nomeProduto = $('#produto option:selected').text();
                                const frete = transportadora.vlrFrete;
                                const prazoEntrega = transportadora.prazoEnt;
                                const dataPrevEntrega = transportadora.dtPrevEnt;
                                const valorTotal = (valor * quantidade) + parseFloat(frete);
                                const prazoConfeccao = 15; // Prazo de confecção fixo em 15 dias úteis

                                const detalhesFrete = `Frete: ${cepDestino} - ${frete} - (Dia da postagem + ${prazoEntrega})\n`;
                                const total = `Total: ${valorTotal}`;
                                const prazo = `Prazo para confecção é de ${prazoConfeccao} dias úteis + prazo de envio.\nPrazo inicia-se após aprovação da arte e pagamento confirmado`;

                                campoTexto.value = `${nomeProduto}\n${detalhesFrete}${total}\n${prazo}`;
                            });
                        });
                    })
                    .catch(error => console.error(error));
            });

            // Copiar conteúdo do campo de texto ao clicar no botão "Copiar"
            $('#botaoCopiar').click(function() {
                const campoTexto = document.getElementById("campoTexto");
                campoTexto.select();
                document.execCommand("copy");
                $('#avisoCopiado').show().delay(1500).fadeOut();
            });

        });
    </script>
</body>
</html>
