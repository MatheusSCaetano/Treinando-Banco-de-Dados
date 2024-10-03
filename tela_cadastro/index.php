<?php
$pdo = new PDO('mysql:host=localhost;dbname=bd_treino', 'root', '');
$erros = [];

if (isset($_POST['enviar'])) {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    //$confirma_senha = md5($_POST['confirma_senha']);
    $momento_cadastro = date("Y-m-d H:m:s");

    $verficador = true;

    if ($senha == $_POST['confirma_senha']) {
        $verficador = true;
    }else{
        $verficador = false;
        echo "<script> alert('Senhas digitadas não são iguais!') </script>";
    }

    //fazer verificador de cpf, mas antes temos que validar o cpf no front

    if ($verficador) {
        if ($email != $_POST['confirma_email']) {

            echo "<script> alert('Endereços de e-mail não são iguais!') </script>";
        } else {
            $sqlemail = $pdo->prepare("SELECT email FROM funcionario WHERE email = ? ");

            $sqlemail->execute(array($email));

            $buscaemail = $sqlemail->fetch();
        }

        if (isset($buscaemail)) {

            echo "<script> alert('Email já cadastrado') </script>";
        } else {
            $sql = $pdo->prepare("INSERT INTO `funcionario` VALUES(null,?,?,?,?,?,null)");

            $sql->execute(array($nome, $cpf, $email, $senha, $momento_cadastro));

            echo "<script> alert('Cadastro realizado com sucesso!') </script>";
        }
    }
} //isset enviar



?>

<html>

<body>

    <h1>Cadastre-se</h1>

    <div class="formulario-cadastro">

        <form method="POST" value=''>
            <h2>Nome</h2>
            <input type="text" name="nome" placeholder="Digite seu Nome">
            <h2>CPF</h2>
            <input type="text" name="cpf" placeholder=" 000.000.000-00" required>
            <h2>Email</h2>
            <input type="email" name="email" placeholder="Email" required>
            <h2>Confirme seu Email</h2>
            <input type="email" name="confirma_email" placeholder="Confirma Email" required>
            <h2>Senha</h2>
            <input type="password" name="senha" placeholder="Senha" required>
            <h2>Confirme sua senha</h2>
            <input type="password" name="confirma_senha" placeholder="Confirme a Senha" required>
            <input type="submit" name="enviar" value="Enviar">

        </form>


    </div><!-- formulario-cadstro-->


</body>



</html>