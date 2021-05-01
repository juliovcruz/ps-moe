<?php

function insertOneUsuario($conn, $usuario) {
  $senha = md5($usuario->senha);

  $sql = "INSERT INTO usuarios (id, email, senha, tipo) VALUES('" . $usuario->id . "','" . $usuario->email . "','" . $usuario->senha . "','" . $usuario->tipo . "')";

  $result = $conn->query($sql);

  return null;
}

function usuarioJaExistente($conn, $email) {
  $sql = "SELECT * FROM usuarios WHERE email ='" . $email . "' LIMIT 1";

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

  if($result->num_rows === 0) echo "No result";

  echo $result->fetch_object();

  if (checkIfPasswordIsCorrect($senha, $objects[0]->senha)) {
    return new Usuario(objects[0]-> id, objects[0]->email, "", objects[0]->tipo);
  }

  return null;
}

?>