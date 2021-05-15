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

            echo $email;

            $estagiarioModel = new \App\Models\EstagiarioModel();
            $estagiario = $estagiarioModel->ObtenhaPorEmail($email);

            echo $estagiario->nome;

            $session = session();
            $session->setFlashdata('success', 'Successful Registration');
            return redirect()->to('/login');

        }
    }
}
