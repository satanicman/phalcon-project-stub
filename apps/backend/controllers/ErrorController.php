<?php

namespace Modules\Backend\Controllers;

use Modules\Models\Employee;
use Modules\Models\Tab;
use Modules\Controllers\AdminController;

class ErrorController extends AdminController
{
    public $php_self = 'error-page';

    public function route404Action()
    {
        echo "<pre>";
        print_r('404');
        echo "</pre>";
        die();
    }

    public function route503Action()
    {
        echo "<pre>";
        print_r(503);
        echo "</pre>";
        die();
    }
}

