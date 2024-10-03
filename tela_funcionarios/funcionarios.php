<?php 
$pdo = new PDO('mysql:host=localhost;dbname=bd_treino','root','');

$sql_mostrar_funcionarios = $pdo->prepare("SELECT * FROM funcionario ORDER BY nome ASC");

$sql_mostrar_funcionarios->execute();

$info = $sql_mostrar_funcionarios->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['buscar'])){
    $pesquisa_user = $_POST['pesquisa'];
    $pesquisa = $pdo->prepare("SELECT nome FROM funcionario WHERE nome LIKE '%g%' ");
    $pesquisa->execute(array($pesquisa_user));

    $info = $pesquisa->fetch();

}

?>

<html>
<head>
    <h1>FUNCIONÁRIOS</h1>
</head>
<header>
    <form method="POST">
        <input type="text" name="pesquisa" placeholder="pesquisar">
        <input type="submit" name="buscar" value="Buscar">
    </form>
</header>
<body>
    <?php foreach ($info as $key => $value): ?>
    <tr>
    <td><?php echo $value['id'], ' | ', $value['nome']," | ", $value['cpf']," | ", "Inserir cargo"," |",$value['email']," | "," Momento do cadastro:",$value['momento_cadastro'];?></td>
        <td><?php echo"<hr>";?> </td>
    </tr>
    <?php endforeach;?>
</body>

</html>