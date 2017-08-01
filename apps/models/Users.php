<?php

namespace Modules\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf;

class Users extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=11, nullable=false)
     */
    public $id_user;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=false)
     */
    public $firstname;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=false)
     */
    public $lastname;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $password;

    /**
     *
     * @var string
     * @Column(type="string", length=255, nullable=false)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=true)
     */
    public $phone;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $date_add;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    public $active = 1;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => '<strong>Ошибка!</strong> На валидный email адрес',
                ]
            )
        );

        $validator->add(
            'firstname',
            new PresenceOf(
                [
                    'model'   => $this,
                    'message' => '<strong>Ошибка!</strong> Поле "Имя" обязательно к заполнению',
                ]
            )
        );

        $validator->add(
            'lastname',
            new PresenceOf(
                [
                    'model'   => $this,
                    'message' => '<strong>Ошибка!</strong> Поле "Фамилия" обязательно к заполнению',
                ]
            )
        );

        $validator->add(
            'password',
            new PresenceOf(
                [
                    'model'   => $this,
                    'message' => '<strong>Ошибка!</strong> Поле "Пароль" обязательно к заполнению',
                ]
            )
        );

        $validator->add(
            'email',
            new PresenceOf(
                [
                    'model'   => $this,
                    'message' => '<strong>Ошибка!</strong> Поле "Email" обязательно к заполнению',
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]|Users
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public static function getUsers($status = 1)
    {

        $sql = "SELECT
                    *,
                    CONCAT(firstname, ' ', lastname) as name
                FROM users
                WHERE active = " . $status;

        return Db::execute($sql);
    }

}
