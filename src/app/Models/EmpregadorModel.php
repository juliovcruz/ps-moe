<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpregadorModel extends Model {
    protected $table      = 'empregadores';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'nomeDoResponsavel', 'nomeDaEmpresa', 'descricao',
        'produtos', 'email', 'senha'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = true;
}