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
            $empregadorModel = new \App\Models\EmpregadorModel();
            
            $estagiario = $estagiarioModel->ObtenhaPorId($id);
            $empregador = $empregadorModel->ObtenhaPorId($id);

            $session = session();

            if(empty($id) || empty($token)) {
                $session->setFlashdata('erro', 'Ocorreu algum erro, não foi possível confirmar o seu email.');
            }

            else if(!is_null($estagiario) && $estagiario->token == $token) {
                $estagiarioModel->AtualizeToken($estagiario->id);
                $session->setFlashdata('success', 'Email confirmado com sucesso, você pode realizar o login agora.');
            }

            else if(!is_null($empregador) && $empregador->token == $token) {
                $empregadorModel->AtualizeToken($empregador->id);
                $session->setFlashdata('success', 'Email confirmado com sucesso, você pode realizar o login agora.');
            }

            return redirect()->to('/login');
        }
	}
}
