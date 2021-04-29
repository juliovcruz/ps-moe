<?php

// include "../models/estagiario";

function insertOneEstagiario($conn, $estagiario) {
  $hashKey = getenv("DHASH_PASSWORD");

  echo "hashkey:" . $hashKey . "<br>";

  $senha = md5($estagiario->senha . $hashKey);

  $sql = "INSERT INTO estagiarios (email, senha, nome, curso, anoDeIngresso, miniCurriculo) VALUES('" . $estagiario->email . "','" . $senha . "','" . $estagiario->nome . "','"  . $estagiario->curso . "'," . $estagiario->anoDeIngresso . ",'"  . $estagiario->miniCurriculo . "')";
  echo $sql . "<br>";
  $result = $conn->query($sql);

  return $result;
}

?>