<?php

namespace Modules\Backend\Controllers;

class ControlpanelController extends ControllerBase
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