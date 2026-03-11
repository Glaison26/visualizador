<?php
// controle de acesso ao formulário

//include('conexao.php');

date_default_timezone_set('America/Sao_Paulo');
$agora = date('d/m/Y H:i');
$c_data = date('Y-m-d');
$_SESSION['c_usuario'] = "Glaison Queiroz"

?>




<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização de Prescrições Médicas</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="/visualizador/css/basico.css">
    
    <style>
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
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

                 Prefeitura Municipal de Sabará - Medicina do Trabalho
            </div>
            <!-- User Profile -->
            <div class="relative dropdown">
                <button class="text-white hover:text-blue-200 transition flex items-center focus:outline-none">
                    <i class="fas fa-user-circle text-2xl"></i>
                </button>
                <div class="dropdown-menu absolute hidden bg-white text-gray-800 pt-2 shadow-xl rounded-md w-48 z-50 right-0">
                    <a class="block px-4 py-2 hover:bg-blue-100 border-b border-gray-100" href="/visualizador/alterasenha.php">Alterar Senha</a>
                    <a class="block px-4 py-2 hover:bg-blue-100 border-b border-gray-100" href="/visualizador/index.php">Sair</a>

                </div>
                <div class="md:hidden">
                    <button class="text-white focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <nav class="bg-blue-800 p-4 shadow-lg" responsive-navbar>
        <div class="container mx-auto flex items-center justify-between">
            <div class="container mx-auto mt-2 text-white">
                <p>Bem-vindo, <span class="font-bold"><?php echo $_SESSION['c_usuario']; ?></span>! Hoje é <?php echo date('d/m/Y'); ?>, <?php echo date('H:i'); ?> horas.</p>
            </div>
        </div>
    </nav>


    <!-- subnav barra de navegação secundária com atalhos de solicitações e ordens -->
    <div class="bg-blue-700 p-2 shadow-md">
        <div class="container mx-auto flex items-center space-x-4">
            <a href="/gop/solicitacao/solicitacao.php" class="text-white hover:text-blue-200 transition flex items-center">
                <i class="fas fa-file-alt mr-2"></i>Visualizar Prescrições
            </a>
            <a href="/gop/ordens/ordens.php" class="text-white hover:text-blue-200 transition flex items-center">
                <i class="fas fa-clipboard-list mr-2"></i>Incluir Prescrições
            </a>
            <a href="/visualizador/visual/usuarios_lista.php" class="text-white hover:text-blue-200 transition flex items-center">
                <i class="fa solid fa-user mr-2"></i>Controle de Usuários
            </a>


        </div>
        <!-- end subnav barra de navegação secundária com atalhos de solicitações e ordens -->

    </div>


    </main>




    <footer class="mt-20 py-6 text-center text-gray-500 text-sm">
        &copy; 2026 Sistema para Visualização de documentos. Todos os direitos reservados.
    </footer>

</body>

</html>

