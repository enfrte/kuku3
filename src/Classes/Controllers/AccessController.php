<?php

namespace Kuku3\Classes\Controllers;

use Flight;

class AccessController
{
	public function __construct() {
		
	}
    public function index()
    {
		if (isset($_POST['password']) && $_POST['password'] == 'asdf' || isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
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