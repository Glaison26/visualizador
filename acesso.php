<!-- página para acesso negado -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOP - Acesso Negado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8d7da;
            color: #721c24;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            border: 2px solid #f5c6cb;
            padding: 30px;
            border-radius: 10px;
            background-color: #ffffff;
        }
        h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }
        p {
            font-size: 18px;
        }
        .btn-home {
            margin-top: 20px;
        }
        .btn-home a {
            text-decoration: none;
            color: #ffffff;
            background-color: #721c24;
            padding: 10px 20px;
            border-radius: 5px;
        }
        .btn-home a:hover {
            background-color: #501217;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Acesso Negado</h1>
        <p>Você não tem permissão para acessar esta página.</p>
        <div class="btn-home">
            <a href="menu.php">Voltar para a Página Inicial</a>
        </div>
    </div>
</body>
</html>
<?php
exit();
// fim acesso negado
?>