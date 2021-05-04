<?php

function validarVagaParaCadastro($vaga) {
    if (!tamanhoStringValido($vaga->titulo, 1, 25)) {
        return "titulo invalido";
    }
    if (!tamanhoStringValido($vaga->descricao, 1, 250)) {
        return "descricao invalido";
    }
    if (!tamanhoStringValido($vaga->listaDeAtividades, 1, 250)) {
        return "listaDeAtividades invalido";
    }
    if (!tamanhoStringValido($vaga->listaDeHabilidadesRequeridas, 1, 250)) {
        return "listaDeHabilidadesRequeridas invalido";
    }
    if (!is_int($vaga->semestreRequerido)) {
        return "semestreRequerido invalido";
    }
    if (!is_int($vaga->quantidadeDeHoras)) {
        return "quantidadeDeHoras invalido";
    }
    if (!is_float($vaga->remuneracao)) {
        return "remuneracao invalido";
    }

    return null;
}

  function validarEstagiarioParaCadastro($estagiario) {
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

  function validarEmpregadorParaCadastro($empregador) {
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