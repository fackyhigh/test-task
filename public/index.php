<?php

use Phalcon\Di\FactoryDefault;
use Phalcon\Loader;
use Phalcon\Mvc\Application;
use Phalcon\Mvc\Url as UrlProvider;
use Phalcon\Mvc\View;
use Phalcon\Db\Adapter\MongoDB\Client;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

$loader = new Loader();
$loader->registerDirs(
    [
        APP_PATH . '/controllers/',
        APP_PATH . '/models/',
    ]
)->register();

$loader->registerNamespaces(
    [
        'Phalcon' => APP_PATH . '/vendors/Phalcon',
    ]
)->register();

$di = new FactoryDefault();

$di['view'] = function () {
    $view = new View();
    $view->setViewsDir(APP_PATH . '/views/');
    return $view;
};

$di['url'] = function () {
    $url = new UrlProvider();
    $url->setBaseUri('/');
    return $url;
};

$di->set(
    'mongo',
    function () {
        $mongo = new Client();

        return $mongo->selectDatabase('pwbox');
    },
    true
);

$di->set('collectionManager', function(){
    return new Phalcon\Mvc\Collection\Manager();
}, true);

try {
    $application = new Application($di);
    echo $application->handle()->getContent();
} catch (Exception $e) {
    echo "Exception: ", $e->getMessage();
}
