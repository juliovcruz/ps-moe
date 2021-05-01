<?php

include_once 'usuario.php';
include_once 'validador.php';
include_once 'utils.php';
include_once '../models/usuario.php';
include_once '../models/empregador.php';

if ($_POST['action'] == "cadastrarEmpregador") {
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $nomeDoResponsavel = $_POST['nomeDoResponsavel'];
  $nomeDaEmpresa = $_POST['nomeDaEmpresa'];
  $produtos = processText($_POST['produtos']);
  $descricao = $_POST['descricao'];

  $empregador = new Empregador("", $email, $senha, $nomeDoResponsavel, $nomeDaEmpresa, $descricao,$produtos, "");

  $res = cadastrarEmpregador($empregador);

  if (is_string($res)) {
    echo $res;
  }
}

function processText($text) {
  $text = strip_tags($text);
  $text = trim($text);
  $text = htmlspecialchars($text);
  return $text;
}

function insertOneEmpregador($conn, $empregador) {
  $sql = "INSERT INTO empregadores (id, usuarioID, nomeDoResponsavel, nomeDaEmpresa, descricao, produtos) VALUES('$empregador->id','$empregador->usuarioID','$empregador->nomeDoResponsavel','$empregador->nomeDaEmpresa','$empregador->descricao','$empregador->produtos')";

  $result = $conn->query($sql);

  return null;
}

function cadastrarEmpregador($empregador) {
  $validador = validarEmpregadorParaRegistro($empregador);
  if ($validador != null) {
    return $validador;
  }

  $conn = connectDb();

  $usuario = new Usuario(uniqid("us_"), $empregador->email, $empregador->senha, "EMPREGADOR");

  $resUsuario = cadastrarUsuario($conn, $usuario);
  if (is_string( $resUsuario) ) {
    return $resUsuario;
  }
  
  $empregador->usuarioID = $usuario->id;
  $empregador->id = uniqid("em_");

  if (insertOneEmpregador($conn, $empregador) != null) {
    return "empregador nao inserido";
  }

  $empregador->senha = "";

  return $empregador;
}

function getEmpregadorPorUsuarioID($conn, $id) {
  $sql = "SELECT * FROM empregadores WHERE usuarioID ='$id' LIMIT 1";
  

  if ($result = $conn->query($sql)) {
    while ($data = $result->fetch_object()) {
      $objects[] = $data;
    }
  }

  if($result->num_rows === 0) echo "No result";

  echo $result->fetch_object();  

  return new Empregador($objects[0]->id, $objects[0]->email, "", $objects[0]->nome, $objects[0]->nomeDoResponsavel, $objects[0]->nomeDaEmpresa, $objects[0]->descricao, $objects[0]->produtos, $objects[0]->usuarioID);
}

?>