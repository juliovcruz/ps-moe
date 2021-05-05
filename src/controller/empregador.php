<?php
session_start();
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

if ($_POST['action'] == "editarEmpregador") {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $emailAtual = $_POST['emailAtual'];
    $senhaAtual = $_POST['senhaAtual'];
    $senhaNova = $_POST['senhaNova'];
    $nomeDoResponsavel = $_POST['nomeDoResponsavel'];
    $nomeDaEmpresa = $_POST['nomeDaEmpresa'];
    $produtos = $_POST['produtos'];
    $descricao = $_POST['descricao'];

    $empregador = new Empregador($id, $email, $senhaNova, $nomeDoResponsavel, $nomeDaEmpresa, $descricao, $produtos);

    editarCadastroEmpregador($empregador, $emailAtual, $senhaAtual);
}

function insertOneEmpregador($conn, $empregador) {
    $senha = md5($empregador->senha);

    $sql = "INSERT INTO empregadores (id, nomeDoResponsavel, nomeDaEmpresa, descricao, produtos, email, senha) VALUES('$empregador->id','$empregador->nomeDoResponsavel','$empregador->nomeDaEmpresa','$empregador->descricao','$empregador->produtos', '$empregador->email', '$senha')";

    if(!$conn->query($sql)) {
        return $conn->error;
    }

  return null;
}

function updateOneEmpregador($conn, $empregador) {
    $sql = "UPDATE empregadores 
    SET email = '$empregador->email', nomeDoResponsavel = '$empregador->nomeDoResponsavel', nomeDaEmpresa = '$empregador->nomeDaEmpresa', descricao = '$empregador->descricao', produtos = '$empregador->produtos'
    WHERE id = '$empregador->id'";

    if(!$conn->query($sql)) {
        return $conn->error;
    }

    return null;
}

function updateSenhaEmpregador($conn, $empregador) {
    if (!tamanhoStringValido($empregador->senha, 4, 60)) {
        return "senha invalida";
    }

    $senha = md5($empregador->senha);

    $sql = "UPDATE empregadores 
    SET senha = '$senha'
    WHERE id = '$empregador->id'";

    if(!$conn->query($sql)) {
        return $conn->error;
    }

    return null;
}


function editarCadastroEmpregador($empregador, $emailAtual, $senhaAtual) {
    $validador = validarEmpregadorParaEdicao($empregador);
    if ($validador != null) {
        $arr = array('sucesso' => false, 'mensagem' => $validador);
        echo json_encode($arr);
        return;
    }

    $conn = connectDb();

    $res = loginEmpregador($conn, $emailAtual, $senhaAtual);
    if (is_string($res)) {
        $arr = array('sucesso' => false, 'mensagem' => 'senha atual invalida');
        echo json_encode($arr);
        return;
    }

    $resUpdate = updateOneEmpregador($conn, $empregador);
    if ($resUpdate != null) {
        $arr = array('sucesso' => false, 'mensagem' => $resUpdate);
        echo json_encode($arr);
        return;
    }

    if (strlen($empregador->senha) > 4 ) {
        $resUpSenha = updateSenhaEmpregador($conn, $empregador);
        if ($resUpSenha != null) {
            $arr = array('sucesso' => false, 'mensagem' => $resUpSenha);
            echo json_encode($arr);
            return;
        }
    }

    $empregadorAtualizado = getEmpregadorPorEmail($conn, $empregador->email);

    $_SESSION['empregador'] = serialize($empregadorAtualizado);

    $arr = array('sucesso' => true);
    echo json_encode($arr);
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

    return new Empregador($objects[0]->id, $email, "", $objects[0]->nomeDoResponsavel, $objects[0]->nomeDaEmpresa, $objects[0]->descricao, $objects[0]->produtos);
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
