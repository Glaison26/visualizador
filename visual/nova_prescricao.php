<?php
session_start();
include('../conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = $_POST['data'];
    $hora = $_POST['hora'];
    $descritivo = $_POST['descritivo'];
    $setor = $_POST['setor'];

    if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0) {
        $arquivo = $_FILES['arquivo'];
        $nome_arquivo = basename($arquivo['name']);
        $pasta_destino = '../uploads/';

        if (!is_dir($pasta_destino)) {
            mkdir($pasta_destino, 0755, true);
        }

        $caminho_arquivo = $pasta_destino . $nome_arquivo;

        if (move_uploaded_file($arquivo['tmp_name'], $caminho_arquivo)) {
            $sql = "INSERT INTO prescricoes (data, hora, descritivo, id_setor, caminho) 
                    VALUES (?, ?, ?, ?, ?)";

            $stmt = $conection->prepare($sql);
            $stmt->bind_param("sssss", $data, $hora, $descritivo, $setor, $caminho_arquivo);

            if ($stmt->execute()) {
                echo "<script>alert('Prescrição gravada com sucesso!'); window.location.href = 'nova_prescricao.php';</script>";
            } else {
                echo "<script>alert('Erro ao gravar prescrição!');</script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Erro ao fazer upload do arquivo!');</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Prescrição</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        input[type="text"],
        input[type="date"],
        input[type="time"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input[type="file"] {
            padding: 8px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Nova Prescrição</h1>
        <form method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label for="data">Data:</label>
                <input type="date" id="data" name="data" required>
            </div>

            <div class="form-group">
                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="hora" required>
            </div>

            <div class="form-group">
                <label for="descritivo">Descritivo:</label>
                <textarea id="descritivo" name="descritivo" required></textarea>
            </div>

            <div class="form-group">
                <label for="setor">Setor:</label>
                <select id="setor" name="setor" required>
                    <option></option>
                    <?php
                    // select da tabela de setores
                    $c_sql_setor = "SELECT setores.id, setores.descricao FROM setores ORDER BY setores.descricao";
                    $result_setor = $conection->query($c_sql_setor);

                    while ($c_linha = $result_setor->fetch_assoc()) {
                        echo "  
                        <option value='{$c_linha['id']}'>{$c_linha['descricao']}</option>
                        ";
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="arquivo">Selecionar PDF:</label>
                <input type="file" id="arquivo" name="arquivo" accept=".pdf" required>
            </div>


            <button type="submit">Enviar</button>
        <button type="button" style="background-color: #f44336; margin-top: 10px;" onclick="window.history.back();">Voltar</button>
        </form>
    </div>
</body>

</html>