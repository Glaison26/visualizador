<?php // controle de acesso ao formulário
session_start();

include("../conexao.php");
include("../links2.php");


date_default_timezone_set('America/Sao_Paulo');


// rotina para montagem do sql com as opções selecionadas
if ((isset($_POST["btnpesquisa"])) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {

    header('location: /visualizacao/visual/prescricoes_lista.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/gop/css/basico.css">

</head>

<body>
    <div style="padding-top:5px;">
        <div class="panel panel-primary class">
            <div class="panel-heading text-center">
                <h4>Visualizador para Prescrições</h4>
                <h5>Incluir e pesquisar todas as Prescriçoes<h5>
            </div>
        </div>
    </div>

    <div class="content">

        <div class="container-fluid">

            <div class="container content-box">
                <div class='alert alert-info' role='alert'>
                    <div style="padding-left:15px;">
                        <img Align="left" src="\gop\images\escrita.png" alt="30" height="35">

                    </div>
                    <h5><?php $_SESSION['c_usuario'] ?>Clique em nova prescrição para incluir uma nova prescrição médica ou realize uma pesquisa no período selecionado abaixo</h5>
                </div>
                <form method="post">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <?php
                            if ($_SESSION['tipo'] == 'Administrador') {
                                echo '
                                <a class="btn btn btn-sm" href="\visualizador\visual\nova_prescricao.php"><img src="\gop\images\atestado2.png" alt="" width="30" height="30"> Nova Prescrição</a>';
                            }
                            ?>
                            <button type="submit" name='btnpesquisa' id='btnpesquisa' class="btn btn btn-sm"><img src="\gop\images\lupa.png" alt="" width="20" height="20"></span> Pesquisar</button>
                            <!--<a class="btn btn btn-sm" href="#"><img src="\gop\images\eraser.png" alt="" width="25" height="25"> Limpar pesquisa</a> -->
                            <a class="btn btn btn-sm" href="\visualizador\menu.php"><img src="\gop\images\saida.png" alt="" width="25" height="25"> Voltar</a>
                        </div>
                    </div>

                    <div class="panel panel-light class">
                        <div class="panel-heading text-center">
                            <h5><strong>Período de Consulta</strong>
                                <h5>
                        </div>
                    </div>
                    <br>
                    <div class="row mb-3">

                        <label class="col-md-2 form-label">De</label>
                        <div class="col-sm-3">
                            <input type="Date" class="form-control" name="data1" id="data1" value='<?php echo date("Y-m-d"); ?>' onkeypress="mascaraData(this)">
                        </div>
                        <label class="col-md-1 form-label">até</label>
                        <div class="col-sm-3">
                            <input type="Date" class="form-control" name="data2" id="data2" value='<?php echo date("Y-m-d"); ?>' onkeypress="mascaraData(this)">
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>



</body>

</html>