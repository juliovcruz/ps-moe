<?php

namespace App\Models;

use CodeIgniter\Model;

interface IStrategy {
    public function habilitaInteresse($data);
}

class EngenhariaComputacaoStrategy implements IStrategy {
    public function habilitaInteresse($data) {
        $anoAtual = 2021;
        $limiteInferior = 2;
        $limiteSuperior = 4;

        $tempoCursado = $anoAtual - $data['anoDeIngresso'];

        if($tempoCursado >= $limiteInferior && $tempoCursado <= $limiteSuperior) {
            return [
                'habilitado' => true,
                'mensagem' => 'Interesses salvos com sucesso'
            ];
        }

        return [
            'habilitado' => false,
            'mensagem' => 'O aluno de Engenharia de Computação necessita de estar entre 40% e 80% do curso completo para poder selecionar empresas de interesse'
        ];
    }
}

class EngenhariaSoftwareStrategy implements IStrategy {
    public function habilitaInteresse($data) {
        $anoAtual = 2021;
        $limiteInferior = 1;
        $limiteSuperior = 4;

        $tempoCursado = $anoAtual - $data['anoDeIngresso'];

        if($tempoCursado >= $limiteInferior && $tempoCursado <= $limiteSuperior) {
            return [
                'habilitado' => true,
                'mensagem' => 'Interesses salvos com sucesso'
            ];
        }

        return [
            'habilitado' => false,
            'mensagem' => 'O aluno de Engenharia de Software necessita de estar entre 20% e 80% do curso completo para poder selecionar empresas de interesse'
        ];
    }
}

class SistemasInformacaoStrategy implements IStrategy {
    public function habilitaInteresse($data) {
        $anoAtual = 2021;
        $limiteInferior = 1;
        $limiteSuperior = 4;

        $tempoCursado = $anoAtual - $data['anoDeIngresso'];

        if($tempoCursado >= $limiteInferior && $tempoCursado <= $limiteSuperior) {
            return [
                'habilitado' => true,
                'mensagem' => 'Interesses salvos com sucesso'
            ];
        }

        return [
            'habilitado' => false,
            'mensagem' => "O aluno de Sistemas de Informação necessita de estar entre 20% e 80% do curso completo para poder selecionar empresas de interesse"
        ];
    }
}

class CursoModel extends Model {
    protected $table      = 'cursos';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'nome', 'limiteInferior', 'limiteSuperior'];

    protected $useTimestamps = false;

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = true;

    public function ObtenhaPorId($id) {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM cursos WHERE id='$id'");
        $result = $query->getResult();
        return $result[0];
    }

    public function ObtenhaPorNome($nome) {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM cursos WHERE nome='$nome'");
        $result = $query->getResult();
        return $result[0];
    }

    public function ObtenhaStrategy($cursoID) {
        $curso = $this->ObtenhaPorId($cursoID);

        if ($curso->nome == "Engenharia de Computacao") {
            return new EngenhariaComputacaoStrategy();
        }

        else if ($curso->nome == "Sistemas de Informacao"){
            return new SistemasInformacaoStrategy();
        }

        else if ($curso->nome == "Engenharia de Software") {
            return new EngenhariaSoftwareStrategy();
        }
    }
}