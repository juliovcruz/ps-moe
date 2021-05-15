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
        helper(['form']);

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email|is_unique[empregadores.email]',
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
                $data = [
                    'id' => md5(uniqid(rand(), true)),
                    'email' => $this->request->getVar('email'),
                    'senha' => md5($this->request->getVar('senha')),
                    'nomeDoResponsavel' => $this->request->getVar('nomeDoResponsavel'),
                    'nomeDaEmpresa' => $this->request->getVar('nomeDaEmpresa'),
                    'descricao' => (int)$this->request->getVar('descricao'),
                    'produtos' => $this->request->getVar('produtos'),
                    'token' => md5(uniqid(rand(), true)),
                    'emailConfirmado' => false
                ];

                $empregadorModel = new \App\Models\EmpregadorModel();

                $empregadorModel->insert($data);
                $session = session();
                $session->setFlashdata('success', 'Successful Registration');
                return redirect()->to('/login');

            }
        }
        echo view('registrarEmpregador', $data);
    }
}
