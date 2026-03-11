<?php
session_start();


include('../conexao.php');
include('../links2.php');
include_once "../lib_gop.php";

// gravação dos dados do Usuário do sistema
$c_nome = "";
$c_login = "";
$c_senha = "";
$c_senha2 = "";
$c_tipo = "";

// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // pego o setor selecionado
    $c_sql_setor = "select * from setores where setores.descricao='$_POST[setor]'";
    $result_setor = $conection->query($c_sql_setor);
    // verifico se a query foi correto
    $c_linha_setor = $result_setor->fetch_assoc();
    $i_setor = $c_linha_setor['id'];
    $c_nome = $_POST['nome'];
    $c_login = $_POST['login'];
   
    $c_senha = $_POST['senha'];
    $c_senha2 = $_POST['senha2'];
    $c_tipo = $_POST['tipo'];
    
    if (!isset($_POST['chkativo'])) {
        $c_ativo = 'N';
    } else {
        $c_ativo = 'S';
    }

    do {
        if (empty($c_nome) || empty($c_login) || empty($c_senha)) {
            $msg_erro = "Todos os Campos devem ser preenchidos!!";
            break;
        }
        // consiste se senha igual a confirmação
        if ($c_senha != $c_senha2) {
            $msg_erro = "Senha digitada diferente da senha de confirmação!!";
            break;
        }
        $i_tamsenha = strlen($c_senha);
        if (($i_tamsenha < 8) || ($i_tamsenha > 30)) {
            $msg_erro = "Campo Senha deve ter no mínimo 8 caracteres e no máximo 30 caracteres";
            break;
        }
        // consiste se senha tem pelo menos 1 caracter numérico
        if (filter_var($c_senha, FILTER_SANITIZE_NUMBER_INT) == '') {
            $msg_erro = "Campo Senha deve ter pelo menos (1) caracter numérico";
            break;
        }
       // if (ctype_digit($c_senha)) {
       //     $msg_erro = "Campo Senha deve conter pelo menos uma letra do Alfabeto";
       //     break;
       // }
        // consistencia se já existe login cadastrado
        $c_sql = "select usuario.login from usuario where login='$c_login'";
        $result = $conection->query($c_sql);
        $registro = $result->fetch_assoc();
        if ($registro) {
            $msg_erro = "Já existe este login cadastrado!!";
            break;
        }
       
        $i_tamsenha = strlen($c_senha);
        if (($i_tamsenha < 8) || ($i_tamsenha > 30)) {
            $msg_erro = "Campo Senha deve ter no mínimo 8 caracteres e no máximo 30 caracteres";
            break;
        }
        
        // criptografo a senha digitada
        $c_senha = base64_encode($c_senha);
        // grava dados no banco

        // faço a Leitura da tabela com sql
        $c_sql = "Insert into usuario (nome,login,senha, ativo, tipo, id_setor)" .
            "Value ('$c_nome', '$c_login', '$c_senha', '$c_ativo', '$c_tipo', '$i_setor')";

        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }

        $msg_gravou = "Dados Gravados com Sucesso!!";

        header('location: /visualizador/visual/usuarios_lista.php');
    } while (false);
}
