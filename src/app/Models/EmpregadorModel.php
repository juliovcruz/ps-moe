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

    protected function passwordHash(array $data){
        if(isset($data['data']['senha']))
            $data['data']['senha'] = password_hash($data['data']['senha'], PASSWORD_DEFAULT);

        return $data;
    }

    public function ObtenhaPorEmail($email) {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM empregadores WHERE email='$email'");
        $result = $query->getResult();
        return $result[0];
    }
}