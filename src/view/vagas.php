<?php
session_start();
include_once 'header.php';

if( !isset($_SESSION['logado']) ){
	header('Location: login.php');
}
?>

<html>

<body>
    <form action="logout.php" method="POST" class="col s12 m6 push-m4" style="margin-top: 100px;">
        <div class="row">
            <h1 class="light col s6 push-m3"> Olá, <?php echo $_SESSION['id'] ?> ! Bem vindo à tela de vagas </h1>
        </div>
        <div class="row">
            <div class="col s6 push-m3">
                <button type="submit" class='btn'>Logout</button>
            </div>
        </div>
</body>

</html>

<?php 
include_once 'footer.php';
?>