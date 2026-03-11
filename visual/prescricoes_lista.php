<?php // controle de acesso ao formulário
session_start();
if (!isset($_SESSION['newsession'])) {
    die('Acesso não autorizado!!!');
}
include("../../conexao.php");
include("../../links.php");


date_default_timezone_set('America/Sao_Paulo');



?>
<!doctype html>
<html lang="en">


<body>
    <script language="Javascript">
        function confirmacao(id) {
            var resposta = confirm("Deseja remover esse registro?");
            if (resposta == true) {
                window.location.href = "/gop/cadastros/pop/pops_anexos_excluir.php?id=" + id;
            }
        }
    </script>

    <script language="Javascript">
        function mensagem(msg) {
            alert(msg);
        }
    </script>


    <script>
        $(document).ready(function() {
            $('.tabpops').DataTable({
                // 
                "iDisplayLength": -1,
                "order": [1, 'asc'],
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [5]
                }, {
                    'aTargets': [0],
                    "visible": true
                }],
                "oLanguage": {
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sInfoFiltered": " - filtrado de _MAX_ registros",
                    "oPaginate": {
                        "spagingType": "full_number",
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",

                        "sLast": "Último"
                    },
                    "sSearch": "Pesquisar",
                    "sLengthMenu": 'Mostrar <select>' +
                        '<option value="5">5</option>' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">Todos</option>' +
                        '</select> Registros'

                }

            });

        });
    </script>


    <div class="panel panel-primary class">
        <div class="panel-heading text-center">
            <h4>GOP - Gestão Operacional</h4>
            <h5>Lista Prescrições<h5>
        </div>
    </div>
    <br>

    <div class="container-fluid">

        <form method="post" enctype="multipart/form-data">
            <a class="btn btn-secondary btn-sm" href="/gop/cadastros/pop/pops_lista.php"><span class="glyphicon glyphicon-off"></span> Voltar</a>
            <hr>



            <table class="table table display table-bordered tabpops">
                <thead class="thead">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Data</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Arquivo</th>
                        <th scope="col">Descritivo</th>
                        <th scope="col">Setor</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // faço a Leitura da tabela com sql
                    $c_sql = "SELECT * from prescricoes order by data desc";
                    $result = $conection->query($c_sql);
                    // verifico se a query foi correto
                    if (!$result) {
                        die("Erro ao Executar Sql!!" . $conection->connect_error);
                    }

                    // insiro os registro do banco de dados na tabela 
                    while ($c_linha = $result->fetch_assoc()) {
                        $c_data =  new DateTime($c_linha['data']);
                        $c_data = $c_data->format('d-m-Y');
                        echo "
                    <tr class='info'>
                    <td>$c_linha[id]</td>
                    <td>$c_linha[descricao]</td>
                    <td>$c_linha[path]</td>
                    <td>$c_data</td>
                    <td>$c_linha[responsavel]</td>
                    
                   
                    <td>
                   
                    <a class='btn btn-primary btn-sm' href='/gop/cadastros/pop/pops_baixar.php?id=$c_linha[id]'><span class='glyphicon glyphicon-download-alt'></span> download</a>
                    <a class='btn btn-danger btn-sm' href='javascript:func()'onclick='confirmacao($c_linha[id])'><span class='glyphicon glyphicon-trash'></span> Excluir</a>
                    </td>

                    </tr>
                    ";
                    }
                    ?>
                </tbody>
            </table>
        </form>
    </div>



</body>

</html>