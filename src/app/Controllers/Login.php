<?php

namespace App\Controllers;

class Login extends BaseController
{
	public function index()
	{
        helper(['form']);
		return view('login');
	}

	public function logar(){
        $session = session();

        $data = [];
        helper(['form', 'validate']);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'senha' => 'required|min_length[6]|max_length[255]',
            ];

        if (!$this->validate($rules, getErrorMessages()))
        {
            $data['validation'] = $this->validator->setRules($rules, getErrorMessages());
        }
        else
        {
            $email = $this->request->getVar('email');
            $senha = $this->request->getVar('senha');

            $estagiarioModel = new \App\Models\EstagiarioModel();
            $estagiario = $estagiarioModel->ObtenhaPorEmail($email);


            if ($estagiario != null) {
                if ($this->senhaEstaCorreta($senha, $estagiario->senha)) {
                    session()->set([
                        'estagiario' => $estagiario,
                        'logado' => true,
                    ]);

                    return redirect()->to('/estagiario/home');
                }
            }

            $empregadorModel = new \App\Models\EmpregadorModel();
            $empregador = $empregadorModel->ObtenhaPorEmail($email);

            if ($empregador != null) {
                if ($this->senhaEstaCorreta($senha, $empregador->senha)) {
                    session()->set([
                        'empregador' => $empregador,
                        'logado' => true,
                    ]);

                    return redirect()->to("/vaga/vagasEmpregador?id=$empregador->id");
                }
            }

            $session->setFlashdata('erro', 'Cadastro não encontrado');

            return redirect()->to('/');
            }
        }
        echo view('login', $data);
    }

    public function logout() {
        session()->destroy();
        return redirect()->to('/login');
    }

    private function senhaEstaCorreta($senha, $senhaEncriptada) {
        if (md5($senha) == $senhaEncriptada) {
            return true;
        }

        return false;
    }

}
