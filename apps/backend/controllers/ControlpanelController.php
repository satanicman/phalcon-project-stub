<?php

namespace Modules\Backend\Controllers;

use Modules\Controllers\AdminController;

class ControlpanelController extends AdminController
{
	public function indexAction()
	{
	}

	public function setMedia()
    {
        parent::setMedia();
        parent::addCSS('test');
    }
}