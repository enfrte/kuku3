<?php

namespace Kuku3\Classes;

use Flight;

class Security {
	public static function isAuthenticated() {
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			return true;
		} else {
			return false;
		}
	}

	public static function bounce() {
		Flight::latte()->render('access.latte');
		exit;
	}

	public static function authCheck() {
		if (!self::isAuthenticated()) {
			self::bounce();
		}
	}
}