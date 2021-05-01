<?php
session_start();
include_once 'empregador.php';
include_once 'estagiario.php';
include_once 'validador.php';
include_once 'utils.php';
include_once '../models/usuario.php';
include_once '../models/empregador.php';

if ($_POST['action'] == "logarUsuario") {
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  $res = logarUsuario($email, $senha);

  if (is_string($res)) {
    echo $res;
  }
}

function logarUsuario($email, $senha) {
  $conn = connectDb();

  $usuario = loginUsuario($conn, $email, $senha);
  if (is_string($res)) {
    echo $res;
  }

  $res = getEntidadePorUsuarioID($conn, $usuario);

  $_SESSION['logado'] = true;
  $_SESSION['usuario_id'] = $usuario->id;
  $_SESSION['id'] = $res->id;
  
  header('Location: ../view/vagas.php');
}

function getEntidadePorUsuarioID($conn, $usuario) {
  switch ($usuario->tipo) {
    case "EMPREGADOR":
      return getEmpregadorPorUsuarioID($conn, $usuario->id);
      break; 
    case "ESTAGIARIO":
      return getEstagiarioPorUsuarioID($conn, $usuario->id);
      break;
  }
}

function insertOneUsuario($conn, $usuario) {
  $senha = md5($usuario->senha);

  $sql = "INSERT INTO usuarios (id, email, senha, tipo) VALUES('$usuario->id','$usuario->email','$senha','$usuario->tipo')";

  $result = $conn->query($sql);

  return null;
}

function usuarioJaExistente($conn, $email) {
  $sql = "SELECT * FROM usuarios WHERE email ='$email' LIMIT 1";

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

function cadastrarUsuario($conn, $usuario) {
  $validador = validarUsuarioParaCadastrar($usuario);
  if ($validador != null) {
    return $validador;
  }

  $conn = connectDb();

  if (usuarioJaExistente($conn, $usuario->email)) {
    return "usuario já existente";
  }

  if (insertOneUsuario($conn, $usuario) != null) {
    return "usuario nao inserido";
  }

  $usuario->senha = "";

  return $usuario;
}

function getIDUsuario($conn, $email) {
  $sql = "SELECT * FROM usuarios WHERE email ='" . $email . "' LIMIT 1";

  if ($result = $conn->query($sql)) {
    while ($data = $result->fetch_object()) {
      $objects[] = $data;
    }
  }

  if($result->num_rows === 0) {
    return "No result";
  }

  return $objects[0]->id;
}

function loginUsuario($conn, $email, $senha) {
  $sql = "SELECT * FROM usuarios WHERE email ='" . $email . "' LIMIT 1";

  if ($result = $conn->query($sql)) {
    while ($data = $result->fetch_object()) {
      $objects[] = $data;
    }
  }

  if($result->num_rows === 0) echo "Usuario nao existe";

  echo $result->fetch_object();

  if (checkIfPasswordIsCorrect($senha, $objects[0]->senha)) {
    return new Usuario($objects[0]->id, $objects[0]->email, "", $objects[0]->tipo);
  }

  return "Nao foi possivel logar";
}

?>