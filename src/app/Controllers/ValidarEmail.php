<?php

namespace App\Controllers;

class ValidarEmail extends BaseController
{
	public function index()
	{
        helper(['form']);

        if ($this->request->getMethod() == 'get') {
            $id = $this->request->getVar('id');
            $token = $this->request->getVar('token');

            $estagiarioModel = new \App\Models\EstagiarioModel();
            
            $estagiario = $estagiarioModel->ObtenhaPorId($id);

            $session = session();

            if(!is_null($estagiario) && $estagiario->token == $token) {
                $estagiarioModel->AtualizeToken($estagiario->id);
                $session->setFlashdata('success', 'Email confirmado com sucesso, você pode realizar o login agora.');
            }

            else {
                $session->setFlashdata('erro', 'Ocorreu algum erro, não foi possível confirmar o seu email.');
            }

            return redirect()->to('/login');
        }
	}
}
