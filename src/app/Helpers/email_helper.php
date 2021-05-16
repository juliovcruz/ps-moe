<?php
if (!function_exists('EnviaEmailCadastro'))
{
    function EnviaEmailCadastro($data)
    {
        $linkConfirmacao = base_url() . "/ValidarEmail?id=" . $data['id'] . "&token=" . $data['token'];
				
		$email = \Config\Services::email();

		$config['mailType'] = 'html';
				
		$email->initialize($config);
		$email->setFrom('ufg.projetodesoftware@hotmail.com');
		//$email->setTo('lucabbenetti@hotmail.com');

		$email->setSubject('teste4');
		$email->setMessage("<!DOCTYPE html>
				<html lang='en' dir='ltr'>
				  <head>
					<meta charset='utf-8'>
					<title></title>
				  </head>
				  <body>
					  Olá <strong>" . $data['nome'] . "!</strong> Para confimar seu registro e ter acesso ao mural de estágios, <a href=" . $linkConfirmacao . ">clique aqui</a>.
				  </body>
			  </html>");

		$email->send();

        return !empty($email->printDebugger());
    }   

	function EnvieEmailVaga($vaga, $estagiario, $empregador)
    {
		$email = \Config\Services::email();

		$config['mailType'] = 'html';
				
		$email->initialize($config);
		$email->setFrom('ufg.projetodesoftware@hotmail.com');
		$email->setTo('juliovcruz0@gmail.com');

		$email->setSubject("MOE - $empregador->nomeDaEmpresa tem uma nova vaga de estágio!");
		$email->setMessage("<!DOCTYPE html>
				<html lang='en' dir='ltr'>
				  <head>
					<meta charset='utf-8'>
					<title></title>
				  </head>
				  <body>
					  Olá <strong>$estagiario->nome</strong>,". " a empresa <strong>$empregador->nomeDaEmpresa</strong> cadastrou uma nova vaga de estágio!<br><strong>"
                    . $vaga['titulo'] . "</strong><br>" . $vaga['descricao'] . "<br>" . "A vaga necessita de um comprometimento de " . $vaga['quantidadeDeHoras'] . " 
					  semanais com uma remuneração mensal de R$" . $vaga['remuneracao'] . " !
					  <br>Para mais detalhes acesse nosso <a href='http://projeto/'>site</a></strong>
				  </body>
			  </html>");

		$email->send();

        return !empty($email->printDebugger());
    }   
}