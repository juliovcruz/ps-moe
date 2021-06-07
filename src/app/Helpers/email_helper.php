<?php
if (!function_exists('EnviaEmailCadastro'))
{
    function EnviaEmailCadastro($data)
    {
        $linkConfirmacao = base_url() . "/ValidarEmail?id=" . $data['id'] . "&token=" . $data['token'];
				
		$email = \Config\Services::email();

		$config['mailType'] = 'html';
				
		$email->initialize($config);
		$email->setFrom('xxx');
		$email->setTo($data['email']);

		$email->setSubject('Confirme seu email para ter acesso ao Mural de Estágios');
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

		log_message('error', $email->send());

		$a = log_message('error', $email->printDebugger());

        return !empty($a);
    }   

	function EnvieEmailVaga($vaga, $estagiario, $empregador)
    {
		$email = \Config\Services::email();

		$config['mailType'] = 'html';
				
		$email->initialize($config);
		$email->setFrom('ufg.projetodesoftware@hotmail.com');
		$email->setTo($estagiario->email);

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