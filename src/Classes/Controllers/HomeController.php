<?php

namespace Kuku3\Classes\Controllers;

// use Kuku3\Classes\Translate; 
// use Smarty\Smarty;
use Flight;
use Kuku3\Classes\Security;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class HomeController
{
    public function __construct() {
        // Bounce the user if they aren't logged in
        Security::authCheck();
    }
    
    public function index()
    {
        Flight::latte()->render('home.latte', []);
    }

}
