<?php
namespace Modules\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator;

class Employee extends ObjectModel
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(type="integer", length=10, nullable=false)
     */
    public $id_employee;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    public $lastname;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    public $firstname;

    /**
     *
     * @var string
     * @Column(type="string", length=128, nullable=false)
     */
    public $email;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=false)
     */
    public $password;

    /**
     *
     * @var integer
     * @Column(type="integer", length=1, nullable=false)
     */
    public $active;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $registration_date;

    /**
     *
     * @var string
     * @Column(type="string", nullable=false)
     */
    public $last_login_date;

    /**
     *
     * @var string
     * @Column(type="string", length=32, nullable=true)
     */
    public $last_ip_address;

    public function onConstruct($id = null)
    {
        parent::onConstruct($id);
    }

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
            new Email(
                [
                    'model'   => $this,
                    'message' => '<strong>Error!</strong> Please enter a correct email address',
                ]
            )
        );

        $validator->add(
            'password',
            new StringLength(
                [
                    "min"     => 2,
                    'model'   => $this,
                    'message' => '<strong>Error!</strong> Password can not be too short',
                ]
            )
        );

        return $this->validate($validator);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'employee';
    }

    public static function isActive($id_employee)
    {
        $sql = '
            SELECT e.active 
            FROM Modules\Models\Employee e 
            WHERE id_employee = :id_employee:
        ';
        $result = Db::getInstance()->executeQuery($sql, ['id_employee' => $id_employee])->getFirst();

        if(!$result || !$result->active)
            return false;

        return true;
    }

    public static function checkAccess($email, $password)
    {
        $sql = '
            SELECT e.id_employee
            FROM Modules\Models\Employee e
            WHERE e.email = :email: AND password = :password:
        ';
        $result = Db::getInstance()->executeQuery($sql, ['email' => $email, 'password' => sha1($password)])->getFirst();

        if(!$result || !self::isActive($result->id_employee))
            return false;

        return $result->id_employee;
    }

    public function setLastVisit($ip)
    {
        $this->last_ip_address = $ip;
        $this->last_login_date = date("Y-m-d H:i:s");
        try {
            $this->update();
        }
        catch(\Exception $e )
        {
            echo "<pre>";
            print_r($e->getmessage());
            echo "</pre>";
            die();
        }
        catch ( \PDOException $b )
        {
            echo "<pre>";
            print_r($b->getmessage());
            echo "</pre>";
            die();
        }
    }
}
