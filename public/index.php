<?php

error_reporting(E_ALL);
require_once(dirname(__FILE__).'/config/defines.inc.php');
include_once _LIBS_DIR_."smarty/Smarty.class.php";

ini_set('default_charset', 'utf-8');
ini_set('magic_quotes_runtime', 0);
ini_set('magic_quotes_sybase', 0);

/* correct Apache charset (except if it's too late */
if (!headers_sent()) {
    header('Content-Type: text/html; charset=utf-8');
}

try {

    /**
     * Read configuration
     */
    $config = include _PUBLIC_DIR_."/config/config.php";

    /**
     * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
     */
    $di = new \Phalcon\DI\FactoryDefault();

    /**
     * Registering a router
     */
    $di->set('router', function () {

        $router = new \Phalcon\Mvc\Router(FALSE);
        $router->removeExtraSlashes(TRUE);
        $router->setDefaultModule("backend");

        //Set 404 paths
        $router->notFound(array(
            "controller" => "index",
            "action" => "route404"
        ));

        $route = $router->add('/admin', array(
            'module' => 'backend',
            'controller' => 'index',
            'action' => 'index'
        ));
        $route->setName("admin");

        $router->add('/admin/logout', array(
            'module' => 'backend',
            'controller' => 'index',
            'action' => 'logout'
        ));

        $router->add('/admin/:controller/:action/:params', array(
            'module' => 'backend',
            'controller' => 1,
            'action' => 2,
            'params' => 3
        ));

        $route = $router->add('admin/404', array(
            'module' => 'backend',
            "controller" => "index",
            "action" => "route404"
        ));
        $route->setName("backend-404");

        $router->add('/', array(
            'module' => 'frontend',
            'controller' => 'category',
            'action' => 'show',
            'id_category' => 27
        ));


        return $router;
    });

    /**
     * The URL component is used to generate all kind of urls in the application
     */
    $di->set('url', function () {
        $url = new \Phalcon\Mvc\Url();
        $url->setBaseUri('/');

        return $url;
    });

    /**
     * Database connection is created based in the parameters defined in the configuration file
     */
    $di->set('db', function () use ($config) {
        $connection = new \Phalcon\Db\Adapter\Pdo\Mysql(array(
            "host" => $config->database->host,
            "username" => $config->database->username,
            "password" => $config->database->password,
            "dbname" => $config->database->dbname,
            'charset'  => "utf8"
        ));

        if (_MODE_DEV_) {
            $eventsManager = new \Phalcon\Events\Manager();
            $logger = new \Phalcon\Logger\Adapter\File("./sql_debug.log");
            //Listen all the database events
            $eventsManager->attach('db', function ($event, $connection) use ($logger) {
                if ($event->getType() == 'beforeQuery') {
                    $logger->log($connection->getSQLStatement(), \Phalcon\Logger::INFO);
                }
            });
            //Assign the eventsManager to the db adapter instance
            $connection->setEventsManager($eventsManager);
        }
        return $connection;
    }, true);

    /**
     * Start the session the first time some component request the session service
     */
    $di->set('session', function () {
        $session = new \Phalcon\Session\Adapter\Files();
        $session->start();
        return $session;
    }, true);

    $di->set('flash', function (){
        $flash = new \Phalcon\Flash\Session([
            //tie in with twitter bootstrap classes
            'error'     => 'alert alert-danger',
            'success'   => 'alert alert-success',
            'notice'    => 'alert alert-info',
            'warning'   => 'alert alert-warning'
        ]);

        $flash->setAutoescape(false);

        return $flash;
    });

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application();

    $application->setDI($di);

    /**
     * Register application modules
     */
    $application->registerModules(array(
        'frontend' => array(
            'className' => 'Modules\Frontend\Module',
            'path' => '../apps/frontend/Module.php'
        ),
        'backend' => array(
            'className' => 'Modules\Backend\Module',
            'path' => '../apps/backend/Module.php'
        )
    ));

    echo $application->handle()->getContent();


} catch (Phalcon\Exception $e) {
    echo $e->getMessage();
} catch (PDOException $e) {
    echo $e->getMessage();
}