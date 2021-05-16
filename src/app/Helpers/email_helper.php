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
}