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

if ($_POST['action'] == "editarEstagiario") {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $emailAtual = $_POST['emailAtual'];
    $senhaAtual = $_POST['senhaAtual'];
    $senhaNova = $_POST['senhaNova'];
    $nome = $_POST['nome'];
    $curso = $_POST['curso'];
    $anoDeIngresso = (int)$_POST['anoDeIngresso'];
    $minicurriculo = $_POST['minicurriculo'];

    $estagiario = new Estagiario($id, $email, $senhaNova, $nome, $curso, $anoDeIngresso, $minicurriculo);

    editarCadastroEstagiario($estagiario, $emailAtual, $senhaAtual);
}

function updateOneEstagiario($conn, $estagiario) {
    $sql = "UPDATE estagiarios 
    SET email = '$estagiario->email', nome = '$estagiario->nome', curso = '$estagiario->curso', anoDeIngresso = '$estagiario->anoDeIngresso', miniCurriculo = '$estagiario->miniCurriculo'
    WHERE id = '$estagiario->id'";

    if(!$conn->query($sql)) {
        return $conn->error;
    }

    return null;
}

function updateSenhaEstagiario($conn, $estagiario) {
    if (!tamanhoStringValido($estagiario->senha, 4, 60)) {
        return "senha invalida";
    }

    $senha = md5($estagiario->senha);

    $sql = "UPDATE estagiarios 
    SET senha = '$senha'
    WHERE id = '$estagiario->id'";

    if(!$conn->query($sql)) {
        return $conn->error;
    }

    return null;
}


function editarCadastroEstagiario($estagiario, $emailAtual, $senhaAtual) {
    $validador = validarEstagiarioParaEdicao($estagiario);
    if ($validador != null) {
        $arr = array('sucesso' => false, 'mensagem' => $validador);
        echo json_encode($arr);
        return;
    }

    $conn = connectDb();

    $res = loginEstagiario($conn, $emailAtual, $senhaAtual);
    if (is_string($res)) {
        $arr = array('sucesso' => false, 'mensagem' => 'senha atual invalida');
        echo json_encode($arr);
        return;
    }

    $resUpdate = updateOneEstagiario($conn, $estagiario);
    if ($resUpdate != null) {
        $arr = array('sucesso' => false, 'mensagem' => $resUpdate);
        echo json_encode($arr);
        return;
    }

    if (strlen($estagiario->senha) > 4 ) {
        $resUpSenha = updateSenhaEstagiario($conn, $estagiario);
        if ($resUpSenha != null) {
            $arr = array('sucesso' => false, 'mensagem' => $resUpSenha);
            echo json_encode($arr);
            return;
        }
    }

    $estagiarioAtualizado = getEstagiarioPorEmail($conn, $estagiario->email);

    $_SESSION['estagiario'] = serialize($estagiarioAtualizado);

    $arr = array('sucesso' => true);
    echo json_encode($arr);
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