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

	public function registrar() {
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
                $email = $this->request->getVar('email');
				$data = [
					'id' => $id,
					'email' => $email,
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
                    'email' => $email,
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

    public function home() {
        if(!session()->get('estagiario')) return redirect('/');

        $session = session();

        $data = ['estagiario' => $_SESSION['estagiario']];

        $empregadorModel = new \App\Models\EmpregadorModel();
        $data['empregadores'][] = $empregadorModel->ObtenhaTodos();
        $data['empregadoresSeguindo'] = $empregadorModel->ObtenhaIdsEmpregadoresSeguindo(session()->get('estagiario')->id);

        if(!session()->get('estagiario')) return redirect('/');
        $session->setFlashdata('success', 'Successful Registration');

        echo view('homeEstagiario', $data);
    }

    public function editar() {
        if(!session()->get('estagiario')) return redirect('/');

        $data = [];
        helper(['form', 'email','validate']);

        if ($this->request->getMethod() == 'post') {
            $session = session();

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[empregadores.email]',
                'senha' => 'max_length[250]',
                'confirmacaoSenha' => 'matches[senha]',
                'nome' => 'required|min_length[3]|max_length[50]',
                'curso' => 'required|min_length[3]|max_length[50]',
                'anoDeIngresso' => 'required|exact_length[4]|integer',
                'minicurriculo' => 'required|min_length[3]|max_length[250]',
                'senhaAntiga' => 'required|min_length[6]|max_length[255]'
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
                return redirect()->to('/estagiario/home');
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

	public function SalvaInteresse() {
        $estagiarioModel = new \App\Models\EstagiarioModel();
        $estagiario = session()->get('estagiario');
        $empregadoresId = $this->request->getVar('empregadores');

        $estrategia = $estagiarioModel->ObtenhaStrategy($estagiario->id);

        if(!is_null($estrategia)) {

            $estagiarioModel->DeleteInteresse($estagiario->id);

            foreach((array) $empregadoresId as $empregadorId) {
                $data = [
                    'estagiarioId' => $estagiario->id,
                    'empregadorId' => $empregadorId,
                ];

                $retorno = $estrategia->InteressarEmEmpregador($data);
            }
        }
		
		header('Content-Type: application/json');
		echo json_encode($retorno);
	}
}
