<?php

namespace App\Controllers;

use CodeIgniter\Email\Email;
use CodeIgniter\HTTP\RequestInterface;

class Estagiario extends BaseController
{
	public function index()
	{
		helper(['form', 'url']);
		return view('registrarEstagiario');
	}

	public function register() {

		$data = [];
		helper(['form', 'email']);

		if ($this->request->getMethod() == 'post') {

			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[estagiarios.email]|is_unique[empregadores.email]',
				'senha' => 'required|min_length[8]|max_length[255]',
				'confirmacaoSenha' => 'matches[senha]',
				'nome' => 'required|min_length[3]|max_length[20]',
				'curso' => 'required|min_length[3]|max_length[20]',
				'anoDeIngresso' => 'required|min_length[3]|max_length[4]',
				'minicurriculo' => 'required|min_length[3]|max_length[20]',
			];

			if (!$this->validate($rules)) 
			{
				$data['validation'] = $this->validator;
			}
			else
			{
				$nome = $this->request->getVar('nome');
				$id = md5(uniqid(rand(), true));
				$token = md5(uniqid(rand(), true));

				$data = [
					'id' => $id,
					'email' => $this->request->getVar('email'),
					'senha' => md5($this->request->getVar('senha')),
					'nome' => $nome,
					'curso' => $this->request->getVar('curso'),
					'anoDeIngresso' => (int)$this->request->getVar('anoDeIngresso'),
					'miniCurriculo' => $this->request->getVar('minicurriculo'),
					'token' => $token,
					'emailConfirmado' => false,
				];
		
				$estagiarioModel = new \App\Models\EstagiarioModel();
		
				$estagiarioModel->insert($data);
				
				$dadosEmail = [
					'id' => $id,
					'token' => $token,
					'nome' => $nome,
				];

				$session = session();
				
				if(!EnviaEmailCadastro($dadosEmail)) {
					$session->setFlashdata('erroEmail', 'Ocorreu um erro, contate nosso suporte.');
					return view('registrarEstagiario');
				}
				
				$session->setFlashdata('success', 'Registro feito com sucesso, confirme seu email para poder acessar!');				
				return redirect()->to('/login');
			}
		}
		echo view('registrarEstagiario', $data);
	}

    public function dash() {
        $session = session();

        $data = ['estagiario' => $_SESSION['estagiario']];

        $db = \Config\Database::connect();
        $query = $db->query('SELECT * FROM empregadores');
        $results = $query->getResult();

        $data['empregadores'][] = $results;

        // TODO: Empregadores que estagiario segue
        $data['empregadoresSeguindo'][] = ['TODO'];

        $session->setFlashdata('success', 'Successful Registration');

        echo view('dashEstagiario', $data);
    }

    public function ObtenhaPorEmail($email){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM estagiarios WHERE email='$email'");
        $result = $query->getResult();

        return $result[0];
    }
}
