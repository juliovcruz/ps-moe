<?php

namespace App\Controllers;

class Login extends BaseController
{
	public function index()
	{
        helper(['form']);
		return view('login');
	}
}
