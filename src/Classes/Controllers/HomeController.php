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
        // Bounce the user if they aren't logged in
        if (empty($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
            // Flight::view()->display('access.latte');
            // exit;
        }
    }
    
    public function index()
    {
        Flight::latte()->render('home.latte', []);
    }

}
