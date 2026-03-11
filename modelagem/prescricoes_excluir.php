<?php
// Conexão com banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "visualizador";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Obter ID do registro via GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    
    // Buscar arquivo antes de deletar
    $sql = "SELECT caminho FROM prescricoes WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $arquivo = $row['caminho'];
        
        // Deletar arquivo se existir
        if (file_exists($arquivo)) {
            unlink($arquivo);
        }
        
        // Deletar registro do banco
        $sql_delete = "DELETE FROM prescricoes WHERE id = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $id);
        
        if ($stmt_delete->execute()) {
            echo "Registro e arquivo deletados com sucesso!";
            header("Location: /visualizador/visual/prescricoes_lista.php");
        } else {
            echo "Erro ao deletar: " . $stmt_delete->error;
        }
    } else {
        echo "Registro não encontrado!";
    }
} else {
    echo "ID não fornecido!";
}

$conn->close();
?>