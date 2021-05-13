<?php

namespace App\Controllers;

class Estagiario extends BaseController
{
	public function index()
	{
		return view('registrarEstagiario');
	}

	public function register() {

		$data = [
			'id' => "1234567",
			'email' => $this->request->getVar('email'),
			'senha' => $this->request->getVar('senha'),
			'nome' => $this->request->getVar('nome'),
			'curso' => $this->request->getVar('curso'),
			'anoDeIngresso' => (int)$this->request->getVar('anoDeIngresso'),
			'miniCurriculo' => $this->request->getVar('miniCurriculo')
		];

		$estagiarioModel = new \App\Models\EstagiarioModel();

		$estagiarioModel->insert($data);

		$retorno = [
			'sucesso' => true
		];

		header('Content-Type: application/json');
    	echo json_encode( $data );
		
	}
}
