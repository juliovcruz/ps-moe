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
		helper(['form']);

		if ($this->request->getMethod() == 'post') {

			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[estagiarios.email]',
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
					'emailConfirmado' => false
				];
		
				$estagiarioModel = new \App\Models\EstagiarioModel();
		
				$estagiarioModel->insert($data);
				
				$linkConfirmacao = base_url() . $linkConfirmacao = "/ValidarEmail?id=" . $id . "&token=" . $token;
				
				$email = \Config\Services::email();

				$config['mailType'] = 'html';
				
				$email->initialize($config);
				$email->setFrom('ufg.projetodesoftware@hotmail.com');
				$email->setTo('lucabbenetti@hotmail.com');
				
				$email->setSubject('teste4');
				$email->setMessage("<!DOCTYPE html>
				<html lang='en' dir='ltr'>
				  <head>
					<meta charset='utf-8'>
					<title></title>
				  </head>
				  <body>
					  Olá <strong>" . $nome . "!</strong> Para confimar seu registro e ter acesso ao mural de estágios, <a href=" . $linkConfirmacao . ">clique aqui</a>.
				  </body>
			  </html>");

				$email->send();
				
				$session = session();
				$session->setFlashdata('success', 'Registro feito com sucesso, confirme seu email para poder acessar!');

				if(!empty($email->printDebugger())) {
				}			
				
				return redirect()->to('/login');
			}
		}
		echo view('registrarEstagiario', $data);
	}
}
