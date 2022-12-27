<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "Preencha seu email";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    }else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$$email' AND senha = 'senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL:" . $mysqli->error);
        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['user'] = $usuario['id'];

            header("location: painel.php");

        }else{
            echo "Falha ao logar! E-mail ou senha incorretos";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PORTTAL FORTPRIME</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="area-login">
        <div class="login">
            <div><img src="https://www.fortprime.com.br/assets/img/logos/logo.png" alt="">
            
         </div>
        
         <form method="POST">
            <input type="text" name="email" placeholder="email" autofocus>
            <input type="password" name="senha" placeholder="sua senha" autofocus>
            <input type="submit" value="entrar">
         </form>
         <p>problemas para entrar? <a href="https://api.whatsapp.com/send?phone=558586040928&text=n%C3%A3o%20estou%20conseguindo%20entrar%20no%20portal%20">suporte</a></p>
        </div>
    </section>
</body>
</html>