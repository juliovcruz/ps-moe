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
        $session = session();

        $data = [];
        helper(['form','validate']);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'titulo' => 'required|min_length[3]|max_length[50]',
                'descricao' => 'required|min_length[3]|max_length[250]',
                'listaDeAtividades' => 'required|min_length[3]|max_length[50]',
                'listaDeHabilidadesRequeridas' => 'required|min_length[3]|max_length[50]',
                'semestreRequerido' => 'required|min_length[1]|max_length[15]|integer',
                'quantidadeDeHoras' => 'required|min_length[1]|max_length[15]|integer',
                'remuneracao' => 'required|min_length[1]|max_length[15]|decimal',
            ];
             if (!$this->validate($rules, getErrorMessages())) {
                $data['validation'] = $this->validator->setRules($rules, getErrorMessages());
            }
            else
            {
                $data = [
                    'id' => md5(uniqid(rand(), true)),
                    'empregadorID' => session()->get('empregador')->id,
                    'titulo' => $this->request->getVar('titulo'),
                    'descricao' => $this->request->getVar('descricao'),
                    'listaDeAtividades' => $this->request->getVar('listaDeAtividades'),
                    'listaDeHabilidadesRequeridas' => $this->request->getVar('listaDeHabilidadesRequeridas'),
                    'semestreRequerido' => (int)$this->request->getVar('semestreRequerido'),
                    'quantidadeDeHoras' => (int)$this->request->getVar('quantidadeDeHoras'),
                    'remuneracao' => (double)$this->request->getVar('remuneracao'),
                ];

                $vagaModel = new \App\Models\VagaModel();

                $vagaModel->insert($data);

                if(!session()->get('empregador')) return redirect('/');
                $session->setFlashdata('success', 'Successful Registration');

                return redirect()->to('/empregador/dash');

            }
        }
        echo view('registrarVaga', $data);
    }

    public function editar() {
        if(!session()->get('empregador')) return redirect('/');

        $data = [];
        helper(['form', 'email','validate']);

        if ($this->request->getMethod() == 'post') {
            $session = session();

            $rules = [
                'titulo' => 'required|min_length[3]|max_length[50]',
                'descricao' => 'required|min_length[3]|max_length[250]',
                'listaDeAtividades' => 'required|min_length[3]|max_length[50]',
                'listaDeHabilidadesRequeridas' => 'required|min_length[3]|max_length[50]',
                'semestreRequerido' => 'required|min_length[1]|max_length[15]|integer',
                'quantidadeDeHoras' => 'required|min_length[1]|max_length[15]|integer',
                'remuneracao' => 'required|min_length[1]|max_length[15]|decimal',
            ];

            if (!$this->validate($rules, getErrorMessages())) {
                $data['validation'] = $this->validator->setRules($rules, getErrorMessages());
            } else {
                $id = $this->request->getVar('id');
                $empregadorID = session()->get('empregador')->id;

                $data = [
                    'empregadorID' => $empregadorID,
                    'titulo' => $this->request->getVar('titulo'),
                    'descricao' => $this->request->getVar('descricao'),
                    'listaDeAtividades' => $this->request->getVar('listaDeAtividades'),
                    'listaDeHabilidadesRequeridas' => $this->request->getVar('listaDeHabilidadesRequeridas'),
                    'semestreRequerido' => (int)$this->request->getVar('semestreRequerido'),
                    'quantidadeDeHoras' => (int)$this->request->getVar('quantidadeDeHoras'),
                    'remuneracao' => (double)$this->request->getVar('remuneracao'),
                ];

                $vagaModel = new \App\Models\VagaModel();

                if ($vagaModel->ObtenhaPorId($id)->empregadorID != $empregadorID) {
                    $session->setFlashdata('erro', 'Empregador incorreto!');
                    return redirect()->to('/empregador/dash');
                }

                $vagaModel->update($id, $data);

                $session->setFlashdata('success', 'Vaga alterada com sucesso!');
                return redirect()->to('/empregador/dash');
            }
        }
        echo view('editarVaga', $data);
    }

    public function vagasEmpregador() {
        $id = $this->request->getVar('id');

        $vagaModel = new \App\Models\VagaModel();
        $vagas = $vagaModel->ObtenhaTodasDeEmpregador($id);

        session()->set(['vagas' => $vagas]);

        echo view ('vagasEmpregador');
    }
}
