<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}


include('../conexao.php');
include('../links2.php');
include_once "../lib_gop.php";


// variaveis para mensagens de erro e suscessso da gravação
$msg_gravou = "";
$msg_erro = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {  // metodo get para carregar dados no formulário

    if (!isset($_GET["id"])) {
        header('location: /visualizador/visual/usuarios_lista.php');
        exit;
    }

    $c_id = $_GET["id"];
    // leitura do cliente através de sql usando id passada
    $c_sql = "select * from usuario where id=$c_id";
    $result = $conection->query($c_sql);
    $registro = $result->fetch_assoc();

    if (!$registro) {
        header('location: /visualizador/visual/usuarios_lista.php');
        exit;
    }
    $i_setor = $registro['id_setor'];
    $c_nome = $registro["nome"];
    $c_login = $registro['login'];
    $c_senha = base64_decode($registro['senha']);  // senha descriptografia
    $c_ativo = $registro['ativo'];
    $c_tipo = $registro['tipo'];
    $c_senha2 = base64_decode($registro['senha']);  // senha descriptografia;
    if ($c_ativo == 'S') {
        $c_statusativo = 'checked';
    } else {
        $c_statusativo = '';
    }
    // 
    $c_cadastro = $registro['cadastro'];
    //echo $c_cadastro;
   
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/gop/css/basico.css">
    <title>Editar dados de Usuário</title>

</head>
<div class="container-fluid">

    <body>
        <div style="padding-top:5px;">
            <div class="panel panel-primary class">
                <div class="panel-heading text-center">
                    <h4>Visualizador para Prescrições</h4>
                    <h5>Editar dados do Usuário<h5>
                </div>
            </div>
        </div>

        <?php
        if (!empty($msg_erro)) {
            echo "
            <div class='alert alert-warning' role='alert'>
                <div style='padding-left:15px;'>
                    
                </div>
                <h4><img Align='left' src='\gop\images\aviso.png' alt='30' height='35'> $msg_erro</h4>
            </div>
            ";
        }
        ?>
        <div class="container content-box">
            <div class='alert alert-info' role='alert'>
                <div style="padding-left:15px;">
                    <img Align="left" src="\gop\images\escrita.png" alt="30" height="35">

                </div>
                <h5>Campos com (*) são obrigatórios. A senha do usário deve conter pelo menos 1 letra do alfabeto, 1 caracter numérico, no mínimo 8 caracteres e no máximo 30 caracteres</h5>
            </div>
            <form method="post" action="\visualizador\modelagem\usuarios_editar.php">
                <input type="hidden" name="id" value="<?php echo $c_id; ?>">
                <div class="row mb-3">
                    <div class="form-check col-sm-3">
                        <label class="form-check-label col-form-label">Usuário Ativo</label>
                        <div class="col-sm-3">
                            <input class="form-check-input" type="checkbox" value="S" name="chkativo" 
                            id="chkativo" <?php echo ($c_ativo == 'S') ? 'checked' : ''; ?>>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="permissao_cadastrar" id="permissao_cadastrar"  <?php echo ($c_cadastro == 'Sim') ? 'checked' : ''; ?>>
                            <label class="form-check-label" for="permissao_cadastrar" >
                                Cadastra Usuários
                            </label>
                        </div>

                    </div>
                </div>
                <hr>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Nome (*)</label>
                    <div class="col-sm-6">
                        <input type="text" maxlength="120" class="form-control" name="nome" value="<?php echo $c_nome; ?>" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Login (*)</label>
                    <div class="col-sm-6">
                        <input type="text" maxlength="40" class="form-control" name="login" value="<?php echo $c_login; ?>" required>
                    </div>
                </div>
                <?php
                $op1 = '';
                $op2 = '';
                $op3 = '';
                if (($c_tipo == '') || ($c_tipo == 'Operador')) {
                    $op1 = 'Selected';
                }
                if ($c_tipo == 'Solicitante') {
                    $op2 = 'Selected';
                }
                if ($c_tipo == 'Administrador') {
                    $op3 = 'Selected';
                }
                ?>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Tipo de usuário (*)</label>
                    <div class="col-sm-2">
                        <select class="form-select form-select-lg mb-3" id="tipo" name="tipo" value="<?php echo $c_tipo; ?>">

                            <option <?php echo $op2 ?>>Visualizador</option>
                            <option <?php echo $op3 ?>>Administrador</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Setor * </label>
                    <div class="col-sm-5">
                        <select class="form-select form-select-lg mb-3" id="setor" name="setor">
                            <?php
                            // select da tabela de setores
                            $c_sql_setor = "SELECT setores.id, setores.descricao FROM setores ORDER BY setores.descricao";
                            $result_setor = $conection->query($c_sql_setor);
                            while ($c_linha = $result_setor->fetch_assoc()) {
                                $op = '';
                                if ($c_linha['id'] == $i_setor) {
                                    $op = 'selected';
                                } else {
                                    $op = '';
                                }
                                echo "<option $op>$c_linha[descricao]</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Senha (*)</label>
                    <div class="col-sm-2">
                        <input type="password" maxlength="32" class="form-control" name="senha" value="<?php echo $c_senha; ?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Senha Confirmação (*)</label>
                    <div class="col-sm-2">
                        <input type="password" maxlength="32" class="form-control" name="senha2" value="<?php echo $c_senha2; ?>" required>
                    </div>
                </div>

                <hr>

                <div class="row mb-3">
                    <div class="offset-sm-0 col-sm-3">
                        <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                        <a class='btn btn-danger' href='/visualizador/visual/usuarios_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                    </div>

                </div>

            </form>
        </div>
    </body>
</div>



</html>