<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Combustível - Portal AutoTech</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .resultado-consumo {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            border-left: 5px solid #e52525;
        }

        .linha-resultado {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }

        .linha-resultado strong {
            color: #101923;
        }

        .linha-resultado .valor {
            color: #e52525;
            font-weight: bold;
            font-size: 18px;
        }

        .classificacao {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .alto-consumo {
            background-color: #f8d7da;
            color: #721c24;
            border: 2px solid #f5c6cb;
        }

        .consumo-moderado {
            background-color: #fff3cd;
            color: #856404;
            border: 2px solid #ffeeba;
        }

        .bom-consumo {
            background-color: #d4edda;
            color: #155724;
            border: 2px solid #c3e6cb;
        }

        .excelente-consumo {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 2px solid #bee5eb;
        }

        .tabela-classificacao {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
            border: 2px solid #101923;
        }

        .tabela-classificacao th {
            background-color: #101923;
            color: white;
            padding: 12px;
            text-align: center;
        }

        .tabela-classificacao td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .tabela-classificacao tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .icone-combustivel {
            font-size: 24px;
            margin-right: 8px;
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
            <h3>CALCULADORA DE COMBUSTÍVEL</h3>
            <p>Analise o consumo e custo de combustível</p>
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
        <h2>Calculadora de Combustível</h2>
        <p>Informe os dados de consumo do veículo para análise.</p>

        <!-- CARD FORMULÁRIO -->
        <article class="card">
            <div class="Formulario">
                <form method="POST">
                    <label class="Legenda">Distância Percorrida (km):</label>
                    <input class="Campo" type="number" name="distancia" 
                           placeholder="Ex: 500" step="0.01" min="0"
                           value="<?php echo isset($_POST['distancia']) ? htmlspecialchars($_POST['distancia']) : ''; ?>" 
                           required />

                    <label class="Legenda">Litros Consumidos (L):</label>
                    <input class="Campo" type="number" name="litros" 
                           placeholder="Ex: 40.5" step="0.01" min="0"
                           value="<?php echo isset($_POST['litros']) ? htmlspecialchars($_POST['litros']) : ''; ?>" 
                           required />

                    <label class="Legenda">Preço do Litro de Combustível (R$):</label>
                    <input class="Campo" type="number" name="preco" 
                           placeholder="Ex: 6,10" step="0.01" min="0"
                           value="<?php echo isset($_POST['preco']) ? htmlspecialchars($_POST['preco']) : ''; ?>" 
                           required />

                    <button class="botao" type="submit">Calcular Consumo</button>
                </form>
            </div>
        </article>

        <!-- RESULTADO DO CÁLCULO -->
        <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $distancia = isset($_POST['distancia']) && is_numeric($_POST['distancia']) ? floatval($_POST['distancia']) : null;
            $litros = isset($_POST['litros']) && is_numeric($_POST['litros']) ? floatval($_POST['litros']) : null;
            $preco = isset($_POST['preco']) && is_numeric($_POST['preco']) ? floatval($_POST['preco']) : null;

            if ($distancia !== null && $litros !== null && $preco !== null && $distancia > 0 && $litros > 0 && $preco >= 0) {
                
                $consumo_medio = $distancia / $litros;
                $custo_total = $litros * $preco;
                $custo_km = $custo_total / $distancia;

                // Classificar consumo
                if ($consumo_medio < 8) {
                    $classificacao = "Alto consumo";
                    $classe_css = "alto-consumo";
                    $icone = "🔴";
                } elseif ($consumo_medio < 12) {
                    $classificacao = "Consumo moderado";
                    $classe_css = "consumo-moderado";
                    $icone = "🟡";
                } elseif ($consumo_medio < 16) {
                    $classificacao = "Bom consumo";
                    $classe_css = "bom-consumo";
                    $icone = "🟢";
                } else {
                    $classificacao = "Excelente consumo";
                    $classe_css = "excelente-consumo";
                    $icone = "🔵";
                }
        ?>

        <article class="card">
            <h2>⛽ Resultado da Análise</h2>
            
            <div class="resultado-consumo">
                <div class="linha-resultado">
                    <strong>Distância Percorrida:</strong>
                    <span class="valor"><?php echo number_format($distancia, 2, ',', '.'); ?> km</span>
                </div>
                <div class="linha-resultado">
                    <strong>Litros Consumidos:</strong>
                    <span class="valor"><?php echo number_format($litros, 2, ',', '.'); ?> L</span>
                </div>
                <div class="linha-resultado">
                    <strong>Consumo Médio:</strong>
                    <span class="valor"><?php echo number_format($consumo_medio, 2, ',', '.'); ?> km/L</span>
                </div>
                <div class="linha-resultado">
                    <strong>Custo Total de Combustível:</strong>
                    <span class="valor">R$ <?php echo number_format($custo_total, 2, ',', '.'); ?></span>
                </div>
                <div class="linha-resultado">
                    <strong>Custo por Quilômetro:</strong>
                    <span class="valor">R$ <?php echo number_format($custo_km, 3, ',', '.'); ?>/km</span>
                </div>
            </div>

            <div class="classificacao <?php echo $classe_css; ?>">
                <span class="icone-combustivel"><?php echo $icone; ?></span>
                <strong><?php echo $classificacao; ?></strong>
            </div>

            <hr style="border: 1px solid #ddd; margin: 20px 0;">

            <h3>📊 Tabela de Classificação de Consumo</h3>
            <table class="tabela-classificacao">
                <tr>
                    <th>Consumo (km/L)</th>
                    <th>Classificação</th>
                    <th>Situação</th>
                </tr>
                <tr>
                    <td>Menos de 8 km/L</td>
                    <td>🔴 Alto consumo</td>
                    <td>Verificar motor</td>
                </tr>
                <tr>
                    <td>De 8 até menos de 12 km/L</td>
                    <td>🟡 Consumo moderado</td>
                    <td>Dentro do esperado</td>
                </tr>
                <tr>
                    <td>De 12 até 16 km/L</td>
                    <td>🟢 Bom consumo</td>
                    <td>Excelente desempenho</td>
                </tr>
                <tr>
                    <td>Acima de 16 km/L</td>
                    <td>🔵 Excelente consumo</td>
                    <td>Ótimo rendimento</td>
                </tr>
            </table>

            <p style="margin-top: 15px; color: #667085; font-size: 14px;">
                <strong>💡 Dica:</strong> Quanto maior o consumo (km/L), mais econômico é o veículo.
            </p>

        </article>

        <?php 
            } else {
                echo '<article class="card" style="background-color: #f8d7da; border: 1px solid #f5c6cb;">';
                echo '<h3 style="color: #721c24;">❌ Erro no Cálculo</h3>';
                echo '<p style="color: #721c24;">Por favor, preencha todos os campos com valores válidos e maiores que zero.</p>';
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