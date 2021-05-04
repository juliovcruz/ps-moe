<?php

include_once 'validador.php';
include_once 'estagiario.php';
include_once 'utils.php';
include_once '../models/empregador.php';

if ($_POST['action'] == "cadastrarEmpregador") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $nomeDoResponsavel = $_POST['nomeDoResponsavel'];
    $nomeDaEmpresa = $_POST['nomeDaEmpresa'];
    $produtos = $_POST['produtos'];
    $descricao = $_POST['descricao'];

    $empregador = new Empregador("", $email, $senha, $nomeDoResponsavel, $nomeDaEmpresa, $descricao, $produtos);

    cadastrarEmpregador($empregador);
}

function insertOneEmpregador($conn, $empregador) {
    $senha = md5($empregador->senha);

    $sql = "INSERT INTO empregadores (id, nomeDoResponsavel, nomeDaEmpresa, descricao, produtos, email, senha) VALUES('$empregador->id','$empregador->nomeDoResponsavel','$empregador->nomeDaEmpresa','$empregador->descricao','$empregador->produtos', '$empregador->email', '$senha')";

    if(!$conn->query($sql)) {
        return $conn->error;
    }

  return null;
}

function cadastrarEmpregador($empregador) {
    $validador = validarEmpregadorParaCadastro($empregador);
    if ($validador != null) {
        $arr = array('sucesso' => false, 'mensagem' => $validador);
        echo json_encode($arr);
        return;
    }

    $conn = connectDb();

    if (getEstagiarioPorEmail($conn, $empregador->email) != null || getEmpregadorPorEmail($conn, $empregador->email) != null) {
        $arr = array('sucesso' => false, 'mensagem' => "email ja cadastrado");
        echo json_encode($arr);
        return;
    }


    $empregador->id = uniqid("em_");

    if (insertOneEmpregador($conn, $empregador) != null) {
        $arr = array('sucesso' => false, 'mensagem' => "empregador nao inserido");
        echo json_encode($arr);
        return;
    }

    $arr = array('sucesso' => true);
    echo json_encode($arr);
}

function getEmpregadorPorEmail($conn, $email) {
    $sql = "SELECT * FROM empregadores WHERE email ='$email' LIMIT 1";
    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
          $objects[] = $data;
        }
    }

    if($result->num_rows === 0) return null;

    $result->fetch_object();

    return new Empregador($objects[0]->id, "", "", $objects[0]->nome, $objects[0]->nomeDoResponsavel, $objects[0]->nomeDaEmpresa, $objects[0]->descricao, $objects[0]->produtos);
}

function loginEmpregador($conn, $email, $senha) {
    $sql = "SELECT * FROM empregadores WHERE email ='$email' LIMIT 1";

    if ($result = $conn->query($sql)) {
        while ($data = $result->fetch_object()) {
            $objects[] = $data;
        }
    }

    if($result->num_rows === 0) return "Cadastro nao encontrado";

    $result->fetch_object();

    if (checkIfPasswordIsCorrect($senha, $objects[0]->senha)) {
        return new Empregador($objects[0]->id, $objects[0]->email, "", $objects[0]->nomeDoResponsavel, $objects[0]->nomeDaEmpresa, $objects[0]->descricao, $objects[0]->produtos);
    }

    return "Nao foi possivel logar";
}

?>