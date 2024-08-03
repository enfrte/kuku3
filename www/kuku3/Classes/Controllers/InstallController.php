<?php

namespace Kuku3\Classes\Controllers;

use Flight;
use PDO;
use Kuku3\Classes\Security;

class InstallController 
{
	public function index()
	{
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);

		Security::authCheck();

		if ( empty($_SESSION['logged_in']) || $_SESSION['logged_in'] == false ) { 
			die('Requires access.');
		}

		$result = "Success!";
	
		try {
			$schema_file = __DIR__ . '/../../schema.sql';
			$schema = file_get_contents($schema_file); 

			if ( empty($schema) ) {
				throw new \Exception("Could not get contents of schema file");
			}

			$db = new PDO('sqlite:database.sqlite'); // path is in relation to index.php I guess

			// Split the schema file into individual statements
			$statements = array_filter(array_map('trim', explode(';', $schema)));

			// Execute each statement in the schema
			foreach ($statements as $statement) {
				if ($statement) {
					$db->exec($statement);
				}
			}
		}
		catch (\Throwable $th) {
			$result = 'Failed to create schema: '.$th->getMessage();
		}
		finally {
			Flight::latte()->render('home.latte', ['flash_msg' => $result]);
		}
	}

}
