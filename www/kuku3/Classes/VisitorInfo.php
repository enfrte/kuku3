<?php

namespace Kuku3\Classes;

use Flight;

class VisitorInfo {
	public static function insertVisitorInfo() {
		$db = Flight::db();
		$db->runQuery(
			'INSERT INTO visitor (visit_date) VALUES (CURRENT_TIMESTAMP)'
		);	
	}
}