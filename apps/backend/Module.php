<?php

namespace Modules\Backend;

use Modules\Backend\Plugins\MyResizer;
use \Phalcon\Events\Manager;
use \Phalcon\Mvc\Dispatcher;
use \Phalcon\Loader;
use \Phalcon\Mvc\View;
use \Phalcon\Mvc\View\Engine\Smarty;
use \Phalcon\Mvc\View\Engine\Volt;


class Module
{

	public function registerAutoloaders($loader)
	{

		$loader = new Loader();

		$loader->registerNamespaces(array(
			'Modules\Backend\Controllers'   => _APPS_BACK_CONTROLLERS_DIR_,
			'Modules\Models'                => _MODELS_DIR_,
			'Modules\Backend\Plugins'       => _APPS_BACK_PLUGINS_DIR_,
            'Phalcon'                       => _PHALCON_DIR_
		))->register();
	}

	public function registerServices($di)
	{
		$di->set('dispatcher', function () {

            $eventsManager = new Manager();
            $eventsManager->attach("dispatch:beforeException", function ($event, $dispatcher, $exception) {

                //Handle 404 exceptions
                if ($exception instanceof \Phalcon\Mvc\Dispatcher\Exception) {
                    $dispatcher->forward(array(
                        'controller' => 'index',
                        'action'     => 'route404'
                    ));

                    return FALSE;
                }

                //Handle other exceptions
                $dispatcher->forward(array(
                    'controller' => 'index',
                    'action'     => 'route503'
                ));

                return FALSE;
            });

            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace("Modules\Backend\Controllers");

            //Bind the EventsManager to the dispatcher
            $dispatcher->setEventsManager($eventsManager);

            return $dispatcher;
        });

		/**
		 * Setting up the view component
		 */
		$di->set('view', function () {

            $view = new View();

            $view->registerEngines(array(
                '.tpl' => function($view, $di) {

                    $smarty = new Smarty($view, $di);

                    $smarty->setOptions([
                        'template_dir'		=> $view->getViewsDir(),
                        'compile_dir'		=> __DIR__ . '/cache/',
                        'error_reporting'	=> error_reporting() ^ E_NOTICE,
                        'escape_html'		=> true,
                        '_file_perms'		=> 0666,
                        '_dir_perms'		=> 0777,
                        'force_compile'		=> false,
                        'compile_check'		=> true,
                        'caching'			=> false,
                        'debugging'			=> true,
                    ]);

                    return $smarty;
                },
                '.volt'  => function ($view, $di) {

                    $volt = new Volt($view, $di);

                    $volt->setOptions(array(
                        'compiledPath'      => __DIR__ . '/cache/',
                        'compiledSeparator' => '_',
                        'compileAlways'     => TRUE // close it
                    ));

                    return $volt;
                },
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php'
            ));

            $view->setViewsDir(_APPS_BACK_VIEW_DIR_);
			$view->setLayoutsDir(_APPS_DIR_.'common/layouts/');
			$view->setTemplateAfter('main');

            return $view;
        });

		//Resizer
        $di->set('my_resizer', function() {
            return new MyResizer();
        });
	}

}