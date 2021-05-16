<?php

namespace App\Models;

use CodeIgniter\Model;

class VagaModel extends Model {
    protected $table      = 'vagas';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'empregadorID', 'titulo', 'descricao', 'listaDeAtividades',
        'listaDeHabilidadesRequeridas', 'semestreRequerido', 'quantidadeDeHoras', 'remuneracao'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = true;

    public function ObtenhaPorId($id) {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM vagas WHERE id='$id'");
        $result = $query->getResult();
        return $result[0];
    }

    public function ObtenhaTodasDeEmpregador($empregadorID){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM vagas WHERE empregadorID = '$empregadorID'");
        return $query->getResult();
    }
}

