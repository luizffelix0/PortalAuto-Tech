<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Pneus - Portal AutoTech</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .tabela-resultado {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #f9f9f9;
        }

        .tabela-resultado th {
            background-color: #101923;
            color: white;
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .tabela-resultado td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        .tabela-resultado tr:nth-child(even) {
            background-color: #f0f0f0;
        }

        .tabela-resultado .total-row {
            background-color: #e52525;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .tabela-resultado .total-row td {
            padding: 15px;
        }
    </style>
</head>

<body>
    <!-- ========================= TOPO  ========================== -->
    <header class="topo">
        <div class="logo">
            <h1>Auto<span>Tech</span></h1>
            <p>OFICINA MECÂNICA</p>
        </div>

        <div class="informacao">
            <h3>CALCULADORA DE PNEUS</h3>
            <p>Calcule troca, montagem e balanceamento</p>
        </div>
    </header>

    <!-- =========================   MENU   ========================== -->
    <nav class="menu">
        <a href="../Index.php">Início</a>
        <a href="Calculadora-Orcamento.php">Orçamento</a>
        <a href="Troca-Pneus.php">Pneus</a>
        <a href="Calculadora-Combustivel.php">Combustível</a>
        <a href="Avaliador-Manutenção.php">Serviço</a>
        <a href="Simulador-Viagem.php">Viagem</a>
    </nav>

    <!-- =========================  FERRAMENTAS  ========================== -->
    <section class="ferramentas">
        <h2>Calculadora de Pneus</h2>
        <p>Informe os dados dos pneus para gerar o orçamento.</p>

        <!-- CARD FORMULÁRIO -->
        <article class="card">
            <div class="Formulario">
                <form method="POST">
                    <label class="Legenda">Marca/Modelo do Pneu:</label>
                    <input class="Campo" type="text" name="marca" 
                           placeholder="Ex: Pirelli Cinturato P7" 
                           value="<?php echo isset($_POST['marca']) ? htmlspecialchars($_POST['marca']) : ''; ?>" 
                           required />

                    <label class="Legenda">Preço de cada Pneu (R$):</label>
                    <input class="Campo" type="number" name="preco" 
                           placeholder="Ex: 450,00" step="0.01" min="0"
                           value="<?php echo isset($_POST['preco']) ? htmlspecialchars($_POST['preco']) : ''; ?>" 
                           required />

                    <label class="Legenda">Quantidade de Pneus:</label>
                    <input class="Campo" type="number" name="quantidade" 
                           placeholder="Ex: 4" min="1" max="10"
                           value="<?php echo isset($_POST['quantidade']) ? htmlspecialchars($_POST['quantidade']) : ''; ?>" 
                           required />

                    <label class="Legenda">Valor da Montagem por Pneu (R$):</label>
                    <input class="Campo" type="number" name="montagem" 
                           placeholder="Ex: 40,00" step="0.01" min="0"
                           value="<?php echo isset($_POST['montagem']) ? htmlspecialchars($_POST['montagem']) : ''; ?>" 
                           required />

                    <label class="Legenda">Valor do Balanceamento por Pneu (R$):</label>
                    <input class="Campo" type="number" name="balanceamento" 
                           placeholder="Ex: 30,00" step="0.01" min="0"
                           value="<?php echo isset($_POST['balanceamento']) ? htmlspecialchars($_POST['balanceamento']) : ''; ?>" 
                           required />

                    <button class="botao" type="submit">Calcular Serviço</button>
                </form>
            </div>
        </article>

        <!-- RESULTADO DO CÁLCULO -->
        <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $marca = isset($_POST['marca']) && !empty(trim($_POST['marca'])) ? trim($_POST['marca']) : null;
            $preco = isset($_POST['preco']) && is_numeric($_POST['preco']) ? floatval($_POST['preco']) : null;
            $quantidade = isset($_POST['quantidade']) && is_numeric($_POST['quantidade']) ? intval($_POST['quantidade']) : null;
            $montagem = isset($_POST['montagem']) && is_numeric($_POST['montagem']) ? floatval($_POST['montagem']) : null;
            $balanceamento = isset($_POST['balanceamento']) && is_numeric($_POST['balanceamento']) ? floatval($_POST['balanceamento']) : null;

            if ($marca !== null && $preco !== null && $quantidade !== null && $montagem !== null && 
                $balanceamento !== null && $preco >= 0 && $quantidade >= 1 && $montagem >= 0 && $balanceamento >= 0) {

                $valor_pneus = $preco * $quantidade;
                $valor_montagem = $montagem * $quantidade;
                $valor_balanceamento = $balanceamento * $quantidade;
                $total = $valor_pneus + $valor_montagem + $valor_balanceamento;
        ?>

        <article class="card">
            <h2>📋 Resumo do Serviço</h2>
            
            <table class="tabela-resultado">
                <tr>
                    <th>Descrição</th>
                    <th>Valor</th>
                </tr>
                <tr>
                    <td><strong>Marca/Modelo</strong></td>
                    <td><?php echo htmlspecialchars($marca); ?></td>
                </tr>
                <tr>
                    <td><strong>Quantidade de Pneus</strong></td>
                    <td><?php echo $quantidade; ?></td>
                </tr>
                <tr>
                    <td><strong>Valor dos Pneus</strong> (<?php echo $quantidade; ?> × R$ <?php echo number_format($preco, 2, ',', '.'); ?>)</td>
                    <td><span style="color: #e52525; font-weight: bold;">R$ <?php echo number_format($valor_pneus, 2, ',', '.'); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Valor da Montagem</strong> (<?php echo $quantidade; ?> × R$ <?php echo number_format($montagem, 2, ',', '.'); ?>)</td>
                    <td><span style="color: #e52525; font-weight: bold;">R$ <?php echo number_format($valor_montagem, 2, ',', '.'); ?></span></td>
                </tr>
                <tr>
                    <td><strong>Valor do Balanceamento</strong> (<?php echo $quantidade; ?> × R$ <?php echo number_format($balanceamento, 2, ',', '.'); ?>)</td>
                    <td><span style="color: #e52525; font-weight: bold;">R$ <?php echo number_format($valor_balanceamento, 2, ',', '.'); ?></span></td>
                </tr>
                <tr class="total-row">
                    <td>VALOR TOTAL</td>
                    <td>R$ <?php echo number_format($total, 2, ',', '.'); ?></td>
                </tr>
            </table>
        </article>

        <?php 
            } else {
                echo '<article class="card" style="background-color: #f8d7da; border: 1px solid #f5c6cb;">';
                echo '<h3 style="color: #721c24;">❌ Erro no Cálculo</h3>';
                echo '<p style="color: #721c24;">Por favor, preencha todos os campos com valores válidos.</p>';
                echo '</article>';
            }
        }
        ?>

    </section>

    <!-- =========================  RODAPÉ  ========================== -->
    <footer class="rodape">
        <div class="rodape-coluna">
            <h3>Auto<span style="color:#e52525;">Tech</span></h3>
            <p>Portal de ferramentas para oficina mecânica.</p>
        </div>

        <div class="rodape-coluna">
            <h3>Ferramentas</h3>
            <p>Orçamento</p>
            <p>Pneus</p>
            <p>Combustível</p>
        </div>

        <div class="rodape-coluna">
            <h3>AutoTech</h3>
            <p>Qualidade em cada quilômetro.</p>
            <p>Santana de Parnaíba - SP</p>
        </div>

        <div class="copyright">
            © 2026 AutoTech - Portal de Ferramentas
        </div>
    </footer>
</body>

</html>