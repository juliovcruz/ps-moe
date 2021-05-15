<?php

namespace App\Models;

use CodeIgniter\Model;

class EstagiarioModel extends Model {
    protected $table = 'estagiarios';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'nome', 'curso', 'anoDeIngresso', 'miniCurriculo', 'email', 'senha', 'token', 'emailConfirmado'];

    protected $beforeInsert = ['beforeInsert'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = true;

    protected function beforeInsert(array $data){
        echo $data;
        $data = $this->passwordHash($data);
        return $data;
      }
    
      protected function passwordHash(array $data){
        if(isset($data['data']['senha']))
          $data['data']['senha'] = password_hash($data['data']['senha'], PASSWORD_DEFAULT);
    
        return $data;
      }
}