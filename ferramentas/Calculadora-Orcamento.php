<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Orçamento - Portal AutoTech</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- ========================= TOPO  ========================== -->
    <header class="topo">
        <div class="logo">
            <h1>Auto<span>Tech</span></h1>
            <p>OFICINA MECÂNICA</p>
        </div>

        <div class="informacao">
            <h3>CALCULADORA DE ORÇAMENTO</h3>
            <p>Calcule peças e mão de obra</p>
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
        <h2>Calculadora de Orçamento</h2>
        <p>Informe os detalhes do serviço para gerar o orçamento.</p>

        <!-- CARD FORMULÁRIO -->
        <article class="card">
            <div class="Formulario">
                <form method="POST">
                    <label class="Legenda">Descrição do Serviço:</label>
                    <input class="Campo" type="text" name="descricao" 
                           placeholder="Ex: Troca de pastilhas de freio" 
                           value="<?php echo isset($_POST['descricao']) ? htmlspecialchars($_POST['descricao']) : ''; ?>" 
                           required />

                    <label class="Legenda">Valor das Peças (R$):</label>
                    <input class="Campo" type="number" name="valor" 
                           placeholder="Ex: 450,00" step="0.01" min="0"
                           value="<?php echo isset($_POST['valor']) ? htmlspecialchars($_POST['valor']) : ''; ?>" 
                           required />

                    <label class="Legenda">Valor da Mão de Obra (R$):</label>
                    <input class="Campo" type="number" name="obra" 
                           placeholder="Ex: 200,00" step="0.01" min="0"
                           value="<?php echo isset($_POST['obra']) ? htmlspecialchars($_POST['obra']) : ''; ?>" 
                           required />

                    <button class="botao" type="submit">Calcular Orçamento</button>
                </form>
            </div>
        </article>

        <!-- RESULTADO DO CÁLCULO -->
        <?php 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validação de entrada
            $descricao = isset($_POST['descricao']) && !empty(trim($_POST['descricao'])) 
                        ? trim($_POST['descricao']) 
                        : null;
            
            $valor = isset($_POST['valor']) && is_numeric($_POST['valor']) 
                    ? floatval($_POST['valor']) 
                    : null;
            
            $obra = isset($_POST['obra']) && is_numeric($_POST['obra']) 
                   ? floatval($_POST['obra']) 
                   : null;

            // Verificar se todos os campos foram preenchidos corretamente
            if ($descricao !== null && $valor !== null && $obra !== null && $valor >= 0 && $obra >= 0) {
                $total = $valor + $obra;
                $alerta_alto_valor = ($total > 1000) ? true : false;
        ?>

        <article class="card">
            <h2>📋 Relatório do Orçamento</h2>
            
            <p class="legenda">
                <strong>Serviço:</strong> <?php echo htmlspecialchars($descricao); ?>
            </p>
            
            <p class="legenda">
                <strong>Valor das Peças:</strong> 
                <span style="color: #e52525; font-weight: bold;">
                    R$ <?php echo number_format($valor, 2, ',', '.'); ?>
                </span>
            </p>
            
            <p class="legenda">
                <strong>Mão de Obra:</strong> 
                <span style="color: #e52525; font-weight: bold;">
                    R$ <?php echo number_format($obra, 2, ',', '.'); ?>
                </span>
            </p>
            
            <hr style="border: 1px solid #ddd; margin: 15px 0;">
            
            <p class="legenda" style="font-size: 18px;">
                <strong>Total do Orçamento:</strong> 
                <span style="color: #e52525; font-weight: bold; font-size: 22px;">
                    R$ <?php echo number_format($total, 2, ',', '.'); ?>
                </span>
            </p>

            <?php 
            // Desafio Extra: Alerta para orçamentos acima de R$ 1.000
            if ($alerta_alto_valor) {
            ?>
                <div style="background-color: #fff3cd; border: 2px solid #ffc107; 
                           padding: 15px; border-radius: 5px; margin-top: 15px; text-align: center;">
                    <strong style="color: #856404; font-size: 16px;">
                        ⚠️ Orçamento de alto valor. Consulte as condições de pagamento.
                    </strong>
                </div>
            <?php 
            } 
            ?>

        </article>

        <?php 
            } else {
                // Mostrar mensagem de erro se algum campo estiver vazio ou inválido
                echo '<article class="card" style="background-color: #f8d7da; border: 1px solid #f5c6cb;">';
                echo '<h3 style="color: #721c24;">❌ Erro no Orçamento</h3>';
                echo '<p style="color: #721c24;">Por favor, preencha todos os campos com valores válidos (maiores ou iguais a zero).</p>';
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