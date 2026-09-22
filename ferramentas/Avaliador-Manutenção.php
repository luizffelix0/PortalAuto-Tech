<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliador de Manutenção - Portal AutoTech</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .status-manutencao {
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
            font-size: 18px;
        }

        .manutencao-dia {
            background-color: #d4edda;
            color: #155724;
            border: 2px solid #c3e6cb;
        }

        .manutencao-recomendada {
            background-color: #fff3cd;
            color: #856404;
            border: 2px solid #ffeeba;
        }

        .manutencao-necessaria {
            background-color: #f8d7da;
            color: #721c24;
            border: 2px solid #f5c6cb;
        }

        .detalhe-manutencao {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            border-left: 5px solid #e52525;
        }

        .linha-info {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }

        .linha-info strong {
            color: #101923;
        }

        .linha-info .valor {
            color: #e52525;
            font-weight: bold;
        }

        .tabela-limites {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
            border: 2px solid #101923;
        }

        .tabela-limites th {
            background-color: #101923;
            color: white;
            padding: 12px;
            text-align: center;
        }

        .tabela-limites td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .tabela-limites tr:nth-child(even) {
            background-color: #f9f9f9;
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
            <h3>AVALIADOR DE MANUTENÇÃO</h3>
            <p>Verifique a situação da manutenção</p>
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
        <h2>Avaliador de Manutenção</h2>
        <p>Informe os dados do veículo para verificar a situação da manutenção.</p>

        <!-- CARD FORMULÁRIO -->
        <article class="card">
            <div class="Formulario">
                <form method="POST">
                    <label class="Legenda">Tipo de Veículo:</label>
                    <select class="Campo" name="tipo_veiculo" required>
                        <option value="">-- Selecione uma opção --</option>
                        <option value="carro" <?php echo (isset($_POST['tipo_veiculo']) && $_POST['tipo_veiculo'] === 'carro') ? 'selected' : ''; ?>>Carro</option>
                        <option value="motocicleta" <?php echo (isset($_POST['tipo_veiculo']) && $_POST['tipo_veiculo'] === 'motocicleta') ? 'selected' : ''; ?>>Motocicleta</option>
                    </select>

                    <label class="Legenda">Quilometragem Atual do Veículo (km):</label>
                    <input class="Campo" type="number" name="km_atual" 
                           placeholder="Ex: 45000" min="0"
                           value="<?php echo isset($_POST['km_atual']) ? htmlspecialchars($_POST['km_atual']) : ''; ?>" 
                           required />

                    <label class="Legenda">Quilometragem da Última Manutenção (km):</label>
                    <input class="Campo" type="number" name="km_ultima" 
                           placeholder="Ex: 36000" min="0"
                           value="<?php echo isset($_POST['km_ultima']) ? htmlspecialchars($_POST['km_ultima']) : ''; ?>" 
                           required />

                    <button class="botao" type="submit">Avaliar Manutenção</button>
                </form>
            </div>
        </article>

        <!-- RESULTADO DO CÁLCULO -->
        <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo_veiculo = isset($_POST['tipo_veiculo']) && in_array($_POST['tipo_veiculo'], ['carro', 'motocicleta']) ? $_POST['tipo_veiculo'] : null;
            $km_atual = isset($_POST['km_atual']) && is_numeric($_POST['km_atual']) ? floatval($_POST['km_atual']) : null;
            $km_ultima = isset($_POST['km_ultima']) && is_numeric($_POST['km_ultima']) ? floatval($_POST['km_ultima']) : null;

            if ($tipo_veiculo !== null && $km_atual !== null && $km_ultima !== null && $km_atual >= 0 && $km_ultima >= 0 && $km_atual >= $km_ultima) {
                
                $km_percorridos = $km_atual - $km_ultima;

                // Definir limites conforme tipo de veículo
                if ($tipo_veiculo === 'carro') {
                    $limite_dia = 5000;
                    $limite_recomendada = 10000;
                    $tipo_nome = "Carro";
                } else {
                    $limite_dia = 3000;
                    $limite_recomendada = 6000;
                    $tipo_nome = "Motocicleta";
                }

                // Classificar manutenção
                if ($km_percorridos <= $limite_dia) {
                    $status = "Manutenção em dia";
                    $classe_css = "manutencao-dia";
                    $icone = "✅";
                    $mensagem = "A manutenção do veículo está em dia. Continue acompanhando regularmente.";
                } elseif ($km_percorridos <= $limite_recomendada) {
                    $status = "Manutenção recomendada";
                    $classe_css = "manutencao-recomendada";
                    $icone = "⚠️";
                    $mensagem = "É recomendado realizar a manutenção em breve para evitar problemas.";
                } else {
                    $status = "Manutenção necessária";
                    $classe_css = "manutencao-necessaria";
                    $icone = "🚨";
                    $mensagem = "A manutenção é necessária URGENTEMENTE para preservar o veículo.";
                }
        ?>

        <article class="card">
            <h2>🔧 Resultado da Avaliação</h2>
            
            <div class="detalhe-manutencao">
                <div class="linha-info">
                    <strong>Tipo de Veículo:</strong>
                    <span class="valor"><?php echo $tipo_nome; ?></span>
                </div>
                <div class="linha-info">
                    <strong>Quilometragem Atual:</strong>
                    <span class="valor"><?php echo number_format($km_atual, 0, ',', '.'); ?> km</span>
                </div>
                <div class="linha-info">
                    <strong>Última Manutenção:</strong>
                    <span class="valor"><?php echo number_format($km_ultima, 0, ',', '.'); ?> km</span>
                </div>
                <div class="linha-info">
                    <strong>Quilômetros Percorridos:</strong>
                    <span class="valor"><?php echo number_format($km_percorridos, 0, ',', '.'); ?> km</span>
                </div>
            </div>

            <div class="status-manutencao <?php echo $classe_css; ?>">
                <span style="font-size: 28px; margin-right: 10px;"><?php echo $icone; ?></span>
                <br><br>
                <strong><?php echo $status; ?></strong>
            </div>

            <p style="margin-top: 20px; padding: 15px; background-color: #f0f0f0; border-radius: 8px; text-align: center; font-size: 16px;">
                <?php echo $mensagem; ?>
            </p>

            <hr style="border: 1px solid #ddd; margin: 20px 0;">

            <h3>📊 Tabela de Limites de Manutenção</h3>
            <table class="tabela-limites">
                <tr>
                    <th>Tipo de Veículo</th>
                    <th>Até</th>
                    <th>Status</th>
                    <th>De</th>
                    <th>Até</th>
                    <th>Status</th>
                    <th>Acima de</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td><strong>Carro</strong></td>
                    <td>5.000 km</td>
                    <td>✅ Em dia</td>
                    <td>5.001 km</td>
                    <td>10.000 km</td>
                    <td>⚠️ Recomendada</td>
                    <td>10.000 km</td>
                    <td>🚨 Necessária</td>
                </tr>
                <tr>
                    <td><strong>Motocicleta</strong></td>
                    <td>3.000 km</td>
                    <td>✅ Em dia</td>
                    <td>3.001 km</td>
                    <td>6.000 km</td>
                    <td>⚠️ Recomendada</td>
                    <td>6.000 km</td>
                    <td>🚨 Necessária</td>
                </tr>
            </table>

        </article>

        <?php 
            } else {
                echo '<article class="card" style="background-color: #f8d7da; border: 1px solid #f5c6cb;">';
                echo '<h3 style="color: #721c24;">❌ Erro na Avaliação</h3>';
                echo '<p style="color: #721c24;">Por favor, preencha todos os campos corretamente. A quilometragem atual deve ser maior ou igual à última manutenção.</p>';
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