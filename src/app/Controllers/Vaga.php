<?php

namespace App\Controllers;

class Vaga extends BaseController
{
    public function index()
    {
        helper(['form']);
        return view('registrarVaga');
    }

    public function registrar() {
        if(!session()->get('empregador')) return redirect('/');

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
                $id = session()->get('empregador')->id;
                $quantidadeDeHoras = (int)$this->request->getVar('quantidadeDeHoras');
                $remuneracao = (double)$this->request->getVar('remuneracao');

                if($quantidadeDeHoras != 20 && $quantidadeDeHoras != 30) {
                    $session->setFlashdata('erro', 'A quantidade de horas deve ser 20 ou 30');
                    return redirect()->to('/vaga/registrar');
                }

                if($quantidadeDeHoras == 20 && $remuneracao < 787.98) {
                    $session->setFlashdata('erro', 'A remuneração mínima para 20 horas é R$787.98');
                    return redirect()->to('/vaga/registrar');
                }

                if($quantidadeDeHoras == 30 && $remuneracao < 1125.69) {
                    $session->setFlashdata('erro', 'A remuneração mínima para 30 horas é R$1125.69');
                    return redirect()->to('/vaga/registrar');
                }

                $data = [
                    'id' => md5(uniqid(rand(), true)),
                    'empregadorID' => $id,
                    'titulo' => $this->request->getVar('titulo'),
                    'descricao' => $this->request->getVar('descricao'),
                    'listaDeAtividades' => $this->request->getVar('listaDeAtividades'),
                    'listaDeHabilidadesRequeridas' => $this->request->getVar('listaDeHabilidadesRequeridas'),
                    'semestreRequerido' => (int)$this->request->getVar('semestreRequerido'),
                    'quantidadeDeHoras' => $quantidadeDeHoras,
                    'remuneracao' => $remuneracao,
                ];

                $vagaModel = new \App\Models\VagaModel();
                $vagaModel->insert($data);

                $estagiarioModel = new \App\Models\EstagiarioModel();
                $estagiariosIdOuvintes = $estagiarioModel->ObtenhaIdsEstagiariosOuvintes($id);

                $empregadorModel = new \App\Models\EmpregadorModel();
                $empregador = $empregadorModel->ObtenhaPorId($id);

                foreach($estagiariosIdOuvintes as $estagiarioId) {
                    $conteudo = [
                        'vaga' => $data,
                        'estagiarioId' => $estagiarioId,
                        'empregador' => $empregador,
                    ];

                    $estagiarioModel->Notifique($conteudo);
                }

                if(!session()->get('empregador')) return redirect('/');
                $session->setFlashdata('success', 'Vaga Registrada com sucesso');

                return redirect()->to("/vaga/vagasEmpregador?id=$id");
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
                $vaga = session()->get('vaga');
                $empregadorID = session()->get('empregador')->id;
                $quantidadeDeHoras = (int)$this->request->getVar('quantidadeDeHoras');
                $remuneracao = (double)$this->request->getVar('remuneracao');

                if($quantidadeDeHoras != 20 && $quantidadeDeHoras != 30) {
                    $session->setFlashdata('erro', 'A quantidade de horas deve ser 20 ou 30');
                    return redirect()->to('/vaga/editar');
                }

                if($quantidadeDeHoras == 20 && $remuneracao < 787.98) {
                    $session->setFlashdata('erro', 'A remuneração mínima para 20 horas é R$787.98');
                    return redirect()->to('/vaga/editar');
                }

                if($quantidadeDeHoras == 30 && $remuneracao < 1125.69) {
                    $session->setFlashdata('erro', 'A remuneração mínima para 30 horas é R$1125.69');
                    return redirect()->to('/vaga/editar');
                }

                $data = [
                    'empregadorID' => $empregadorID,
                    'titulo' => $this->request->getVar('titulo'),
                    'descricao' => $this->request->getVar('descricao'),
                    'listaDeAtividades' => $this->request->getVar('listaDeAtividades'),
                    'listaDeHabilidadesRequeridas' => $this->request->getVar('listaDeHabilidadesRequeridas'),
                    'semestreRequerido' => (int)$this->request->getVar('semestreRequerido'),
                    'quantidadeDeHoras' => $quantidadeDeHoras,
                    'remuneracao' => $remuneracao,
                ];

                $vagaModel = new \App\Models\VagaModel();
                $vagaDB = $vagaModel->ObtenhaPorId($vaga->id);

                if ($vagaDB->empregadorID != $empregadorID) {
                    $session->setFlashdata('erro', "Empregador incorreto! $vaga->id + $vagaDB->empregadorID + $empregadorID");
                    return redirect()->to("/vaga/vagasEmpregador?id=$empregadorID");
                }

                $vagaModel->update($vaga->id, $data);

                $session->setFlashdata('success', 'Vaga alterada com sucesso!');
                return redirect()->to("/vaga/vagasEmpregador?id=$empregadorID");
            }
        }
        echo view('editarVaga', $data);
    }

    public function vagasEmpregador() {
        if(!session()->get('estagiario') && !session()->get('empregador')) return redirect('/');

        $id = $this->request->getVar('id');

        $vagaModel = new \App\Models\VagaModel();
        $vagas = $vagaModel->ObtenhaTodasDeEmpregador($id);

        $empregadorModel = new \App\Models\EmpregadorModel();
        $empregador = $empregadorModel->ObtenhaPorId($id);

        session()->set(['vagas' => $vagas,
            'empresa' => $empregador]);


        echo view ('vagasEmpregador');
    }
}
