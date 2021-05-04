<?php

include_once 'validador.php';
include_once 'utils.php';
include_once 'empregador.php';
include_once '../models/estagiario.php';

if ($_POST['action'] == "cadastrarEstagiario") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $nome = $_POST['nome'];
    $curso = $_POST['curso'];
    $anoDeIngresso = (int)$_POST['anoDeIngresso'];
    $minicurriculo = $_POST['minicurriculo'];
    
    $estagiario = new Estagiario("", $email, $senha, $nome, $curso, $anoDeIngresso, $minicurriculo);

    echo cadastrarEstagiario($estagiario);
}

function insertOneEstagiario($conn, $estagiario) {
    $senha = md5($estagiario->senha);

    $sql = "INSERT INTO estagiarios (id, nome, curso, anoDeIngresso, miniCurriculo, email, senha) VALUES('$estagiario->id','$estagiario->nome','$estagiario->curso',$estagiario->anoDeIngresso,'$estagiario->miniCurriculo', '$estagiario->email', '$senha')";

    if(!$conn->query($sql)) {
        return $conn->error;
    }

    return null;
}

function getEstagiarioPorEmail($conn, $email) {
    $sql = "SELECT * FROM estagiarios WHERE email ='$email' LIMIT 1";

    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $objects[] = $data;
        }
    }

    if($result->num_rows === 0) return null;

    echo $result->fetch_object();

    return new Estagiario($objects[0]->id, $objects[0]->email, "", $objects[0]->nome, $objects[0]->curso, $objects[0]->anoDeIngresso, $objects[0]->miniCurriculo);
}

function cadastrarEstagiario($estagiario) {
  $validador = validarEstagiarioParaCadastro($estagiario);
  if ($validador != null) {
    $arr = array('sucesso' => false, 'mensagem' => $validador);
    echo json_encode($arr);
    return;
  }

  $conn = connectDb();

  if (getEstagiarioPorEmail($conn, $estagiario->email) != null || getEmpregadorPorEmail($conn, $estagiario->email) != null) {
      $arr = array('sucesso' => false, 'mensagem' => "email ja cadastrado");
      echo json_encode($arr);
      return;
  }

  $estagiario->id = uniqid("es_");

  if (insertOneEstagiario($conn, $estagiario) != null) {
    $arr = array('sucesso' => false, 'mensagem' => "estagiario nao inserido");
    echo json_encode($arr);
    return;
  }

  $arr = array('sucesso' => true);
  echo json_encode($arr);
}

function loginEstagiario($conn, $email, $senha) {
    $sql = "SELECT * FROM estagiarios WHERE email ='$email' LIMIT 1";

    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $objects[] = $data;
        }
    }

    if($result->num_rows === 0) return "Cadastro nao encontrado";

    $result->fetch_object();

    if (checkIfPasswordIsCorrect($senha, $objects[0]->senha)) {
        return new Estagiario($objects[0]->id, $objects[0]->email, "", $objects[0]->nome, $objects[0]->curso, $objects[0]->anoDeIngresso, $objects[0]->miniCurriculo);
    }

    return "Nao foi possivel logar";
}