<?php
// Inclui o arquivo de conexão com o banco de dados
include('conexao.php');

// Inicializar variáveis para cada pergunta
$acesso_ruim = $acesso_regular = $acesso_otimo = 0;
$organizacao_ruim = $organizacao_regular = $organizacao_otimo = 0;
$apresentacoes_ruim = $apresentacoes_regular = $apresentacoes_otimo = 0;
$interatividade_sim = $interatividade_nao = 0;
$satisfacao_ruim = $satisfacao_regular = $satisfacao_otimo = 0;

// Consultar as respostas para cada pergunta
$sql = "SELECT acesso, organizacao, apresentacoes, interatividade, satisfacao FROM respostas_feira";
$result = $conn->query($sql);

// Verificar se há erros na consulta
if (!$result) {
    die("Erro na consulta: " . $conn->error);
}

// Verificar se há resultados
if ($result->num_rows > 0) {
    // Contagem das respostas para cada pergunta
    while ($row = $result->fetch_assoc()) {
        // Acesso
        if ($row['acesso'] == 1) $acesso_ruim++;
        elseif ($row['acesso'] == 2) $acesso_regular++;
        elseif ($row['acesso'] == 3) $acesso_otimo++;

        // Organização
        if ($row['organizacao'] == 1) $organizacao_ruim++;
        elseif ($row['organizacao'] == 2) $organizacao_regular++;
        elseif ($row['organizacao'] == 3) $organizacao_otimo++;

        // Apresentações
        if ($row['apresentacoes'] == 1) $apresentacoes_ruim++;
        elseif ($row['apresentacoes'] == 2) $apresentacoes_regular++;
        elseif ($row['apresentacoes'] == 3) $apresentacoes_otimo++;

        // Interatividade
        if ($row['interatividade'] == 1) $interatividade_sim++;
        elseif ($row['interatividade'] == 2) $interatividade_nao++;

        // Satisfação
        if ($row['satisfacao'] == 1) $satisfacao_ruim++;
        elseif ($row['satisfacao'] == 2) $satisfacao_regular++;
        elseif ($row['satisfacao'] == 3) $satisfacao_otimo++;
    }

    // Calcular os percentuais para cada opção
    $total_respostas = $result->num_rows;
    if ($total_respostas > 0) {
        // Percentuais de Acesso
        $percentual_acesso_ruim = round(($acesso_ruim / $total_respostas) * 100, 2);
        $percentual_acesso_regular = round(($acesso_regular / $total_respostas) * 100, 2);
        $percentual_acesso_otimo = round(($acesso_otimo / $total_respostas) * 100, 2);

        // Percentuais de Organização
        $percentual_organizacao_ruim = round(($organizacao_ruim / $total_respostas) * 100, 2);
        $percentual_organizacao_regular = round(($organizacao_regular / $total_respostas) * 100, 2);
        $percentual_organizacao_otimo = round(($organizacao_otimo / $total_respostas) * 100, 2);

        // Percentuais de Apresentações
        $percentual_apresentacoes_ruim = round(($apresentacoes_ruim / $total_respostas) * 100, 2);
        $percentual_apresentacoes_regular = round(($apresentacoes_regular / $total_respostas) * 100, 2);
        $percentual_apresentacoes_otimo = round(($apresentacoes_otimo / $total_respostas) * 100, 2);

        // Percentuais de Interatividade
        $percentual_interatividade_sim = round(($interatividade_sim / $total_respostas) * 100, 2);
        $percentual_interatividade_nao = round(($interatividade_nao / $total_respostas) * 100, 2);

        // Percentuais de Satisfação
        $percentual_satisfacao_ruim = round(($satisfacao_ruim / $total_respostas) * 100, 2);
        $percentual_satisfacao_regular = round(($satisfacao_regular / $total_respostas) * 100, 2);
        $percentual_satisfacao_otimo = round(($satisfacao_otimo / $total_respostas) * 100, 2);
    }
} else {
    $mensagem = "Nenhuma avaliação foi registrada ainda.";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Avaliação - Feira de Profissões IEMA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        header {
            background-color: #0056b3;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        .resultados {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .resultados h3 {
            margin-top: 0;
            font-size: 1.5rem;
            color: #0056b3;
        }
        .resultados p {
            font-size: 1.1rem;
            margin: 10px 0;
        }
        .resultados .titulo {
            font-weight: bold;
            margin-top: 10px;
            font-size: 1.2rem;
        }
        .resultados .section {
            background-color: #f1f8ff;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .resultados .tarja {
            background-color: #0056b3;
            color: white;
            font-weight: bold;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
        }
        .percentual {
            font-size: 1.2rem;
            font-weight: bold;
        }
        .bar-container {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 5px;
            height: 25px;
            margin-bottom: 10px;
        }
        .bar {
            height: 100%;
            border-radius: 5px;
        }
        .satisfeito {
            background-color: #28a745; /* Verde */
        }
        .insatisfeito {
            background-color: #dc3545; /* Vermelho */
        }
        .regular {
            background-color: #007bff; /* Azul */
        }
        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.9rem;
            color: #777;
        }
    </style>
</head>
<body>

<header>
    <h1>Relatório de Avaliação - VIII Feira de Profissões IEMA</h1>
    <p>Resultados da avaliação geral dos participantes</p>
</header>

<div class="container">
    <?php if (isset($mensagem)): ?>
        <p style="color: red;"><?= $mensagem; ?></p>
    <?php else: ?>
        <div class="resultados">
            <h3>Resultados de Avaliação</h3>

            <!-- Acesso -->
            <div class="section">
                <div class="tarja">Acesso ao Evento</div>
                <p class="percentual">Ruim: <?= $percentual_acesso_ruim ?>% (<?= $acesso_ruim ?> votos)</p>
                <div class="bar-container">
                    <div class="bar insatisfeito" style="width: <?= $percentual_acesso_ruim ?>%"></div>
                </div>
                <p class="percentual">Regular: <?= $percentual_acesso_regular ?>% (<?= $acesso_regular ?> votos)</p>
                <div class="bar-container">
                    <div class="bar regular" style="width: <?= $percentual_acesso_regular ?>%"></div>
                </div>
                <p class="percentual">Ótimo: <?= $percentual_acesso_otimo ?>% (<?= $acesso_otimo ?> votos)</p>
                <div class="bar-container">
                    <div class="bar satisfeito" style="width: <?= $percentual_acesso_otimo ?>%"></div>
                </div>
            </div>

            <!-- Organização -->
            <div class="section">
                <div class="tarja">Organização do Evento</div>
                <p class="percentual">Ruim: <?= $percentual_organizacao_ruim ?>% (<?= $organizacao_ruim ?> votos)</p>
                <div class="bar-container">
                    <div class="bar insatisfeito" style="width: <?= $percentual_organizacao_ruim ?>%"></div>
                </div>
                <p class="percentual">Regular: <?= $percentual_organizacao_regular ?>% (<?= $organizacao_regular ?> votos)</p>
                <div class="bar-container">
                    <div class="bar regular" style="width: <?= $percentual_organizacao_regular ?>%"></div>
                </div>
                <p class="percentual">Ótimo: <?= $percentual_organizacao_otimo ?>% (<?= $organizacao_otimo ?> votos)</p>
                <div class="bar-container">
                    <div class="bar satisfeito" style="width: <?= $percentual_organizacao_otimo ?>%"></div>
                </div>
            </div>

            <!-- Apresentações -->
            <div class="section">
                <div class="tarja">Qualidade das Apresentações</div>
                <p class="percentual">Ruim: <?= $percentual_apresentacoes_ruim ?>% (<?= $apresentacoes_ruim ?> votos)</p>
                <div class="bar-container">
                    <div class="bar insatisfeito" style="width: <?= $percentual_apresentacoes_ruim ?>%"></div>
                </div>
                <p class="percentual">Regular: <?= $percentual_apresentacoes_regular ?>% (<?= $apresentacoes_regular ?> votos)</p>
                <div class="bar-container">
                    <div class="bar regular" style="width: <?= $percentual_apresentacoes_regular ?>%"></div>
                </div>
                <p class="percentual">Ótimo: <?= $percentual_apresentacoes_otimo ?>% (<?= $apresentacoes_otimo ?> votos)</p>
                <div class="bar-container">
                    <div class="bar satisfeito" style="width: <?= $percentual_apresentacoes_otimo ?>%"></div>
                </div>
            </div>

            <!-- Satisfação -->
            <div class="section">
                <div class="tarja">Satisfação Geral</div>
                <p class="percentual">Ruim: <?= $percentual_satisfacao_ruim ?>% (<?= $satisfacao_ruim ?> votos)</p>
                <div class="bar-container">
                    <div class="bar insatisfeito" style="width: <?= $percentual_satisfacao_ruim ?>%"></div>
                </div>
                <p class="percentual">Regular: <?= $percentual_satisfacao_regular ?>% (<?= $satisfacao_regular ?> votos)</p>
                <div class="bar-container">
                    <div class="bar regular" style="width: <?= $percentual_satisfacao_regular ?>%"></div>
                </div>
                <p class="percentual">Ótimo: <?= $percentual_satisfacao_otimo ?>% (<?= $satisfacao_otimo ?> votos)</p>
                <div class="bar-container">
                    <div class="bar satisfeito" style="width: <?= $percentual_satisfacao_otimo ?>%"></div>
                </div>
            </div>

            <!-- Interatividade -->
            <div class="section">
                <div class="tarja">Interatividade com os Expositores</div>
                <p class="percentual">Sim: <?= $percentual_interatividade_sim ?>% (<?= $interatividade_sim ?> votos)</p>
                <div class="bar-container">
                    <div class="bar satisfeito" style="width: <?= $percentual_interatividade_sim ?>%"></div>
                </div>
                <p class="percentual">Não: <?= $percentual_interatividade_nao ?>% (<?= $interatividade_nao ?> votos)</p>
                <div class="bar-container">
                    <div class="bar insatisfeito" style="width: <?= $percentual_interatividade_nao ?>%"></div>
                </div>
            </div>

        </div>
    <?php endif; ?>
</div>

</body>
</html>
