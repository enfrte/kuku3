<?php

namespace Kuku3\Classes\Controllers;

// use Kuku3\Classes\Translate; 
// use Smarty\Smarty;
use Flight;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class HomeController
{
    public function __construct() {
        // if (empty($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
        //     Flight::view()->display('access.tpl');
        //     exit;
        // }
    }
    
    public function index()
    {
        // $translate = new Translate();
        // $originalText = "Hei maalima!";
        // $translatedText = $translate->translate($originalText, 'fi', 'en');
        // echo "Original: $originalText\n" .
		// " Translated: $translatedText\n";
        Flight::view()->assign('name', 'Bob');
        Flight::view()->display('home.tpl');
    }

}
