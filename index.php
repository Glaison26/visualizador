<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $l_erro = '';
} else {
    session_start();
    include("conexao.php");
    $_SESSION['local'] = "localhost";
    $_SESSION['usuario'] = "root";
    $_SESSION['senha'] = "";
    $_SESSION['banco'] = "";

    $c_login = $_POST['login'];
    $c_sql = "SELECT count(*) as achou FROM usuario where usuario.login='$c_login'";
    $result = $conection->query($c_sql);
    // verifico se a query foi correto
    if (!$result) {
        die("Erro ao Executar Sql !!" . $conection->connect_error);
    }
    $c_linha = $result->fetch_assoc();
    // if ($c_login == 'Glaison') {
    //     $_SESSION["newsession"] = "gop";
    //     $_SESSION["id_usuario"] = 16;

    //     $_SESSION['c_usuario'] = $c_login;
    //     $_SESSION['tipo'] = 'Administrador';
    //    header('location: /visualizador/menu.php');
    //}
    if ($c_linha['achou'] == 0) {
        $l_erro = ' Nome ou senha inválido. Tente novamente!';
    } else {
        // procuro senha
        $c_sql = "SELECT usuario.id,usuario.senha, usuario.tipo FROM usuario where usuario.login='$c_login'";
        $result = $conection->query($c_sql);
        $registro = $result->fetch_assoc();
        $c_senha = base64_decode($registro['senha']);
        if ($c_senha != $_POST['senha']) {
            $l_erro = 'Nome ou senha inválido, Verifique e tente novamente !!!';
        } else {
            $l_erro = ' ';
            $_SESSION["newsession"] = "gop";
            $_SESSION["id_usuario"] = $registro['id'];
            $_SESSION['c_usuario'] = $c_login;
            $_SESSION['tipo'] = $registro['tipo'];
            header('location: /visualizador/menu.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>gop - Gestão de Serviços</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


</head>
<div class="clearfix" style="display:none"></div>

<body>


    <div class="login-container">
        <?php
        if (!empty($l_erro)) {
            echo "
              <div class='alert alert-warning' role='alert'>
              <h5>$l_erro</h5>
              </div>
            ";
        }
        ?>

        <form method="post" action="index.php">

            <div class="panel panel-primary class">
                <div class="panel-heading text-center">
                    <h5>Dados para acesso </h5>
                </div>
            </div>


            <div class="form-group row" class="form-control">
                <label class="col-sm-3 col-form-label">Login</label>
                <div class="col-xs-12">
                    <input type="text" maxlength="40" class="form-control" name="login" placeholder="Digite o login" required>
                </div>
            </div>
            <div class="form-group row" class="form-control">
                <label class="col-sm-3 col-form-label">Senha</label>
                <div class="col-xs-12">
                    <input type="password" maxlength="32" class="form-control" id="senha" name="senha" placeholder="Entre com a senha" required>
                </div>
            </div>
            <br>
            <input type="checkbox" class="form-check-input" onclick="mostrarSenha()"> Mostrar Senha
            <script>
                function mostrarSenha() {
                    var x = document.getElementById("senha");
                    if (x.type === "password") {
                        x.type = "text";
                    } else {
                        x.type = "password";
                    }
                }
            </script>
            <br><br>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3">
                    <button name="btnentra" type="submit" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-log-in'></span> Fazer login</button>
                </div>
            </div>

        </form>
    </div>




</body>

</html>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .login-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .login-container h2 {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }