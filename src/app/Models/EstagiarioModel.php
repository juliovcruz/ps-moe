<?php

namespace App\Models;

use CodeIgniter\Model;

interface IObserver
{
    public function Notifique($data);
}

class EstagiarioModel extends Model implements IObserver {
    protected $table = 'estagiarios';

    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['id', 'nome', 'cursoID', 'anoDeIngresso', 'miniCurriculo', 'email', 'senha', 'token', 'emailConfirmado'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = true;

    private $strategy;

    public function ObtenhaPorId($id) {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM estagiarios WHERE id='$id'");
        $result = $query->getResult();
        return $result[0];
    }

    public function Notifique($data) {
      helper('email');

      $estagiario = $this->ObtenhaPorId($data['estagiarioId']);
      EnvieEmailVaga($data['vaga'], $estagiario, $data['empregador']);
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

    public function InsertInteresse($data) {
      $db = \Config\Database::connect();
      $estagiarioId = $data['estagiarioId'];
      $empregadorId = $data['empregadorId'];

      $sql = "INSERT IGNORE INTO interesse (estagiarioId, empregadorId) VALUES ('$estagiarioId', '$empregadorId')";
      return $this->db->query($sql);
    }

    public function DeleteInteresse($estagiarioId) {
      $db = \Config\Database::connect();

      $sql = "DELETE FROM interesse WHERE estagiarioId='$estagiarioId'";
      return $this->db->query($sql);
    }

    public function ObtenhaIdsEstagiariosOuvintes($empregadorId) {
      $db = \Config\Database::connect();
      $query = $db->query("SELECT estagiarioId as id FROM interesse WHERE empregadorId='$empregadorId'");
      $results = $query->getResult();

      $arr = [];

      foreach($results as $result) {
          array_push($arr, $result->id);
      }

      return $arr;
    }

}