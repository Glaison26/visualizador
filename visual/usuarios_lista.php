<?php
include("../conexao.php");

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização de Prescrições Médicas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css">



    <script scr="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script scr="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>

    <script src="https://cdn.datatables.net/2.1.5/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('.tabusuarios').DataTable({
                // 
                "iDisplayLength": -1,
                "order": [1, 'asc'],
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [6]
                }, {
                    'aTargets': [0],
                    "visible": false
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
</head>


<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navbar resposiva -->
    <nav class="bg-blue-800 p-4 shadow-lg" responsive-navbar>

        <br>
        <div class="container mx-auto flex items-center justify-between">



            <!--painel de boas vindas com data e hora e nome do usuário -->
            <!--painel de boas vindas com data e hora e nome do usuário -->
            <br>


            <div class="text-white font-bold text-xl">

                <p><strong><h2> Prefeitura Municipal de Sabará - Medicina do Trabalho</h2></strong></p>

            </div>

            <!-- User Profile -->
            <div class="relative dropdown">

                <div class="md:hidden">
                    <button class="text-white focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <div class="bg-blue-700 p-2 shadow-md">
        <p><span class="text-white hover:text-blue-200 transition flex items-center">Controle de usuários - Lista de Usuários Cadastrados</span></p>
        <!-- end subnav barra de navegação secundária com atalhos de solicitações e ordens -->

    </div>
    <br>
    <div class="container-fluid">
        <div>
            <a class="btn btn-success btn-sm" href="/gop/cadastros/usuarios/Usuarios_novo.php"> Incluir</a>
            <a class="btn btn-secondary btn-sm" href="/visualizador/menu.php"></span> Voltar</a>
        </div>
        <br>


        <table class="table table-bordered table-striped tabusuarios">
            <thead class="thead">
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Login</th>
                    <th scope="col">Tipo de acesso</th>
                    <th scope="col">Perfil</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Ativo</th>
                    <th scope="col">Opções</th>

                </tr>
            </thead>
            <tbody>
                <?php

                // faço a Leitura da tabela com sql
                $c_sql = "SELECT usuario.id, usuario.nome, usuario.login, usuario.senha,
                usuario.ativo, usuario.tipo  FROM usuario";

                $result = $conection->query($c_sql);
                // verifico se a query foi correto
                if (!$result) {
                    die("Erro ao Executar Sql!!" . $conection->connect_error);
                }

                // insiro os registro do banco de dados na tabela 
                while ($c_linha = $result->fetch_assoc()) {
                    // Coloco string sim ou não ao invés de s ou n
                    $c_ativo = $c_linha['ativo'];
                    if ($c_ativo == "S") {
                        $c_ativo = "SIM";
                    }
                    if ($c_ativo == "N") {
                        $c_ativo = "NÃO";
                    }
                    echo "
                    <tr>
                    <td>$c_linha[id]</td>
                    <td>$c_linha[nome]</td>
                    <td>$c_linha[login]</td>
                    <td>$c_linha[tipo]</td>
                    <td>$c_linha[perfil]
                    <td>$c_linha[cpf]</td>
                    <td>$c_ativo</td>
                    <td>
                    <a class='btn btn-secondary btn-sm' href='/gop/cadastros/usuarios/Usuarios_editar.php?id=$c_linha[id]'><span class='glyphicon glyphicon-pencil'></span> Editar</a>
                    
                    </td>

                    </tr>
                    ";
                }
                ?>


            </tbody>
        </table>
    </div>


</body>

</html>