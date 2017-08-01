<?php

namespace Modules\Frontend\Controllers;

use Modules\Models\Users;
use Modules\Models\Statistics;

class UserController extends ControllerBase
{
    protected $url = 'user';

    public function indexAction()
    {

    }


    /**
     * Session
     *
     * @param $user
     */
    private function _registerSession($user)
    {
        $this->session->set('user', array(
            'id_user'   => $user->id_user,
            'firstname'     => $user->firstname,
            'lastname'      => $user->lastname,
            'email'         => $user->email,
        ));
    }

    /**
     * Login
     *
     * @return bool|\Phalcon\Http\ResponseInterface
     */
    public function loginAction()
    {
        if ($this->request->isPost()) {

            //Receiving the variables sent by POST
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('passwd');
            $password = md5(_COOKIE_KEY_.$password);
            //Find the user in the database
            $user = Users::findFirst(array(
                "email = :email: AND password = :password: AND active = '1'",
                "bind" => [
                    'email' => $email,
                    'password' => $password
                ]
            ));

            if ($user != false) {

                $this->_registerSession($user);
                //Forward to the 'dashboard' controller if the user is valid
                return $this->response->redirect('user/statistics');
            }

            $this->flash->error('Неверно указанный логин или пароль');

            return true;
        }
    }

    public function statisticsAction() {
        $user = $this->session->get('user');
        if(!$user) {
            $this->response->redirect(["for" => "404"]);
            return false;
        }
        $statistic = Statistics::getBannersStatistics(false, false, false, false, false, $user['id_user']);
        $this->view->setVar('statistic', $statistic);
    }
}

