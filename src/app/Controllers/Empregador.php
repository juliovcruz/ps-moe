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
        helper(['form', 'email','validate']);

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

            if (!$this->validate($rules, getErrorMessages())) {
                $data['validation'] = $this->validator->setRules($rules, getErrorMessages());
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
        helper(['form', 'email','validate']);

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

            if (!$this->validate($rules, getErrorMessages())) {
                $data['validation'] = $this->validator->setRules($rules, getErrorMessages());
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
        $data = ['empregador' => $_SESSION['empregador']];

        if(!session()->get('empregador')) return redirect('/');

        echo view('dashEmpregador', $data);
    }

    public function estagiariosInteressados() {
        $id = $this->request->getVar('id');

        $estagiarioModel = new \App\Models\EstagiarioModel();
        $estagiariosIDs = $estagiarioModel->ObtenhaIdsEstagiariosOuvintes($id);

        foreach ($estagiariosIDs as $estagiarioID) {
            $estagiarios[] = $estagiarioModel->ObtenhaPorId($estagiarioID);
        }

        session()->set(['estagiarios' => $estagiarios]);

        echo view ('estagiariosInteressados');
    }
}
