<?php
// controle de acesso ao formulário
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


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/gop/css/basico.css">
    <title>Novo Usuário</title>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#cpf").mask("999.999.999-99");
        });
    </script>

</head>

<div class="container-fluid">

    <body>
        <div style="padding-top:5px;">
            <div class="panel panel-primary class">
                <div class="panel-heading text-center">
                    <h4>Visualizador para Prescrições</h4>
                    <h5>Novo Usuário<h5>
                </div>
            </div>
        </div>

        <?php
        if (!empty($msg_erro)) {
            echo "
            <div class='alert alert-warning' role='alert'>
                <div style='padding-left:15px;'>
                    
                </div>
                <h4><img Align='left' src='\gop\images\aviso.png' alt='30' height='35'>$msg_erro</h4>
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
            <form method="post" action="\visualizador\modelagem\usuarios_novo.php">
                <div class="row mb-3">
                    <div class="form-check col-sm-3">
                        <label class="form-check-label col-form-label">Usuário Ativo</label>
                        <div class="col-sm-3">
                            <input class="form-check-input" type="checkbox" value="S" name="chkativo" id="chkativo" checked>
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
                    <div class="col-sm-3">
                        <input type="text" maxlength="40" class="form-control" name="login" value="<?php echo $c_login; ?>" required>
                    </div>

                </div>
                
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Setor </label>
                    <div class="col-sm-3">
                        <select class="form-select form-select-lg mb-3" id="setor" name="setor" required>
                            <option></option>
                            <?php
                            // select da tabela de setores
                            $c_sql_setor = "SELECT setores.id, setores.descricao FROM setores ORDER BY setores.descricao";
                            $result_setor = $conection->query($c_sql_setor);
                            while ($c_linha = $result_setor->fetch_assoc()) {
                                echo "  
                          <option>$c_linha[descricao]</option>
                        ";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Tipo de usuário </label>
                    <div class="col-sm-2">
                        <select class="form-select form-select-lg mb-3" id="tipo" name="tipo" required>
                            <option></option>
                            <option>Visualizador</option>
                            <option>Administrador</option>
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


                <?php
                if (!empty($msg_gravou)) {
                    echo "
                    <div class='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                             <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$msg_gravou</strong>

                             </div>
                        </div>     
                    </div>    
                ";
                }
                ?>
                <hr>
                <div class="row mb-3">
                    <div class="offset-sm-0 col-sm-3">
                        <button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-floppy-saved'></span> Salvar</button>
                        <a class='btn btn-danger' href='/visualizador/visual/usuarios_lista.php'><span class='glyphicon glyphicon-remove'></span> Cancelar</a>
                    </div>

                </div>
            </form>
    </body>
</div>
</div>

</html>