<?php

require '../vendor/autoload.php'; // autoload the classes

use Kuku3\Classes\Controllers\HomeController;
use Kuku3\Classes\Controllers\AccessController;
use Kuku3\Classes\Controllers\InstallController;
use Kuku3\Classes\SelkoSuomiParser;
use Kuku3\Classes\Translate;
use Latte\Engine as LatteEngine;
use flight\net\Response;
use flight\database\PdoWrapper;

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
Flight::register('db', PdoWrapper::class, ['sqlite:database.sqlite', '', '', [
    // PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'utf8mb4\'',
    // PDO::ATTR_EMULATE_PREPARES => false,
    // PDO::ATTR_STRINGIFY_FETCHES => false,
    // PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]]);

Flight::route('/', [AccessController::class, 'index']);
Flight::route('/logout', [AccessController::class, 'logout']);
Flight::route('/translation', [Translate::class, 'newTranslation']);
Flight::route('/translate', [Translate::class, 'googleTranslate']);
Flight::route('/practiceInfo', [Translate::class, 'getLatestPracticeInfo']);
Flight::route('/practice', [Translate::class, 'getLatestPractice']);
Flight::route('/saveTranslation', [Translate::class, 'saveTranslation']);
Flight::route('/home', [HomeController::class, 'index']);
Flight::route('/get_latest_news', [SelkoSuomiParser::class, 'getLatestNews']);
Flight::route('/install', [InstallController::class, 'index']);

Flight::start();

?>
