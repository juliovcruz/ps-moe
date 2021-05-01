<?php 
include_once 'view/header.php';
?>

<?php
include './controller/utils.php';
include './controller/estagiario.php';
include './controller/validador.php';
include './controller/empregador.php';
include './controller/usuario.php';
include './models/estagiario.php';
include './models/empregador.php';

$conn = connectDb();

$estag = new Estagiario("", "email@test.com", "senha231", "Julio Cesar", "Ciencias da Computacao", 2019, "miniCurricsulo", "");
$empregador = new Empregador("", "empregador@gmail.com", "senha231", "Luca Baasdsada", "Auvo LTDA", "descricaaaao","produtooss", "");

echo cadastrarEmpregador($empregador);

//insertOneEmpregador($conn, $empregador);
//insertOneEstagiario($conn, $estag);

if ($resposta == null) {
  echo "paozinho";
}

$sql = 'SELECT * FROM estagiarios';

if ($result = $conn->query($sql)) {
  while ($data = $result->fetch_object()) {
    $estags[] = $data;
  }
}

if($result->num_rows === 0) echo "No result";

echo "RESULT SELECT: " . mysqli_num_rows($result);

echo $result->fetch_object();

foreach ($estags as $estag) {
  echo "<br>";
  echo $estag->nome . " " . $estag->id;
  echo "" . checkIfPasswordIsCorrect("senhaa", $estag->senha) . "<br>";
  echo "<br>";
}

?>

<?php 
include_once 'view/footer.php';
?>