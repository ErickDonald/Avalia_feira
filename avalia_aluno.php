<?php
// Inclui o arquivo de conexão com o banco de dados
include('conexao.php');

// Processar o envio da avaliação
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coletando dados do formulário
    $avaliador = $_POST['avaliador'];
    $tema = $_POST['tema'];
    $turma = $_POST['turma'];

    // Coletando as notas de cada critério
    $clareza = $_POST['clareza'];
    $conteudo = $_POST['conteudo'];
    $criatividade = $_POST['criatividade'];
    $comunicacao = $_POST['comunicacao'];
    $engajamento = $_POST['engajamento'];
    $organizacao = $_POST['organizacao'];

    // Inserir os dados no banco de dados
    $sql = "INSERT INTO avaliacoes_estudantes (avaliador, tema, turma, clareza, conteudo, criatividade, comunicacao, engajamento, organizacao)
            VALUES ('$avaliador', '$tema', '$turma', $clareza, $conteudo, $criatividade, $comunicacao, $engajamento, $organizacao)";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Avaliação enviada com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao enviar avaliação: " . $conn->error . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avaliação de Estudantes - VIII Feira de Profissões IEMA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet"> <!-- For slider icons -->
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
        }
        .container {
            max-width: 1000px;
            margin-top: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-submit {
            width: 100%;
            background-color: #28a745; /* Cor verde */
            color: white;
            font-size: 18px; /* Fonte aumentada */
            padding: 15px;
            border-radius: 10px;
            border: none;
        }
        .btn-submit:hover {
            background-color: #218838; /* Cor verde mais escura ao passar o mouse */
        }
        .criteria-table {
            margin-top: 30px;
        }
        .criteria-table th, .criteria-table td {
            padding: 10px;
            text-align: center;
        }
        .criteria-table th {
            background-color: #f2f2f2;
        }
        .card {
            border-radius: 10px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .slider-container {
            margin-top: 10px;
        }
        .slider {
            -webkit-appearance: none;
            width: 100%;
            height: 8px; /* Diminuindo a altura da barra */
            background: #ddd;
            border-radius: 5px;
            outline: none;
            transition: background 0.3s ease;
        }
        .slider:hover {
            background: #aaa;
        }
        .slider-value {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
        }
        .slider-text {
            font-weight: bold;
        }
        .slider-text span {
            color: #28a745;
        }
        .slider-value span {
            font-size: 14px;
        }
        .form-control {
            border-radius: 10px;
        }
        .select-turma {
            border-radius: 10px;
        }
        .tarja {
            background-color: #0056b3;
            color: white;
            padding: 8px;
            border-radius: 5px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>VIII Feira de Profissões IEMA</h1>
        <p>Avaliação de Projetos</p>
    </div>

    <form action="avalia_aluno.php" method="post">
        <!-- Nome do Avaliador (Agora em primeiro lugar) -->
        <div class="form-group">
            <label for="avaliador">Nome do Avaliador:</label>
            <input type="text" class="form-control" id="avaliador" name="avaliador" required>
        </div>

        <!-- Tema do Projeto -->
        <div class="form-group">
            <label for="tema">Tema do Projeto:</label>
            <input type="text" class="form-control" id="tema" name="tema" required>
        </div>

        <!-- Turma -->
        <div class="form-group">
            <label for="turma">Selecione a Turma:</label>
            <select class="form-control select-turma" id="turma" name="turma" required>
                <option value="Turma 101">Turma 101</option>
                <option value="Turma 102">Turma 102</option>
                <option value="Turma 103">Turma 103</option>
                <option value="Turma 104">Turma 104</option>
                <option value="Turma 201">Turma 201</option>
                <option value="Turma 202">Turma 202</option>
                <option value="Turma 203">Turma 203</option>
                <option value="Turma 204">Turma 204</option>
                <option value="Turma 301">Turma 301</option>
                <option value="Turma 302">Turma 302</option>
                <option value="Turma 303">Turma 303</option>
                <option value="Turma 304">Turma 304</option>
                <option value="Robótica">Robótica</option>
            </select>
        </div>

        <!-- Critérios de Avaliação -->
        <div class="card">
            <div class="tarja">Clareza e Coerência da Apresentação</div>
            <div class="slider-container">
                <input type="range" min="1" max="5" value="3" class="slider" id="clareza" name="clareza">
                <div class="slider-value">
                    <span class="slider-text">1</span>
                    <span class="slider-text">2</span>
                    <span class="slider-text">3</span>
                    <span class="slider-text">4</span>
                    <span class="slider-text">5</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="tarja">Conteúdo Técnico e Relevância</div>
            <div class="slider-container">
                <input type="range" min="1" max="5" value="3" class="slider" id="conteudo" name="conteudo">
                <div class="slider-value">
                    <span class="slider-text">1</span>
                    <span class="slider-text">2</span>
                    <span class="slider-text">3</span>
                    <span class="slider-text">4</span>
                    <span class="slider-text">5</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="tarja">Criatividade e Inovação</div>
            <div class="slider-container">
                <input type="range" min="1" max="5" value="3" class="slider" id="criatividade" name="criatividade">
                <div class="slider-value">
                    <span class="slider-text">1</span>
                    <span class="slider-text">2</span>
                    <span class="slider-text">3</span>
                    <span class="slider-text">4</span>
                    <span class="slider-text">5</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="tarja">Habilidade de Comunicação</div>
            <div class="slider-container">
                <input type="range" min="1" max="5" value="3" class="slider" id="comunicacao" name="comunicacao">
                <div class="slider-value">
                    <span class="slider-text">1</span>
                    <span class="slider-text">2</span>
                    <span class="slider-text">3</span>
                    <span class="slider-text">4</span>
                    <span class="slider-text">5</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="tarja">Interatividade e Engajamento</div>
            <div class="slider-container">
                <input type="range" min="1" max="5" value="3" class="slider" id="engajamento" name="engajamento">
                <div class="slider-value">
                    <span class="slider-text">1</span>
                    <span class="slider-text">2</span>
                    <span class="slider-text">3</span>
                    <span class="slider-text">4</span>
                    <span class="slider-text">5</span>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="tarja">Organização do Estande</div>
            <div class="slider-container">
                <input type="range" min="1" max="5" value="3" class="slider" id="organizacao" name="organizacao">
                <div class="slider-value">
                    <span class="slider-text">1</span>
                    <span class="slider-text">2</span>
                    <span class="slider-text">3</span>
                    <span class="slider-text">4</span>
                    <span class="slider-text">5</span>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-submit">Enviar Avaliação</button>
    </form>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>
