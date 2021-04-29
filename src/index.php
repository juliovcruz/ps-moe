<?php

include './controller/utils.php';
include './controller/estagiario.php';
include './models/estagiario.php';

$conn = connectDb();

$estag = new Estagiario("email", "senha", "nome", "curso", 2019, "miniCurriculo");

insertOneEstagiario($conn, $estag);

echo "<br>" . $result . "<br>";

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