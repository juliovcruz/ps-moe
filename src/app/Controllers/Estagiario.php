<?php

namespace App\Controllers;

use App\Models\EstagiarioModel;
use CodeIgniter\Email\Email;
use CodeIgniter\HTTP\RequestInterface;
use function Sodium\add;

class Estagiario extends BaseController
{
	public function index()
	{
		helper(['form', 'url']);
		return view('registrarEstagiario');
	}

	public function register() {
		$data = [];
		helper(['form', 'email','validate']);

		if ($this->request->getMethod() == 'post') {

			$rules = [
				'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[estagiarios.email]|is_unique[empregadores.email]',
				'senha' => 'required|min_length[6]|max_length[250]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/]',
				'confirmacaoSenha' => 'matches[senha]',
				'nome' => 'required|min_length[3]|max_length[50]',
				'curso' => 'required|min_length[3]|max_length[50]',
				'anoDeIngresso' => 'required|exact_length[4]|integer',
				'minicurriculo' => 'required|min_length[3]|max_length[250]',
			];

            if (!$this->validate($rules, getErrorMessages())) {
                $data['validation'] = $this->validator->setRules($rules, getErrorMessages());
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

        $empregadorModel = new \App\Models\EmpregadorModel();
        $data['empregadores'][] = $empregadorModel->ObtenhaTodos();

        // TODO: Empregadores que estagiario segue
        $data['empregadoresSeguindo'][] = ['TODO'];

        if(!session()->get('estagiario')) return redirect('/');
        $session->setFlashdata('success', 'Successful Registration');

        echo view('dashEstagiario', $data);
    }

    public function editar() {
        if(!session()->get('estagiario')) return redirect('/');

        $data = [];
        helper(['form', 'email','validate']);

        if ($this->request->getMethod() == 'post') {
            $session = session();

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[estagiarios.email]|is_unique[empregadores.email]',
                'senha' => 'required|min_length[6]|max_length[250]',
                'confirmacaoSenha' => 'matches[senha]',
                'nome' => 'required|min_length[3]|max_length[50]',
                'curso' => 'required|min_length[3]|max_length[50]',
                'anoDeIngresso' => 'required|exact_length[4]|integer',
                'minicurriculo' => 'required|min_length[3]|max_length[250]',
                'senhaAntiga' => 'required|min_length[8]|max_length[255]'
            ];
            if (!$this->validate($rules, getErrorMessages())) {
                $data['validation'] = $this->validator->setRules($rules, getErrorMessages());
            } else {
                $estagiario = session()->get('estagiario');
                $senhaAntiga = $this->request->getVar('senhaAntiga');

                $data = [
                    'email' => $this->request->getVar('email'),
                    'nome' => $this->request->getVar('nome'),
                    'curso' => $this->request->getVar('curso'),
                    'anoDeIngresso' => (int)$this->request->getVar('anoDeIngresso'),
                    'miniCurriculo' => $this->request->getVar('minicurriculo'),
                ];

                if(strlen($this->request->getVar('senha')) >= 6 ) {
                    $data['senha'] = md5($this->request->getVar('senha'));
                }

                $estagiarioModel = new \App\Models\EstagiarioModel();

                if (!$estagiarioModel->senhaEstaCorreta($estagiario->email, $senhaAntiga)) {
                    $session->setFlashdata('erro', 'Senha incorreta!');

                    return redirect()->to('/estagiario/editar');
                }

                $estagiarioModel->update($estagiario->id, $data);

                $session->setFlashdata('success', 'Cadastro alterado com sucesso!');
                return redirect()->to('/estagiario/dash');
            }
        }
        echo view('editarEstagiario', $data);
    }

    public function ObtenhaPorEmail($email){
        $db = \Config\Database::connect();
        $query = $db->query("SELECT * FROM estagiarios WHERE email='$email'");
        $result = $query->getResult();

        return $result[0];
    }
}
