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
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'descricao' => 'required|min_length[3]|max_length[50]',
                'listaDeAtividades' => 'required|min_length[3]|max_length[50]',
                'listaDeHabilidadesRequeridas' => 'required|min_length[3]|max_length[50]',
                'semestreRequerido' => 'required|min_length[1]|max_length[15]|integer',
                'quantidadeDeHoras' => 'required|min_length[1]|max_length[15]|integer',
                'remuneracao' => 'required|min_length[1]|max_length[15]|decimal',
            ];
            $errorMessages = [
                'descricao' => [
                    'required' => 'É necessário fornecer a descrição',
                    'min_length' => 'A descrição deve ter ao menos 3 caracteres',
                    'max_length' => 'A descrição deve ter no máximo 50 caracteres',
                ],
                'listaDeAtividades' => [
                    'required' => 'É necessário fornecer a lista de atividades',
                    'min_length' => 'A lista de atividades deve ter ao menos 3 caracteres',
                    'max_length' => 'A lista de atividades deve ter no máximo 50 caracteres',
                ],
                'listaDeHabilidadesRequeridas' => [
                    'required' => 'É necessário fornecer a lista de habilidades requeridas',
                    'min_length' => 'A lista de habilidades requeridas deve ter ao menos 3 caracteres',
                    'max_length' => 'A lista de habilidades requeridas deve ter no máximo 50 caracteres',
                ],
                'semestreRequerido' => [
                    'required' => 'É necessário fornecer um semestre requerido',
                    'min_length' => 'O semestre requerido deve ter ao menos 3 caracteres',
                    'max_length' => 'O semestre requerido deve ter no máximo 15 caracteres',
                    'integer' => 'O semestre requerido deve ser um número inteiro'
                ],
                'quantidadeDeHoras' => [
                    'required' => 'É necessário fornecer um quantidade de horas',
                    'min_length' => 'O quantidade de horas deve ter ao menos 3 caracteres',
                    'max_length' => 'O quantidade de horas deve ter no máximo 15 caracteres',
                    'integer' => 'O quantidade de horas deve ser um número inteiro'
                ],
                'remuneracao' => [
                    'required' => 'É necessário fornecer uma remuneração',
                    'min_length' => 'A reumuneração deve ter ao menos 3 caracteres',
                    'max_length' => 'A reumuneração deve ter no máximo 15 caracteres',
                    'decimal' => 'A reumuneração deve ser um número decimal'
                ],
            ];

            if (!$this->validate($rules, $errorMessages)) {
                $data['validation'] = $this->validator->setRules($rules, $errorMessages);
            }
            else
            {
                $data = [
                    'id' => md5(uniqid(rand(), true)),
                    'empregadorID' => session()->get('empregador')->id,
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
        helper(['form', 'email']);

        if ($this->request->getMethod() == 'post') {
            $session = session();

            $rules = [
                'descricao' => 'required|min_length[3]|max_length[50]',
                'listaDeAtividades' => 'required|min_length[3]|max_length[50]',
                'listaDeHabilidadesRequeridas' => 'required|min_length[3]|max_length[50]',
                'semestreRequerido' => 'required|min_length[1]|max_length[15]|integer',
                'quantidadeDeHoras' => 'required|min_length[1]|max_length[15]|integer',
                'remuneracao' => 'required|min_length[1]|max_length[15]|decimal',
            ];
            $errorMessages = [
                'descricao' => [
                    'required' => 'É necessário fornecer a descrição',
                    'min_length' => 'A descrição deve ter ao menos 3 caracteres',
                    'max_length' => 'A descrição deve ter no máximo 50 caracteres',
                ],
                'listaDeAtividades' => [
                    'required' => 'É necessário fornecer a lista de atividades',
                    'min_length' => 'A lista de atividades deve ter ao menos 3 caracteres',
                    'max_length' => 'A lista de atividades deve ter no máximo 50 caracteres',
                ],
                'listaDeHabilidadesRequeridas' => [
                    'required' => 'É necessário fornecer a lista de habilidades requeridas',
                    'min_length' => 'A lista de habilidades requeridas deve ter ao menos 3 caracteres',
                    'max_length' => 'A lista de habilidades requeridas deve ter no máximo 50 caracteres',
                ],
                'semestreRequerido' => [
                    'required' => 'É necessário fornecer um semestre requerido',
                    'min_length' => 'O semestre requerido deve ter ao menos 3 caracteres',
                    'max_length' => 'O semestre requerido deve ter no máximo 15 caracteres',
                    'integer' => 'O semestre requerido deve ser um número inteiro'
                ],
                'quantidadeDeHoras' => [
                    'required' => 'É necessário fornecer um quantidade de horas',
                    'min_length' => 'O quantidade de horas deve ter ao menos 3 caracteres',
                    'max_length' => 'O quantidade de horas deve ter no máximo 15 caracteres',
                    'integer' => 'O quantidade de horas deve ser um número inteiro'
                ],
                'remuneracao' => [
                    'required' => 'É necessário fornecer uma remuneração',
                    'min_length' => 'A reumuneração deve ter ao menos 3 caracteres',
                    'max_length' => 'A reumuneração deve ter no máximo 15 caracteres',
                    'decimal' => 'A reumuneração deve ser um número decimal'
                ],
            ];

            if (!$this->validate($rules, $errorMessages)) {
                $data['validation'] = $this->validator->setRules($rules, $errorMessages);
            } else {
                $id = $this->request->getVar('vagaID');

                $data = [
                    'empregadorID' => session()->get('empregador')->id,
                    'descricao' => $this->request->getVar('descricao'),
                    'listaDeAtividades' => $this->request->getVar('listaDeAtividades'),
                    'listaDeHabilidadesRequeridas' => $this->request->getVar('listaDeHabilidadesRequeridas'),
                    'semestreRequerido' => (int)$this->request->getVar('semestreRequerido'),
                    'quantidadeDeHoras' => (int)$this->request->getVar('quantidadeDeHoras'),
                    'remuneracao' => (double)$this->request->getVar('remuneracao'),
                ];

                $vagaModel = new \App\Models\VagaModel();
                $vagaModel->update($id, $data);

                $session->setFlashdata('success', 'Vaga alterada com sucesso!');
                return redirect()->to('/empregador/dash');
            }
        }
        echo view('editarVaga', $data);
    }
}
