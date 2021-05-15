<?php

namespace App\Models;

use CodeIgniter\Model;

class EstagiarioModel extends Model {
    protected $table = 'estagiarios';

    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'nome', 'curso', 'anoDeIngresso', 'miniCurriculo', 'email', 'senha', 'token', 'emailConfirmado'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = true;

    public function ObtenhaPorId($id) {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM estagiarios WHERE id='$id'");
        $result = $query->getResult();
        return $result[0];
    }

    public function ObtenhaPorEmail($email) {
      $db = \Config\Database::connect();
      $query = $db->query("SELECT * FROM estagiarios WHERE email='$email'");
      $result = $query->getResult();
      return $result[0];
    }

    public function AtualizeToken($id) {
      $db = \Config\Database::connect();
      $sql = "UPDATE estagiarios set emailConfirmado = 1 WHERE id='$id'";
      $this->db->query($sql);
    }

    public function senhaEstaCorreta($email, $senha) {
        $estagiario = $this->ObtenhaPorEmail($email);

        if (md5($senha) == $estagiario->senha) {
            return true;
        }

        return false;
    }
}