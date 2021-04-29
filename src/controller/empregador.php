<?php

function insertOneEmpregador($conn, $empregador) {
  $hashKey = getenv("DHASH_PASSWORD");

  echo "hashkey:" . $hashKey . "<br>";

  $senha = md5($empregador->senha . $hashKey);

  $sql = "INSERT INTO empregadores (email, senha, nomeDoResponsavel, nomeDaEmpresa, descricao, produtos) VALUES('" . $empregador->email . "','" . $senha . "','" . $empregador->nomeDoResponsavel . "','"  . $empregador->nomeDaEmpresa . "','" . $empregador->produtos . "')";
  echo $sql . "<br>";
  $result = $conn->query($sql);

  return $result;
}


?>