<?php
session_start();

include_once 'empregador.php';
include_once 'estagiario.php';

if ($_POST['action'] == "logar") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $login = logar($email, $senha);
    if (is_string($login)) {
        echo $login;
    }
}

function logar($email, $senha) {
    $conn = connectDb();

    $empregador = loginEmpregador($conn, $email, $senha);
    $estagiario = loginEstagiario($conn, $email, $senha);

    if (is_string($empregador) && is_string($estagiario)) {
        echo $empregador;
    }

    if (!is_string($empregador)) {
        $_SESSION['logado'] = true;
        $_SESSION['empregador'] = serialize($empregador);

        header('Location: ../view/dashboardEmpregador.php');
    }

    if (!is_string($estagiario)) {
        $_SESSION['logado'] = true;
        $_SESSION['estagiario'] = serialize($estagiario);

        header('Location: ../view/dashboardEstagiario.php');
    }
}

function connectDb() {
    $conn = new mysqli("db", "root", "pass", "moet");

    if($conn->connect_error) {
        die("No connected: $conn->connect_error");
    }

    return $conn;
}

function checkIfPasswordIsCorrect($senha, $senhaEncriptada) {
    if (md5($senha) == $senhaEncriptada) {
        return true;
    }

    return false;
}