<?php

function insertOneEmpregador($conn, $empregador) {
  $sql = "INSERT INTO empregadores (id, usuarioID, nomeDoResponsavel, nomeDaEmpresa, descricao, produtos) VALUES('" . $empregador->id . "','" . $empregador->usuarioID . "','" . $empregador->nomeDoResponsavel . "','"  . $empregador->nomeDaEmpresa . "','"  . $empregador->descricao . "','". $empregador->produtos . "')";
  
  echo $sql . "<br>";
  
  $result = $conn->query($sql);

  return $result;
}

function cadastrarEmpregador($empregador) {
  $validador = validarEmpregadorParaRegistro($empregador);
  if ($validador != null) {
    return $validador;
  }

  $conn = connectDb();

  echo "PASSOU";

  $usuario = new Usuario(uniqid("us_"), $empregador->email, $empregador->senha, "EMPREGADOR");

  $resUsuario = cadastrarUsuario($conn, $usuario);
  if (is_string( $resUsuario) ) {
    return $resUsuario . "<br>";
  }
  
  $empregador->usuarioID = $usuario->id;
  $empregador->id = uniqid("em_");

  if (insertOneEmpregador($conn, $empregador) != null) {
    return "empregador nao inserido";
  }

  $empregador->senha = "";

  return $empregador;
}

?>