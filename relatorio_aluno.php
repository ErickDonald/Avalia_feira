<?php
// Inclui o arquivo de conexão com o banco de dados
include('conexao.php');

// Consultar as médias das avaliações por turma
$sql = "SELECT turma, 
               AVG(clareza) AS avg_clareza, 
               AVG(conteudo) AS avg_conteudo, 
               AVG(criatividade) AS avg_criatividade, 
               AVG(comunicacao) AS avg_comunicacao, 
               AVG(engajamento) AS avg_engajamento, 
               AVG(organizacao) AS avg_organizacao 
        FROM avaliacoes_estudantes 
        GROUP BY turma";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Avaliação - VIII Feira de Profissões IEMA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
        }
        .container {
            max-width: 1200px;
            margin-top: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .table th, .table td {
            text-align: center;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .card {
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .tarja {
            background-color: #0056b3;
            color: white;
            padding: 8px;
            border-radius: 5px;
            text-align: center;
        }
        .table-bordered th, .table-bordered td {
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Relatório de Avaliação - VIII Feira de Profissões IEMA</h1>
        <p>Avaliações por Turma</p>
    </div>

    <div class="card">
        <h5 class="tarja">Médias das Avaliações por Turma</h5>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Turma</th>
                    <th>Clareza</th>
                    <th>Conteúdo</th>
                    <th>Criatividade</th>
                    <th>Comunicação</th>
                    <th>Engajamento</th>
                    <th>Organização</th>
                    <th>Nota Final</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verificando se há resultados
                if ($result->num_rows > 0) {
                    // Exibindo as médias de cada turma
                    while ($row = $result->fetch_assoc()) {
                        // Calculando a média final de 0 a 10
                        $media_final = ($row['avg_clareza'] + $row['avg_conteudo'] + $row['avg_criatividade'] + $row['avg_comunicacao'] + $row['avg_engajamento'] + $row['avg_organizacao']) / 6;
                        $nota_final = round($media_final * 2, 1); // Multiplicamos por 2 para ajustar a média de 0-5 para 0-10
                        
                        echo "<tr>
                                <td>" . $row['turma'] . "</td>
                                <td>" . round($row['avg_clareza'], 2) . "</td>
                                <td>" . round($row['avg_conteudo'], 2) . "</td>
                                <td>" . round($row['avg_criatividade'], 2) . "</td>
                                <td>" . round($row['avg_comunicacao'], 2) . "</td>
                                <td>" . round($row['avg_engajamento'], 2) . "</td>
                                <td>" . round($row['avg_organizacao'], 2) . "</td>
                                <td>" . $nota_final . "</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Nenhuma avaliação registrada</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
