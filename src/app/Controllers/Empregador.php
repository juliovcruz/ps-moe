<?php

namespace App\Controllers;

class Empregador extends BaseController
{

    public function index()
    {
        helper(['form']);
        return view('registrarEmpregador');
    }

    public function register() {
        $data = [];
        helper(['form', 'email']);

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[empregadores.email]|is_unique[estagiarios.email]',
                'senha' => 'required|min_length[6]|max_length[250]|regex_match[/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/]',
                'confirmacaoSenha' => 'matches[senha]',
                'nomeDoResponsavel' => 'required|min_length[3]|max_length[50]',
                'nomeDaEmpresa' => 'required|min_length[3]|max_length[50]',
                'descricao' => 'required|min_length[3]|max_length[250]',
                'produtos' => 'required|min_length[3]|max_length[250]',
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
                'nomeDoResponsavel' => [
                    'required' => 'É necessário fornecer o nome do responsável',
                    'min_length' => 'O nome do responsável deve ter ao menos 3 caracteres',
                    'max_length' => 'O nome do responsável deve ter no máximo 50 caracteres'
                ],
                'nomeDaEmpresa' => [
                    'required' => 'É necessário fornecer o nome da empresa',
                    'min_length' => 'O nome da empresa deve ter ao menos 3 caracteres',
                    'max_length' => 'O nome da empresa deve ter no máximo 50 caracteres'
                ],
                'descricao' => [
                    'required' => 'É necessário fornecer a descrição',
                    'min_length' => 'A descrição deve ter ao menos 3 caracteres',
                    'max_length' => 'A descrição deve ter no máximo 250 caracteres'
                ],
                'produtos' => [
                    'required' => 'É necessário fornecer os produtos',
                    'min_length' => 'Os produtos devem ter ao menos 3 caracteres',
                    'max_length' => 'Os produtos devem ter no máximo 250 caracteres'
                ]
            ];
            if (!$this->validate($rules, $errorMessages)) {
                //$data['validation'] = $this->validate($rules, $errorMessages);

                $data['validation'] = $this->validator->setRules($rules, $errorMessages);
            }
            else
            {
                $id = md5(uniqid(rand(), true));
                $token = md5(uniqid(rand(), true));
                $nome = $this->request->getVar('nomeDaEmpresa');
                $data = [
                    'id' => $id,
                    'email' => $this->request->getVar('email'),
                    'senha' => md5($this->request->getVar('senha')),
                    'nomeDoResponsavel' => $this->request->getVar('nomeDoResponsavel'),
                    'nomeDaEmpresa' => $this->request->getVar('nomeDaEmpresa'),
                    'descricao' => $this->request->getVar('descricao'),
                    'produtos' => $this->request->getVar('produtos'),
                    'token' => $token,
                    'emailConfirmado' => false
                ];

                $empregadorModel = new \App\Models\EmpregadorModel();
                $empregadorModel->insert($data);

                $dadosEmail = [
					'id' => $id,
					'token' => $token,
					'nome' => $nome,
				];

				$session = session();
				
				if(!EnviaEmailCadastro($dadosEmail)) {
					$session->setFlashdata('erroEmail', 'Ocorreu um erro, contate nosso suporte.');
					return view('registrarEmpregador');
				}
				
				$session->setFlashdata('success', 'Registro feito com sucesso, confirme seu email para poder acessar!');				
				return redirect()->to('/login');
            }
        }
        echo view('registrarEmpregador', $data);
    }

    public function editar() {
        if(!session()->get('empregador')) return redirect('/');

        $data = [];
        helper(['form', 'email']);

        if ($this->request->getMethod() == 'post') {
            $session = session();

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[estagiarios.email]',
                'senha' => 'max_length[250]',
                'confirmacaoSenha' => 'matches[senha]',
                'nomeDoResponsavel' => 'required|min_length[3]|max_length[50]',
                'nomeDaEmpresa' => 'required|min_length[3]|max_length[50]',
                'descricao' => 'required|min_length[3]|max_length[250]',
                'produtos' => 'required|min_length[3]|max_length[250]',
                'senhaAntiga' => 'required',
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
                    'max_length' => 'A senha deve ter no máximo 250 caracteres',
                ],
                'confirmacaoSenha' => [
                    'matches' => 'A confirmação de senha deve ser igual a senha'
                ],
                'nomeDoResponsavel' => [
                    'required' => 'É necessário fornecer o nome do responsável',
                    'min_length' => 'O nome do responsável deve ter ao menos 3 caracteres',
                    'max_length' => 'O nome do responsável deve ter no máximo 50 caracteres'
                ],
                'nomeDaEmpresa' => [
                    'required' => 'É necessário fornecer o nome da empresa',
                    'min_length' => 'O nome da empresa deve ter ao menos 3 caracteres',
                    'max_length' => 'O nome da empresa deve ter no máximo 50 caracteres'
                ],
                'descricao' => [
                    'required' => 'É necessário fornecer a descrição',
                    'min_length' => 'A descrição deve ter ao menos 3 caracteres',
                    'max_length' => 'A descrição deve ter no máximo 250 caracteres'
                ],
                'produtos' => [
                    'required' => 'É necessário fornecer os produtos',
                    'min_length' => 'Os produtos devem ter ao menos 3 caracteres',
                    'max_length' => 'Os produtos devem ter no máximo 250 caracteres'
                ],
                'senhaAntiga' => [
                    'required' => 'É necessário fornecer a senha atual',
                ],
            ];
            if (!$this->validate($rules, $errorMessages)) {
                $data['validation'] = $this->validator->setRules($rules, $errorMessages);
            } else {
                $empregador = session()->get('empregador');
                $senhaAntiga = $this->request->getVar('senhaAntiga');

                $data = [
                    'email' => $this->request->getVar('email'),
                    'nomeDoResponsavel' => $this->request->getVar('nomeDoResponsavel'),
                    'nomeDaEmpresa' => $this->request->getVar('nomeDaEmpresa'),
                    'descricao' => $this->request->getVar('descricao'),
                    'produtos' => $this->request->getVar('produtos'),
                ];

                if(strlen($this->request->getVar('senha')) >= 6 ) {
                    $data['senha'] = md5($this->request->getVar('senha'));
                }

                $empregadorModel = new \App\Models\EmpregadorModel();

                if (!$empregadorModel->senhaEstaCorreta($empregador->email, $senhaAntiga)) {
                    $session->setFlashdata('erro', 'Senha incorreta!');

                    return redirect()->to('/empregador/editar');
                }

                $empregadorModel->update($empregador->id, $data);

                $session->setFlashdata('success', 'Cadastro alterado com sucesso!');
                return redirect()->to('/empregador/dash');
            }
        }
        echo view('editarEmpregador', $data);
    }

    public function dash() {
        $session = session();

        $data = ['empregador' => $_SESSION['empregador']];

        echo $_SESSION['empregador']->email;

        if(!session()->get('empregador')) return redirect('/');
        $session->setFlashdata('success', 'Successful Registration');

        echo view('dashEmpregador', $data);
    }
}
