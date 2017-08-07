<?php

namespace Modules\Models;

use Phalcon\Validation;
use Phalcon\Validation\Message;
use Phalcon\Validation\Validator;

class LinkRewriteValidator extends Validator
{
    /**
     * Выполнение валидации
     *
     * @param Phalcon\Validation $validator
     * @param string $attribute
     * @return boolean
     */
    public function validate(Validation $validator, $attribute)
    {
        if (!preg_match('/^([_a-zA-Z0-9\-]+|#)$/', $validator->getValue($attribute))) {
            $message = $this->getOption("message");

            if (!$message) {
                $message = "Не правильный формат ЧПУ";
            }

            $validator->appendMessage(
                new Message($message, $attribute, "LinkRewrite")
            );

            return false;
        }

        return true;
    }

}