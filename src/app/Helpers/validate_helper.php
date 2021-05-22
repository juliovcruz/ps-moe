<?php
if (!function_exists('getErrorMessages')){
    function getErrorMessages() {
        return [
            'email' => [
                'required' => 'É necessário fornecer um email',
                'min_length' => 'O email deve ter ao menos 6 caracteres',
                'max_length' => 'O email deve ter no máximo 50 caracteres',
                'valid_email' => 'O email deve ser válido',
                'is_unique' => 'Já existe um cadastro com este email'
            ],
            'senha' => [
                'required' => 'É necessário fornecer uma senha',
                'min_length' => 'A senha deve ter ao menos 6 caracteres',
                'max_length' => 'A senha deve ter no máximo 250 caracteres',
                'regex_match' => 'A senha precisa ter ao menos uma letra minúscula, uma letra maiúsculua e um caracter especial'
            ],
            'confirmacaoSenha' => [
                'matches' => 'A confirmação de senha deve ser igual a senha'
            ],
            'nomeDoResponsavel' => [
                'required' => 'É necessário fornecer o nome do responsável',
                'min_length' => 'O nome do responsável deve ter ao menos 3 caracteres',
                'max_length' => 'O nome do responsável deve ter no máximo 50 caracteres'
            ],
            'nomeDaEmpresa' => [
                'required' => 'É necessário fornecer o nome da empresa',
                'min_length' => 'O nome da empresa deve ter ao menos 3 caracteres',
                'max_length' => 'O nome da empresa deve ter no máximo 50 caracteres'
            ],
            'titulo' => [
                'required' => 'É necessário fornecer o título',
                'min_length' => 'O título deve ter ao menos 3 caracteres',
                'max_length' => 'O título deve ter no máximo 50 caracteres'
            ],
            'descricao' => [
                'required' => 'É necessário fornecer a descrição',
                'min_length' => 'A descrição deve ter ao menos 3 caracteres',
                'max_length' => 'A descrição deve ter no máximo 250 caracteres'
            ],
            'produtos' => [
                'required' => 'É necessário fornecer os produtos',
                'min_length' => 'Os produtos devem ter ao menos 3 caracteres',
                'max_length' => 'Os produtos devem ter no máximo 250 caracteres'
            ],
            'senhaAntiga' => [
                'required' => 'É necessário fornecer a senha atual',
            ],
            'nome' => [
                'required' => 'É necessário fornecer o nome',
                'min_length' => 'O nome deve ter ao menos 3 caracteres',
                'max_length' => 'O nome deve ter no máximo 50 caracteres'
            ],
            'curso' => [
                'required' => 'É necessário fornecer o curso',
                'min_length' => 'O curso deve ter ao menos 3 caracteres',
                'max_length' => 'O curso deve ter no máximo 50 caracteres'
            ],
            'anoDeIngresso' => [
                'required' => 'É necessário fornecer o ano de ingresso',
                'exact_length' => 'O ano de ingresso deve ter exatamente 4 caracteres',
                'integer' => 'O ano de ingresso deve ser um número inteiro'
            ],
            'minicurriculo' => [
                'required' => 'É necessário fornecer o mini currículo',
                'min_length' => 'O mini currículo devem ter ao menos 3 caracteres',
                'max_length' => 'O mini currículo devem ter no máximo 250 caracteres'
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
    }
}