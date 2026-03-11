<?php // controle de acesso ao formulário
session_start();


if (!isset($_GET["id"])) {
    header('location: /visualizador/visual/setores_lista.php');
    exit;
}

$c_id = $_GET["id"];
// conexão dom o banco de dados
// conexão dom o banco de dados
include("../conexao.php");
include("../links2.php");
include('../cabec_exclusao.php');
// Exclusão do registro
// verico se elxistem recursos com o tipo no cadastro
$c_sql_conta = "select count(*) nregistros from prescricoes where id_setor=$c_id";  // relacionamnto com tabela de prescricoes
$result = $conection->query($c_sql_conta);
$registro = $result->fetch_assoc();
if ($registro['nregistros'] == 0) {
    $c_sql = "delete from setores where id=$c_id";
    $result = $conection->query($c_sql);
    header('location: /visualizador/visual/setores_lista.php');
} else {
    echo "<script>alert('Não é possivel excluir registro!')</script>";
    echo "<div class='container-fluid'>
     <a class='btn btn-primary' href='/visualizador/visual/setores_lista.php'><span class='glyphicon glyphicon-off'></span> Voltar a Lista</a>
    </div>";
}