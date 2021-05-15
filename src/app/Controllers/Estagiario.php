<?php

namespace App\Controllers;

class Estagiario extends BaseController
{
	public function index()
	{
		helper(['form']);
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
				$data = [
					'id' => md5(uniqid(rand(), true)),
					'email' => $this->request->getVar('email'),
					'senha' => md5($this->request->getVar('senha')),
					'nome' => $this->request->getVar('nome'),
					'curso' => $this->request->getVar('curso'),
					'anoDeIngresso' => (int)$this->request->getVar('anoDeIngresso'),
					'miniCurriculo' => $this->request->getVar('minicurriculo'),
					'token' => md5(uniqid(rand(), true)),
					'emailConfirmado' => false
				];
		
				$estagiarioModel = new \App\Models\EstagiarioModel();
		
				$estagiarioModel->insert($data);
				$session = session();
				$session->setFlashdata('success', 'Successful Registration');
				return redirect()->to('/login');

			}
		}
		echo view('registrarEstagiario', $data);
	}
}
