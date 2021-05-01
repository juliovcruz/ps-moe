<?php

  function validarEstagiarioParaRegistro($estagiario) {
    if (!tamanhoStringValido($estagiario->nome, 5, 50)) {
      return "nome invalido";
    }
    if (!tamanhoStringValido($estagiario->curso, 5, 50)) {
      return "curso invalido";
    }
    if (!is_int($estagiario->anoDeIngresso)) {
      return "anoDeIngresso invalido";
    }
    if (!tamanhoStringValido($estagiario->miniCurriculo, 5, 500)) {
      return "MiniCurriculo invalido";
    }

    return null;
  }

  function validarEmpregadorParaRegistro($empregador) {
    if (!tamanhoStringValido($empregador->nomeDoResponsavel, 5, 50)) {
      return "nomeDoResponsavel invalido";
    }
    if (!tamanhoStringValido($empregador->nomeDaEmpresa, 5, 50)) {
      return "nomeDaEmpresa invalido";
    }
    if (!tamanhoStringValido($empregador->descricao, 5, 500)) {
      return "descricao invalido";
    }
    if (!tamanhoStringValido($empregador->produtos, 5, 500)) {
      return "produtos invalido";
    }

    return null;
  }

  function validarUsuarioParaCadastrar($usuario) {
    if (!emailValido($usuario->email)) {
      return "email invalido";
    }
    if (!tamanhoStringValido($usuario->senha, 6, 25)) {
      return "senha invalida";
    }

    return null;
  }

  function emailValido($email) {
    if (!preg_match("/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,})+)$/",$email)) {
      return false;
    }

    return true;
  }

  function tamanhoStringValido($str, $min, $max) {
    if (!preg_match("/^.{" . $min ."," . $max . "}$/",$str)) {
      return false;
    }

    return true;
  }

?>