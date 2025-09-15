<?php
// Inclui o arquivo de conexão
include('conexao.php');

// Inicializar variável de mensagem
$mensagem = '';

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coletando os dados do formulário
    $acesso = $_POST['acesso'] ?? '';
    $organizacao = $_POST['organizacao'] ?? '';
    $apresentacoes = $_POST['apresentacoes'] ?? '';
    $interatividade = $_POST['interatividade'] ?? '';
    $satisfacao = $_POST['satisfacao'] ?? '';
    $sugestoes = $_POST['sugestoes'] ?? '';

    // Verificar se o formulário foi preenchido
    if (empty($acesso) && empty($organizacao) && empty($apresentacoes) && empty($interatividade) && empty($satisfacao) && empty($sugestoes)) {
        $mensagem = "🤗 Parece que você não respondeu a nada. Que tal nos ajudar com sua avaliação? Sua opinião é muito importante!";
    } else {
        // Inserir os dados no banco de dados (mesmo que alguns campos fiquem em branco)
        $sql = "INSERT INTO respostas_feira (acesso, organizacao, apresentacoes, interatividade, satisfacao, sugestoes) 
                VALUES ('$acesso', '$organizacao', '$apresentacoes', '$interatividade', '$satisfacao', '$sugestoes')";

        if ($conn->query($sql) === TRUE) {
            $mensagem = "✅ Obrigado por sua avaliação!";
        } else {
            $mensagem = "❌ Ocorreu um erro ao salvar sua avaliação. chama o prof. Erick: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVALIAÇÃO - VIII Feira de Profissões IEMA</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        header {
            background-color: #dc3545; /* Barra vermelha */
            color: white;
            text-align: center;
            padding: 10px;
        }
        header img {
            max-width: 100px;
            height: auto;
            display: block;
            margin: 0 auto 10px auto;
        }
        .container {
            width: 98%;
            margin: 10px auto;
        }
        .question {
            background-color: #ffffff;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 0px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .question h3 {
            margin-top: 0;
        }
        .rating {
            display: flex;
            justify-content: space-between;
            font-size: 1.1rem;
            margin-top: 10px;
        }
        .rating input {
            margin-right: 10px;
            height: 30px;
            width: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .button {
            background-color: #28a745;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
            text-align: center;
            width: 100%;
        }
        .button:hover {
            background-color: #218838;
        }
        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 0.9rem;
            color: #777;
        }
        .mensagem {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .mensagem.sucesso {
            background-color: #d4edda;
            color: #155724;
        }
        .mensagem.aviso {
            background-color: #fff3cd;
            color: #856404;
        }
        .mensagem.erro {
            background-color: #f8d7da;
            color: #721c24;
        }
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical;
            min-height: 100px;
        }
        /* Estilos para os Níveis de Avaliação */
        .rating-legend {
            font-size: 14px;
            text-align: center;
            margin-top: 10px;
            font-weight: normal;
        }
        /* Estilo da Tarja */
        .tarja {
            background-color: #0056b3;
            color: white;
            font-weight: bold;
            padding: 10px;
            text-align: center;
            border-radius: 20px;
            margin-bottom: 10px;
        }
        /* Aumentar o tamanho dos campos de seleção para 'Sim' e 'Não' */
        .interatividade label {
            font-size: 1.2rem;
            margin-right: 20px;
        }
    </style>
</head>
<body>

<header>
    <!-- Logo do IEMA -->
    <img src="images/logo.png" alt="Logo IEMA">


    <h1>Avaliação - VIII Feira de Profissões IEMA</h1>
    <p>Avalie a nossa feira e nos ajude a melhorar!</p>
</header>

<div class="container">
    <?php if ($mensagem): ?>
        <?php 
            // Define a classe da mensagem (sucesso, aviso ou erro)
            $classe = strpos($mensagem, 'Parece') !== false ? 'aviso' : (strpos($mensagem, 'Obrigado') !== false ? 'sucesso' : 'erro'); 
        ?>
        <div class="mensagem <?= $classe ?>"><?= $mensagem ?></div>
    <?php endif; ?>
    
    <form action="" method="post">

        <!-- Pergunta 1: Acesso ao Evento -->
        <div class="question">
            <div class="tarja">1. Como você avaliaria o acesso ao evento?</div>
            <div class="rating">
                <label><input type="radio" name="acesso" value="1"> RUIM</label>
                <label><input type="radio" name="acesso" value="2"> REGULAR</label>
                <label><input type="radio" name="acesso" value="3"> ÓTIMO</label>
            </div>
        </div>

        <!-- Pergunta 2: Organização do Evento -->
        <div class="question">
            <div class="tarja">2. Como você avaliaria a organização do evento?</div>
            <div class="rating">
                <label><input type="radio" name="organizacao" value="1"> RUIM</label>
                <label><input type="radio" name="organizacao" value="2"> REGULAR</label>
                <label><input type="radio" name="organizacao" value="3"> ÓTIMO</label>
            </div>
        </div>

        <!-- Pergunta 3: Qualidade das Apresentações -->
        <div class="question">
            <div class="tarja">3. Como você avaliaria a qualidade das apresentações?</div>
            <div class="rating">
                <label><input type="radio" name="apresentacoes" value="1"> RUIM</label>
                <label><input type="radio" name="apresentacoes" value="2"> REGULAR</label>
                <label><input type="radio" name="apresentacoes" value="3"> ÓTIMO</label>
            </div>
        </div>

        <!-- Pergunta 4: Satisfação Geral -->
        <div class="question">
            <div class="tarja">4. Qual a sua satisfação geral com o evento?</div>
            <div class="rating">
                <label><input type="radio" name="satisfacao" value="1"> RUIM</label>
                <label><input type="radio" name="satisfacao" value="2"> REGULAR</label>
                <label><input type="radio" name="satisfacao" value="3"> ÓTIMO</label>
            </div>
        </div>

        <!-- Pergunta 5: Interatividade e Engajamento -->
        <div class="question interatividade">
            <div class="tarja">5. Você teve oportunidades de interagir com os expositores?</div>
            <label><input type="radio" name="interatividade" value="1"> Sim</label>
            <label><input type="radio" name="interatividade" value="2"> Não</label>
        </div>

        <!-- Sugestões -->
        <div class="form-group">
            <label for="sugestoes">6. Sugestões e comentários:</label>
            <textarea name="sugestoes" id="sugestoes" placeholder="Escreva suas sugestões aqui..."></textarea>
        </div>

        <button type="submit" class="button">Enviar Avaliação</button>
    </form>
</div>

<footer>
    © 2025 IEMA - Instituto Estadual de Educação, Ciência e Tecnologia do Maranhão - Chapadinha
</footer>

</body>
</html>
