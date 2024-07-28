<?php

require '../vendor/autoload.php'; // autoload the classes

use Kuku3\Classes\Controllers\HomeController;
use Kuku3\Classes\Controllers\AccessController;
use Kuku3\Classes\Controllers\InstallController;
use Kuku3\Classes\SelkoSuomiParser;
use Kuku3\Classes\Translate;
use Latte\Engine as LatteEngine;
use flight\net\Response;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$app = Flight::app();

Flight::map('configData', function() {
    static $config;
    if (!$config) {
        $config = require __DIR__ . '/config/config.php';
    }
    return $config;
});

$app->register('latte', LatteEngine::class, [], function(LatteEngine $latte) use ($app) {
    $latte->setTempDirectory(__DIR__ . '/../cache/');
    // Tell Latte where the root directory for your views will be at.
    // $latte->setLoader(new \Latte\Loaders\FileLoader($app->get('/templates')));
    $latte->setLoader(new \Latte\Loaders\FileLoader('templates'));
});

// Return custom htmx responses
Flight::map('htmxResponse', function() {
    return new class extends Response {
        public function sendHtml($html) {
            $this->header('Content-Type', 'text/html');
            $this->write($html);
            $this->send();
        }
    };
});

// Register the PDO helper class
Flight::register('db', \flight\database\PdoWrapper::class, ['sqlite:database.sqlite', [
    // "PRAGMA STRICT = ON;",
    // "PRAGMA foreign_keys = ON;",
    // "PRAGMA auto_vacuum = FULL;",
    // "PRAGMA ignore_check_constraints = FALSE;",
]]);

Flight::route('/', [AccessController::class, 'index']);
Flight::route('/logout', [AccessController::class, 'logout']);
Flight::route('/translation', [Translate::class, 'newTranslation']);
Flight::route('/translate', [Translate::class, 'googleTranslate']);
Flight::route('/home', [HomeController::class, 'index']);
Flight::route('/get_latest_news', [SelkoSuomiParser::class, 'getLatestNews']);
Flight::route('/install', [InstallController::class, 'index']);

Flight::start();

?>
