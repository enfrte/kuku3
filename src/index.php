<?php

require '../vendor/autoload.php'; // autoload the classes

// use Kuku3\Classes\Translate;
// use Kuku3\Classes\SelkoSuomiParser;
use Kuku3\Classes\Controllers\HomeController;
use Kuku3\Classes\Controllers\AccessController;
use Smarty\Smarty;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// $parse = new SelkoSuomiParser();
// $selko_uutiset = $parse->parse('https://yle.fi/selkouutiset');

// $translate = new Translate();
// $originalText = "Hei maalima!";
// $translatedText = $translate->translate($originalText, 'fi', 'en');
// echo "Original: $originalText\n";
// echo "Translated: $translatedText\n";

// Flight::route('/home', function () {
// 	$homeController = new HomeController();
// 	$homeController->index();
// });

Flight::register('view', Smarty::class, [], function (Smarty $smarty) {
  $smarty->setTemplateDir('./templates/');
  $smarty->setCompileDir('./templates_c/');
  $smarty->setConfigDir('./config/');
  $smarty->setCacheDir('./cache/');
});
  
Flight::route('/', [new AccessController, 'index']);
Flight::route('/home', [new HomeController, 'index']);

Flight::start();

?>

