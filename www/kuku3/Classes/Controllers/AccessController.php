<?php

namespace Kuku3\Classes\Controllers;

use Flight;
use Kuku3\Classes\Security;

class AccessController
{
	public function __construct() {
		
	}
    public function index()
    {
		$submitted_password = !empty($_POST['password']) ? $_POST['password'] : false;
		$config = Flight::configData();

		if ($submitted_password == $config['app_password'] || Security::isAuthenticated()) {
			$_SESSION['logged_in'] = true;
			Flight::redirect('/home');
		}
		else {
			// sleep(5); // will this help against brute force?
			Flight::latte()->render('access.latte');
		}
    }

	function logout() {
		$_SESSION['logged_in'] = false;
		Flight::latte()->render('access.latte');
		// Flight::latte()->display('access.latte');
	}
}