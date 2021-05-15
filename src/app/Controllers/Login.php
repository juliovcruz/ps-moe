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
        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'senha' => 'required|min_length[8]|max_length[255]',
            ];
        }

        if (!$this->validate($rules))
        {
            $data['validation'] = $this->validator;
        }
        else
        {
            $email = $this->request->getVar('email');
            $senha = $this->request->getVar('senha');

            $estagiarioModel = new \App\Models\EstagiarioModel();
            $estagiario = $estagiarioModel->ObtenhaPorEmail($email);

            if ($this->senhaEstaCorreta($senha, $estagiario->senha)) {
                session()->set(['estagiario' => $estagiario]);

                return redirect()->to('/Estagiario/dash');
            }

            $empregadorModel = new \App\Models\EmpregadorModel();
            $empregador = $empregadorModel->ObtenhaPorEmail($email);

            if ($this->senhaEstaCorreta($senha, $empregador->senha)) {
                session()->set(['empregador' => $empregador]);

                return redirect()->to('/Empregador/dash');
            }

            $session = session();
            $session->setFlashdata('success', 'Successful Registration');
            return redirect()->to('/login');
        }
    }

    public function senhaEstaCorreta($senha, $senhaEncriptada) {
        if (md5($senha) == $senhaEncriptada) {
            return true;
        }

        return false;
    }

}
