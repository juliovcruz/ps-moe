<?php

namespace App\Controllers;

class Vaga extends BaseController
{
    public function index()
    {
        helper(['form']);
        return view('registrarVaga');
    }

    public function register() {

        $data = [];
        helper(['form']);

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'empregadorID' => 'required|min_length[3]|max_length[250]',
                'descricao' => 'required|min_length[3]|max_length[20]',
                'listaDeAtividades' => 'required|min_length[3]|max_length[20]',
                'listaDeHabilidadesRequeridas' => 'required|min_length[3]|max_length[20]',
                'semestreRequerido' => 'required|min_length[1]|max_length[20]',
                'quantidadeDeHoras' => 'required|min_length[1]|max_length[20]',
                'remuneracao' => 'required|min_length[1]|max_length[20]',
            ];

            if (!$this->validate($rules))
            {
                $data['validation'] = $this->validator;
            }
            else
            {
                $data = [
                    'id' => md5(uniqid(rand(), true)),
                    'descricao' => $this->request->getVar('descricao'),
                    'listaDeAtividades' => $this->request->getVar('listaDeAtividades'),
                    'listaDeHabilidadesRequeridas' => $this->request->getVar('listaDeHabilidadesRequeridas'),
                    'semestreRequerido' => (int)$this->request->getVar('semestreRequerido'),
                    'quantidadeDeHoras' => (int)$this->request->getVar('quantidadeDeHoras'),
                    'remuneracao' => (double)$this->request->getVar('remuneracao'),
                ];

                $vagaModel = new \App\Models\VagaModel();

                $vagaModel->insert($data);
                $session = session();
                $session->setFlashdata('success', 'Successful Registration');

                // TODO: redirect
                // TODO: EmpregadorID

                return redirect()->to('/login');

            }
        }
        echo view('registrarVaga', $data);
    }
}
