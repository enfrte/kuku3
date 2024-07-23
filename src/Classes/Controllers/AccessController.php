<?php

namespace Kuku3\Classes\Controllers;

use Flight;

class AccessController
{
	public function __construct() {
		session_start();
	}
    public function index()
    {
		if (!empty($_POST['password']) && $_POST['password'] == 'asdf' || isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			$_SESSION['logged_in'] = true;
			Flight::redirect('/home');
		}
		else {
			// sleep(5); // will this help against brute force?
			Flight::view()->display('access.tpl');
		}
    }
}