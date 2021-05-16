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
		helper(['form', 'email']);

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
            $errorMessages = [
                'email' => [
                    'required' => 'É necessário fornecer um email',
                    'min_length' => 'O email deve ter ao menos 6 caracteres',
                    'max_length' => 'O email deve ter no máximo 50 caracteres',
                    'valid_email' => 'O email deve ser válido',
                    'is_unique' => 'Já existe um cadastro com este email'
                ],
                'senha' => [
                    'required' => 'É necessário fornecer uma senha',
                    'min_length' => 'O email deve ter ao menos 6 caracteres',
                    'max_length' => 'A senha deve ter no máximo 250 caracteres',
                    'regex_match' => 'A senha precisa ter ao menos uma letra minúscula, uma letra maisculua e um caracter especial'
                ],
                'confirmacaoSenha' => [
                    'matches' => 'A confirmação de senha deve ser igual a senha'
                ],
                'nome' => [
                    'required' => 'É necessário fornecer o nome',
                    'min_length' => 'O nome deve ter ao menos 3 caracteres',
                    'max_length' => 'O nome deve ter no máximo 50 caracteres'
                ],
                'curso' => [
                    'required' => 'É necessário fornecer o curso',
                    'min_length' => 'O curso deve ter ao menos 3 caracteres',
                    'max_length' => 'O curso deve ter no máximo 50 caracteres'
                ],
                'anoDeIngresso' => [
                    'required' => 'É necessário fornecer o ano de ingresso',
                    'exact_length' => 'O ano de ingresso deve ter exatamente 4 caracteres',
                    'integer' => 'O ano de ingresso deve ser um número inteiro'
                ],
                'minicurriculo' => [
                    'required' => 'É necessário fornecer o mini currículo',
                    'min_length' => 'O mini currículo devem ter ao menos 3 caracteres',
                    'max_length' => 'O mini currículo devem ter no máximo 250 caracteres'
                ],
            ];

            if (!$this->validate($rules, $errorMessages)) {
                $data['validation'] = $this->validator->setRules($rules, $errorMessages);
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
        $data['empregadoresSeguindo'] = $empregadorModel->ObtenhaIdsEmpregadoresSeguindo(session()->get('estagiario')->id);

        if(!session()->get('estagiario')) return redirect('/');
        $session->setFlashdata('success', 'Successful Registration');

        echo view('dashEstagiario', $data);
    }

    public function editar() {
        if(!session()->get('estagiario')) return redirect('/');

        $data = [];
        helper(['form', 'email']);

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
            $errorMessages = [
                'email' => [
                    'required' => 'É necessário fornecer um email',
                    'min_length' => 'O email deve ter ao menos 6 caracteres',
                    'max_length' => 'O email deve ter no máximo 50 caracteres',
                    'valid_email' => 'O email deve ser válido',
                    'is_unique' => 'Já existe um cadastro com este email'
                ],
                'senha' => [
                    'min_length' => 'O email deve ter ao menos 6 caracteres',
                    'max_length' => 'A senha deve ter no máximo 250 caracteres',
                ],
                'confirmacaoSenha' => [
                    'matches' => 'A confirmação de senha deve ser igual a senha'
                ],
                'nome' => [
                    'required' => 'É necessário fornecer o nome',
                    'min_length' => 'O nome deve ter ao menos 3 caracteres',
                    'max_length' => 'O nome deve ter no máximo 50 caracteres'
                ],
                'curso' => [
                    'required' => 'É necessário fornecer o curso',
                    'min_length' => 'O curso deve ter ao menos 3 caracteres',
                    'max_length' => 'O curso deve ter no máximo 50 caracteres'
                ],
                'anoDeIngresso' => [
                    'required' => 'É necessário fornecer o ano de ingresso',
                    'exact_length' => 'O ano de ingresso deve ter exatamente 4 caracteres',
                    'integer' => 'O ano de ingresso deve ser um número inteiro'
                ],
                'minicurriculo' => [
                    'required' => 'É necessário fornecer o mini currículo',
                    'min_length' => 'O mini currículo devem ter ao menos 3 caracteres',
                    'max_length' => 'O mini currículo devem ter no máximo 250 caracteres'
                ],
                'senhaAntiga' => [
                    'required' => 'É necessário fornecer a senha atual',
                ],
            ];

            if (!$this->validate($rules, $errorMessages)) {
                $data['validation'] = $this->validator->setRules($rules, $errorMessages);
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

	public function SalvaInteresse() {
		$empregadoresId = $this->request->getVar('empregadores');

		$estagiarioModel = new \App\Models\EstagiarioModel();

		$estagiarioModel->DeleteInteresse(session()->get('estagiario')->id);

		foreach($empregadoresId as $empregadorId) {
			$data = [
				'estagiarioId' => session()->get('estagiario')->id,
				'empregadorId' => $empregadorId,
			];

			$estagiarioModel->InsertInteresse($data);
		}
		
		header('Content-Type: application/json');
		echo json_encode($data);
		
	}
}
