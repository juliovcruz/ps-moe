<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpregadorModel extends Model {
    protected $table      = 'empregadores';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'nomeDoResponsavel', 'nomeDaEmpresa', 'descricao',
        'produtos', 'email', 'senha', 'token', 'emailConfirmado'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = true;

    public function ObtenhaPorId($id) {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM empregadores WHERE id='$id'");
        $result = $query->getResult();
        return $result[0];
    }

    public function AtualizeToken($id) {
        $db = \Config\Database::connect();
        $sql = "UPDATE empregadores set emailConfirmado = 1 WHERE id='$id'";
        $this->db->query($sql);
    }
}