<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal AutoTech - Ferramentas para Oficina Mecânica</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <!-- ========================= TOPO  ========================== -->
    <header class="topo">
        <div class="logo">
            <h1>Auto<span>Tech</span></h1>
            <p>OFICINA MECÂNICA</p>
        </div>

        <div class="informacao">
            <h3>PORTAL DE FERRAMENTAS</h3>
            <p>Soluções rápidas para o dia a dia da oficina</p>
        </div>
    </header>

    <!-- =========================   MENU   ========================== -->
    <nav class="menu">
        <a href="Index.php">Início</a>
        <a href="Ferramentas/Calculadora-Orcamento.php">Orçamento</a>
        <a href="Ferramentas/Troca-Pneus.php">Pneus</a>
        <a href="Ferramentas/Calculadora-Combustivel.php">Combustível</a>
        <a href="Ferramentas/Avaliador-Manutenção.php">Serviço</a>
        <a href="Ferramentas/Simulador-Viagem.php">Viagem</a>
    </nav>

    <!-- =========================  FERRAMENTAS  ========================== -->
    <section class="ferramentas">
        <h2>Ferramentas disponíveis</h2>
        <p>Utilize as ferramentas para auxiliar no atendimento aos clientes.</p>

        <!-- CARD 1 - ORÇAMENTO -->
        <article class="card">
            <div class="icone">💰</div>
            <h3>Calculadora de Orçamento</h3>
            <p>Calcule rapidamente o valor de peças e mão de obra.</p>
            <a href="ferramentas/Calculadora-Orcamento.php" class="botao">Acessar</a>
        </article>

        <!-- CARD 2 - PNEUS -->
        <article class="card">
            <div class="icone">🚗</div>
            <h3>Calculadora de Pneus</h3>
            <p>Calcule o valor da troca, montagem e balanceamento.</p>
            <a href="ferramentas/Troca-Pneus.php" class="botao">Acessar</a>
        </article>

        <!-- CARD 3 - COMBUSTÍVEL -->
        <article class="card">
            <div class="icone">⛽</div>
            <h3>Calculadora de Combustível</h3>
            <p>Analise o consumo e o custo de combustível.</p>
            <a href="ferramentas/Calculadora-Combustivel.php" class="botao">Acessar</a>
        </article>

        <!-- CARD 4 - MANUTENÇÃO -->
        <article class="card">
            <div class="icone">🔧</div>
            <h3>Avaliador de Manutenção</h3>
            <p>Verifique a situação da manutenção do veículo.</p>
            <a href="ferramentas/Avaliador-Manutenção.php" class="botao">Acessar</a>
        </article>

        <!-- CARD 5 - VIAGEM -->
        <article class="card">
            <div class="icone">🛣️</div>
            <h3>Simulador de Viagem</h3>
            <p>Estime o consumo e o custo de combustível da viagem.</p>
            <a href="ferramentas/Simulador-Viagem.php" class="botao">Acessar</a>
        </article>
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
