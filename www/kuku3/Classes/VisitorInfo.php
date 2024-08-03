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

	public static function getTotalNumberOfVisitors() {
		$db = Flight::db();
		$sql = 'SELECT COUNT(*) as total FROM visitor';
		$totalNumberOfVisitors = $db->fetchField($sql);
		return $totalNumberOfVisitors;
	}
}
