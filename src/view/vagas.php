<?php
session_start();

if( !isset($_SESSION['logado']) ){
	header('Location: login.php');
}
?>

<html>
<body>
<h1> Olá, <?php echo $_SESSION['id'] ?> ! Bem vindo à tela de vagas </h1>
</body>

</html>

