<?php

require '../vendor/autoload.php'; // autoload the classes

use Kuku3\Classes\Controllers\HomeController;
use Kuku3\Classes\Controllers\AccessController;
use Kuku3\Classes\SelkoSuomiParser;
use Kuku3\Classes\Translate;
use Latte\Engine as LatteEngine;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$app = Flight::app();

$app->register('latte', LatteEngine::class, [], function(LatteEngine $latte) use ($app) {
    $latte->setTempDirectory(__DIR__ . '/../cache/');
    // Tell Latte where the root directory for your views will be at.
    // $latte->setLoader(new \Latte\Loaders\FileLoader($app->get('/templates')));
    $latte->setLoader(new \Latte\Loaders\FileLoader('templates'));
});

Flight::route('/', [AccessController::class, 'index']);
Flight::route('/logout', [AccessController::class, 'logout']);
Flight::route('/translation', [Translate::class, 'newTranslation']);
Flight::route('/translate', [Translate::class, 'googleTranslate']);
Flight::route('/home', [HomeController::class, 'index']);
Flight::route('/get_latest_news', [SelkoSuomiParser::class, 'getLatestNews']);

Flight::start();

?>
