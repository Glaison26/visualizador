<?php
// controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}

include('conexao.php');
include_once "lib_gop.php";

$c_senhaatual = "";
$c_senhanova = "";
$c_senhaconfirma = "";

// variaveis para mensagens de erro e suscessso da gravação
$msg_erro = "";
$msg_acerto = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $c_senhaatual = $_POST['senha_atual'];
    $c_senhanova = $_POST['nova_senha'];
    $c_senhaconfirma = $_POST['confirma_nova_senha'];

    do {
        $c_login = $_SESSION['c_usuario'];
        $c_sql = "SELECT usuario.senha, usuario.id FROM usuario where usuario.login='$c_login'";
        $result = $conection->query($c_sql);
        $registro = $result->fetch_assoc();
        $c_senhaatual = base64_decode($registro['senha']);
        $i_tamsenha = strlen($c_senhanova);
        // consitencias de senha
        if ($c_senhaatual != $_POST['senha_atual']) {
            $msg_erro = "Senha Atual Inválida!!";
            break;
        }
        if (($i_tamsenha < 8) || ($i_tamsenha > 32)) {
            $msg_erro = "Campo Senha nova deve ter no mínimo 8 caracteres e no máximo 32 caracteres!!";
            break;
        }

        if ($c_senhanova != $c_senhaconfirma) {
            $msg_erro = "Campo Senha diferente de senha de confirmação!!";
            break;
        }
        // consiste se senha tem pelo menos 1 caracter numérico
        if (filter_var($c_senhanova, FILTER_SANITIZE_NUMBER_INT) == '') {
            $msg_erro = "Campo Senha deve ter pelo menos (1) caracter numérico";
            break;
        }
        if (ctype_digit($c_senhanova)) {
            $msg_erro = "Campo Senha deve conter pelo menos uma letra do Alfabeto";
            break;
        }
        // criptografo a senha digitada
        $c_senhanova = base64_encode($c_senhanova);
        // grava dados no banco
        $c_id = $registro['id'];
        // faço a Leitura da tabela com sql

        $c_sql = "Update usuario SET usuario.senha ='$c_senhanova' where id=$c_id";
        $result = $conection->query($c_sql);
        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }
        $msg_acerto = "Senha foi alterada com sucesso!!!";
        // header('location: /menu.php');
    } while (false);
}

?>



<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Alterar Senha</title>
    <style>
        form {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }

        button {
            margin-top: 20px;
            padding: 10px 20px;
        }
    </style>
</head>
<?php if (!empty($msg_acerto)): ?>
    <div style="max-width:400px;margin:20px auto;padding:15px;background:#d4edda;color:#155724;border:1px solid #c3e6cb;border-radius:5px;">
        <?php echo htmlspecialchars($msg_acerto); ?>
    </div>
<?php elseif (!empty($msg_erro)): ?>
    <div style="max-width:400px;margin:20px auto;padding:15px;background:#f8d7da;color:#721c24;border:1px solid #f5c6cb;border-radius:5px;">
        <?php echo htmlspecialchars($msg_erro); ?>
    </div>
<?php endif; ?>

<body>
    <form method="post">
        <h2>Alterar Senha</h2>
        <label for="senha_atual">Senha Atual:</label>
        <input type="password" id="senha_atual" name="senha_atual" required>

        <label for="nova_senha">Nova Senha:</label>
        <input type="password" id="nova_senha" name="nova_senha" required>

        <label for="confirma_nova_senha">Confirme a Nova Senha:</label>
        <input type="password" id="confirma_nova_senha" name="confirma_nova_senha" required>

        <button type="submit">Alterar Senha</button>
        <button type="button" onclick="window.history.back();">Cancelar</button>
        <label style="display:block;margin-top:15px;">
            <input type="checkbox" id="mostrar_senhas" onclick="mostrarSenhas()"> Mostrar senhas digitadas
        </label>
        <script>
            function mostrarSenhas() {
                var campos = [
                    document.getElementById('senha_atual'),
                    document.getElementById('nova_senha'),
                    document.getElementById('confirma_nova_senha')
                ];
                campos.forEach(function(campo) {
                    campo.type = document.getElementById('mostrar_senhas').checked ? 'text' : 'password';
                });
            }
        </script>
    </form>
</body>

</html>