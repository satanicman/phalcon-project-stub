<?php

namespace Modules\Frontend\Controllers;


class IndexController extends ControllerBase
{

    public function indexAction()
    {
    }

    public function route404Action() {
        echo "<pre>";
        print_r('error');
        echo "</pre>";
        die();
    }

}

