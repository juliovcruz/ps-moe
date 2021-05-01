<?php

function insertOneEstagiario($conn, $estagiario) {
  $senha = md5($estagiario->senha);

  $sql = "INSERT INTO estagiarios (email, senha, nome, curso, anoDeIngresso, miniCurriculo) VALUES('" . $estagiario->email . "','" . $senha . "','" . $estagiario->nome . "','"  . $estagiario->curso . "'," . $estagiario->anoDeIngresso . ",'"  . $estagiario->miniCurriculo . "')";
  echo $sql . "<br>";
  $result = $conn->query($sql);

  return $result;
}

?>