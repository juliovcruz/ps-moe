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
                'senha' => 'required|min_length[8]|max_length[255]',
                'confirmacaoSenha' => 'matches[senha]',
                'nomeDoResponsavel' => 'required|min_length[3]|max_length[20]',
                'nomeDaEmpresa' => 'required|min_length[3]|max_length[20]',
                'descricao' => 'required|min_length[3]|max_length[20]',
                'produtos' => 'required|min_length[3]|max_length[20]',
            ];

            if (!$this->validate($rules))
            {
                $data['validation'] = $this->validator;
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

    public function dash() {
        $session = session();

        $data = ['empregador' => $_SESSION['empregador']];

       echo $_SESSION['empregador']->email;

        $session->setFlashdata('success', 'Successful Registration');
        echo view('dashEmpregador', $data);
    }
}
