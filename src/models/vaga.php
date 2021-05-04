<?php

class Vaga {
    public $id;
    public $empregadorID;
    public $descricao;
    public $listaDeAtividades;
    public $listaDeHabilidadesRequeridas;
    public $semestreRequerido;
    public $quantidadeDeHoras;
    public $remuneracao;

    public function __construct($id, $empregadorID, $descricao, $listaDeAtividades, $listaDeHabilidadesRequeridas, $semestreRequerido, $quantidadeDeHoras, $remuneracao) {
        $this->id = $id;
        $this->empregadorID = $empregadorID;
        $this->descricao = $descricao;
        $this->listaDeAtividades = $listaDeAtividades;
        $this->listaDeHabilidadesRequeridas = $listaDeHabilidadesRequeridas;
        $this->semestreRequerido = $semestreRequerido;
        $this->quantidadeDeHoras = $quantidadeDeHoras;
        $this->remuneracao = $remuneracao;
        }
}

?>