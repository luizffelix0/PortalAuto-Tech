<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulador de Viagem - Portal AutoTech</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        .resultado-viagem {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            border-left: 5px solid #e52525;
        }

        .linha-resultado {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #ddd;
            font-size: 16px;
        }

        .linha-resultado:last-child {
            border-bottom: none;
        }

        .linha-resultado strong {
            color: #101923;
        }

        .linha-resultado .valor {
            color: #e52525;
            font-weight: bold;
            font-size: 18px;
        }

        .icone-resultado {
            font-size: 28px;
            margin-right: 10px;
        }

        .resumo-valores {
            background-color: #e52525;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            text-align: center;
        }

        .resumo-valores strong {
            font-size: 22px;
            display: block;
            margin-top: 10px;
        }

        .info-viagem {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 2px solid #bee5eb;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            text-align: center;
        }

        select.Campo {
            width: 100%;
            height: 40px;
            padding: 10px;
            border: 1px solid #aaa;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 15px;
            font-family: Arial, Helvetica, sans-serif;
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
            <h3>SIMULADOR DE VIAGEM</h3>
            <p>Estime combustível e custo da viagem</p>
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
        <h2>Simulador de Viagem</h2>
        <p>Simule o consumo e custo de combustível para sua viagem.</p>

        <!-- CARD FORMULÁRIO -->
        <article class="card">
            <div class="Formulario">
                <form method="POST">
                    <label class="Legenda">Distância da Viagem (km):</label>
                    <input class="Campo" type="number" name="distancia" 
                           placeholder="Ex: 500" step="0.01" min="0"
                           value="<?php echo isset($_POST['distancia']) ? htmlspecialchars($_POST['distancia']) : ''; ?>" 
                           required />

                    <label class="Legenda">Consumo Médio do Veículo (km/L):</label>
                    <input class="Campo" type="number" name="consumo" 
                           placeholder="Ex: 12" step="0.01" min="0"
                           value="<?php echo isset($_POST['consumo']) ? htmlspecialchars($_POST['consumo']) : ''; ?>" 
                           required />

                    <label class="Legenda">Preço do Combustível (R$/L):</label>
                    <input class="Campo" type="number" name="preco" 
                           placeholder="Ex: 6,10" step="0.01" min="0"
                           value="<?php echo isset($_POST['preco']) ? htmlspecialchars($_POST['preco']) : ''; ?>" 
                           required />

                    <label class="Legenda">Tipo de Viagem:</label>
                    <select class="Campo" name="tipo_viagem" required>
                        <option value="">-- Selecione uma opção --</option>
                        <option value="ida" <?php echo (isset($_POST['tipo_viagem']) && $_POST['tipo_viagem'] === 'ida') ? 'selected' : ''; ?>>Somente ida</option>
                        <option value="ida_volta" <?php echo (isset($_POST['tipo_viagem']) && $_POST['tipo_viagem'] === 'ida_volta') ? 'selected' : ''; ?>>Ida e volta</option>
                    </select>

                    <button class="botao" type="submit">Simular Viagem</button>
                </form>
            </div>
        </article>

        <!-- RESULTADO DO CÁLCULO -->
        <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $distancia = isset($_POST['distancia']) && is_numeric($_POST['distancia']) ? floatval($_POST['distancia']) : null;
            $consumo = isset($_POST['consumo']) && is_numeric($_POST['consumo']) ? floatval($_POST['consumo']) : null;
            $preco = isset($_POST['preco']) && is_numeric($_POST['preco']) ? floatval($_POST['preco']) : null;
            $tipo_viagem = isset($_POST['tipo_viagem']) && in_array($_POST['tipo_viagem'], ['ida', 'ida_volta']) ? $_POST['tipo_viagem'] : null;

            if ($distancia !== null && $consumo !== null && $preco !== null && $tipo_viagem !== null && 
                $distancia > 0 && $consumo > 0 && $preco >= 0) {
                
                // Desafio extra: considerar dobro da distância para ida e volta
                $distancia_total = ($tipo_viagem === 'ida_volta') ? $distancia * 2 : $distancia;
                $tipo_viagem_nome = ($tipo_viagem === 'ida_volta') ? 'Ida e volta' : 'Somente ida';

                $litros_necessarios = $distancia_total / $consumo;
                $custo_estimado = $litros_necessarios * $preco;

        ?>

        <article class="card">
            <h2>🛣️ Simulação da Viagem</h2>
            
            <div class="resultado-viagem">
                <div class="linha-resultado">
                    <div>
                        <span class="icone-resultado">🚗</span>
                        <strong>Distância Total:</strong>
                    </div>
                    <span class="valor"><?php echo number_format($distancia_total, 2, ',', '.'); ?> km</span>
                </div>

                <div class="linha-resultado">
                    <div>
                        <span class="icone-resultado">⛽</span>
                        <strong>Consumo Médio:</strong>
                    </div>
                    <span class="valor"><?php echo number_format($consumo, 2, ',', '.'); ?> km/L</span>
                </div>

                <div class="linha-resultado">
                    <div>
                        <span class="icone-resultado">💧</span>
                        <strong>Combustível Necessário:</strong>
                    </div>
                    <span class="valor"><?php echo number_format($litros_necessarios, 2, ',', '.'); ?> L</span>
                </div>

                <div class="linha-resultado">
                    <div>
                        <span class="icone-resultado">💰</span>
                        <strong>Custo Estimado:</strong>
                    </div>
                    <span class="valor">R$ <?php echo number_format($custo_estimado, 2, ',', '.'); ?></span>
                </div>

                <div class="linha-resultado">
                    <div>
                        <span class="icone-resultado">🔄</span>
                        <strong>Tipo de Viagem:</strong>
                    </div>
                    <span class="valor"><?php echo $tipo_viagem_nome; ?></span>
                </div>
            </div>

            <div class="resumo-valores">
                <strong>CUSTO TOTAL ESTIMADO</strong>
                <strong style="font-size: 36px;">R$ <?php echo number_format($custo_estimado, 2, ',', '.'); ?></strong>
            </div>

            <div class="info-viagem">
                <strong style="font-size: 16px;">📋 Informações da Simulação</strong>
                <p style="margin-top: 10px; margin-bottom: 0;">
                    Para a viagem <?php echo strtolower($tipo_viagem_nome); ?> de <strong><?php echo number_format($distancia, 2, ',', '.'); ?> km</strong>, 
                    seu veículo consumirá aproximadamente <strong><?php echo number_format($litros_necessarios, 2, ',', '.'); ?> litros</strong> de combustível, 
                    resultando em um custo estimado de <strong>R$ <?php echo number_format($custo_estimado, 2, ',', '.'); ?></strong>.
                </p>
            </div>

            <hr style="border: 1px solid #ddd; margin: 20px 0;">

            <h3>💡 Dicas para Economizar Combustível</h3>
            <ul style="padding-left: 20px; line-height: 1.8;">
                <li>Mantenha a pressão dos pneus adequada (melhora até 5% no consumo)</li>
                <li>Evite acelerar e frear bruscamente</li>
                <li>Dirija em velocidade constante (65-90 km/h é mais econômico)</li>
                <li>Desligue o motor em paradas longas</li>
                <li>Remova objetos desnecessários do veículo (reduz peso)</li>
                <li>Faça revisões periódicas do motor</li>
                <li>Evite usar ar-condicionado em velocidades altas</li>
            </ul>

        </article>

        <?php 
            } else {
                echo '<article class="card" style="background-color: #f8d7da; border: 1px solid #f5c6cb;">';
                echo '<h3 style="color: #721c24;">❌ Erro na Simulação</h3>';
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