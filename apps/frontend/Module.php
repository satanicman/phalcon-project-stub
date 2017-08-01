<?php

namespace Modules\Frontend;

class Module
{

	public function registerAutoloaders()
	{

		$loader = new \Phalcon\Loader();

		$loader->registerNamespaces(array(
			'Modules\Frontend\Controllers' => __DIR__ . '/controllers/',
			'Modules\Models'      => __DIR__ . '/../models/',
		));

		$loader->register();
	}

	public function registerServices($di)
	{
		$di['dispatcher'] = function () {
			$dispatcher = new \Phalcon\Mvc\Dispatcher();
			$dispatcher->setDefaultNamespace("Modules\Frontend\Controllers");

			return $dispatcher;
		};

		/**
		 * Setting up the view component
		 */
		$di['view'] = function () {

			$view = new \Phalcon\Mvc\View();

			$view->registerEngines(array(
				'.volt'  => function ($view, $di) {

					$volt = new \Phalcon\Mvc\View\Engine\Volt($view, $di);

					$volt->setOptions(array(
						'compiledPath'      => __DIR__ . '/cache/',
						'compiledSeparator' => '_',
						'compileAlways'     => TRUE // close it
					));

					//Add Functions
					$volt->getCompiler()->addFunction('strtotime', 'strtotime');
                    $volt->getCompiler()->addFunction('getDate', function ($date) {
                        return "Modules\\Models\\Tools::getDate({$date})";
                    });
					$volt->getCompiler()->addFunction('truncate', function($str) {
					    return "Modules\\Models\\Tools::truncate({$str})";
                    });
					$volt->getCompiler()->addFunction('pluralcomments', function($str) {
					    return "Modules\\Models\\Tools::pluralFormComments({$str})";
                    });
					$volt->getCompiler()->addFunction('makemenu', function($str) {
					    return "Modules\\Models\\Tools::makeMenu({$str})";
                    });

					return $volt;
				},
				'.phtml' => 'Phalcon\Mvc\View\Engine\Php'
			));

			$view->setViewsDir(__DIR__ . '/views/');
			$view->setLayoutsDir('../../common/layouts/');
			$view->setTemplateAfter('main');

			return $view;
		};

	}

}