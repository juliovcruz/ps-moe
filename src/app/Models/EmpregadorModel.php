<?php

namespace App\Models;

use CodeIgniter\Model;

interface ISubject
{
    public function ObtenhaOuvintes();
    public function CadastrarOuvinte($data);
    public function DescadastrarOuvinte($data);
}

class EmpregadorModel extends Model implements ISubject { 
    protected $table = 'empregadores';

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

    public function ObtenhaOuvintes() {

    }

    public function CadastrarOuvinte($data) {

    }

    public function DescadastrarOuvinte($data) {
        
    }

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

    public function ObtenhaPorEmail($email) {
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM empregadores WHERE email='$email'");
        $result = $query->getResult();
        return $result[0];
    }

    public function senhaEstaCorreta($email, $senha) {
        $empregador = $this->ObtenhaPorEmail($email);

        if (md5($senha) == $empregador->senha) {
            return true;
        }

        return false;
    }

    public function ObtenhaTodos(){
        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM empregadores');
        return $query->getResult();
    }
}