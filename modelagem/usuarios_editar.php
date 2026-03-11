    <?php
    session_start();
    include('../conexao.php');
    include('../links2.php');
    include_once "../lib_gop.php";
    // metodo post para atualizar dados
    $c_id = $_POST["id"];
    $c_nome = $_POST["nome"];
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
        if (empty($c_nome) || empty($c_login) || empty($c_senha) ) {
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
        // grava dados no banco
        // criptografo senha
        $c_senha = base64_encode($c_senha);
        // faço a Leitura da tabela com sql
        $c_sql = "Update Usuario" .
            " SET nome = '$c_nome', login ='$c_login', senha ='$c_senha', ativo='$c_ativo', tipo='$c_tipo'" .
            " where id=$c_id";

        $result = $conection->query($c_sql);

        // verifico se a query foi correto
        if (!$result) {
            die("Erro ao Executar Sql!!" . $conection->connect_error);
        }
        $msg_gravou = "Dados Gravados com Sucesso!!";
        header('location: /gop/cadastros/usuarios/usuarios_lista.php');
    } while (false);
    ?>