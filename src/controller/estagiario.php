<?php

include_once 'usuario.php';
include_once 'validador.php';
include_once 'utils.php';
include_once '../models/usuario.php';
include_once '../models/estagiario.php';

if ($_POST['action'] == "cadastrarEstagiario") {

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $nome = $_POST['nome'];
    $curso = $_POST['curso'];
    $anoDeIngresso = (int)$_POST['anoDeIngresso'];
    $minicurriculo = $_POST['minicurriculo'];
    
    $estagiario = new Estagiario("", $email, $senha, $nome, $curso, $anoDeIngresso, $minicurriculo, "");

    echo cadastrarEstagiario($estagiario);
}

function insertOneEstagiario($conn, $estagiario) {
  $sql = "INSERT INTO estagiarios (id, usuarioID, nome, curso, anoDeIngresso, miniCurriculo) VALUES('" . $estagiario->id . "','" . $estagiario->usuarioID . "','" . $estagiario->nome . "','"  . $estagiario->curso . "'," . $estagiario->anoDeIngresso . ",'"  . $estagiario->miniCurriculo . "')";

  $result = $conn->query($sql);

  return null;
}

function estagiarioJaExistente($conn, $estagiario) {
  $sql = "SELECT * FROM estagiarios WHERE email ='" . $email . "' LIMIT 1";

  if ($result = $conn->query($sql)) {
    while ($data = $result->fetch_object()) {
      $objects[] = $data;
    }
  }

  if($result->num_rows === 0) {
    return false;
  }

  return true;
}

function getEstagiarioPorUsuarioID($conn, $id) {
  $sql = "SELECT * FROM estagiarios WHERE usuarioID ='" . $id . "' LIMIT 1";

  if ($result = $conn->query($sql)) {
    while ($data = $result->fetch_object()) {
      $objects[] = $data;
    }
  }

  if($result->num_rows === 0) echo "No result";

  echo $result->fetch_object();

  if (checkIfPasswordIsCorrect($senha, $objects[0]->senha)) {
    return new Estagiario(objects[0]->id, objects[0]->email, "", objects[0]->nome, objects[0]->curso, objects[0]->anoDeIngresso, objects[0]->miniCurriculo, objects[0]->usuarioID);
  }

  return null;
}

function cadastrarEstagiario($estagiario) {

  $validador = validarEstagiarioParaRegistro($estagiario);
  if ($validador != null) {
    $arr = array('sucesso' => false, 'mensagem' => $validador);
    echo json_encode($arr);
    return;
  }

  $conn = connectDb();

  $usuario = new Usuario(uniqid("us_"), $estagiario->email, $estagiario->senha, "ESTAGIARIO");

  $resUsuario = cadastrarUsuario($conn, $usuario);
  if (is_string( $resUsuario) ) {
    $arr = array('sucesso' => false, 'mensagem' => $resUsuario);
    echo json_encode($arr);
    return;
  }
  
  $estagiario->usuarioID = $usuario->id;
  $estagiario->id = uniqid("es_");

  if (insertOneEstagiario($conn, $estagiario) != null) {
    $arr = array('sucesso' => false, 'mensagem' => "estagiario nao inserido");
    echo json_encode($arr);
    return;
  }

  $estagiario->senha = "";

  $arr = array('sucesso' => true);
  echo json_encode($arr);
}
?>