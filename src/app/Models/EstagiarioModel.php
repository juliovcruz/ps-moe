<?php

namespace App\Models;

use CodeIgniter\Model;

class EstagiarioModel extends Model {
    protected $table      = 'estagiarios';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'nome', 'curso', 'anoDeIngresso', 'miniCurriculo', 'email', 'senha'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = true;
}