<?php

require '../vendor/autoload.php'; // autoload the classes

use Kuku3\Classes\Controllers\HomeController;
use Kuku3\Classes\Controllers\AccessController;
use Kuku3\Classes\SelkoSuomiParser;
use Kuku3\Classes\Translate;
use Smarty\Smarty;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

Flight::register('view', Smarty::class, [], function (Smarty $smarty) {
  $smarty->setTemplateDir('./templates/');
  $smarty->setCompileDir('./templates_c/');
  $smarty->setConfigDir('./config/');
  $smarty->setCacheDir('./cache/');
});
  
Flight::route('/', [new AccessController, 'index']);
Flight::route('/logout', [new AccessController, 'logout']);
Flight::route('/translation', [new Translate, 'newTranslation']);
Flight::route('/translate', [new Translate, 'googleTranslate']);
Flight::route('/home', [new HomeController, 'index']);
Flight::route('/get_latest_news', [new SelkoSuomiParser, 'getLatestNews']);


Flight::start();

?>
