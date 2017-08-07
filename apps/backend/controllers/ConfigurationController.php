<?php

namespace Modules\Backend\Controllers;

use Modules\Models\Configuration;
use Modules\Controllers\AdminController;

class ConfigurationController extends AdminController
{
    protected $url = 'configuration';

    public function indexAction()
    {
        if($this->request->isPost()) {
            Configuration::updateValue('footer', $this->request->getPost('footer'));
            Configuration::updateValue('comment_count', (int)$this->request->getPost('comment_count'));
            Configuration::updateValue('comment_moderation', (int)$this->request->getPost('comment_moderation'));
            Configuration::updateValue('page_count', (int)$this->request->getPost('page_count'));
        }

        $configuration = Configuration::find()->toArray();

        foreach ($configuration as $key => $item) {
            $configuration[$item['name']] = $item['value'];
            unset($configuration[$key]);
        }

        $this->view->setVar("configuration", $configuration);
    }

}

