<?php
namespace Modules\Models;

class Validate
{
    const ADMIN_PASSWORD_LENGTH = 8;
    const PASSWORD_LENGTH = 5;

    public static function isIp2Long($ip)
    {
        return preg_match('#^-?[0-9]+$#', (string)$ip);
    }

    public static function isAnything()
    {
        return true;
    }

    /**
     * Check for e-mail validity
     *
     * @param string $email e-mail address to validate
     * @return bool Validity is ok or not
     */
    public static function isEmail($email)
    {
        return !empty($email) && preg_match(Tools::cleanNonUnicodeSupport('/^[a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]+[.a-z\p{L}0-9!#$%&\'*+\/=?^`{}|~_-]*@[a-z\p{L}0-9]+(?:[.]?[_a-z\p{L}0-9-])*\.[a-z\p{L}0-9]+$/ui'), $email);
    }

    /**
     * Check for MD5 string validity
     *
     * @param string $md5 MD5 string to validate
     * @return bool Validity is ok or not
     */
    public static function isMd5($md5)
    {
        return preg_match('/^[a-f0-9A-F]{32}$/', $md5);
    }

    /**
     * Check for SHA1 string validity
     *
     * @param string $sha1 SHA1 string to validate
     * @return bool Validity is ok or not
     */
    public static function isSha1($sha1)
    {
        return preg_match('/^[a-fA-F0-9]{40}$/', $sha1);
    }

    /**
     * Check for a float number validity
     *
     * @param float $float Float number to validate
     * @return bool Validity is ok or not
     */
    public static function isFloat($float)
    {
        return strval((float)$float) == strval($float);
    }

    public static function isUnsignedFloat($float)
    {
        return strval((float)$float) == strval($float) && $float >= 0;
    }

    /**
     * Check for a float number validity
     *
     * @param float $float Float number to validate
     * @return bool Validity is ok or not
     */
    public static function isOptFloat($float)
    {
        return empty($float) || Validate::isFloat($float);
    }

    /**
     * Check for name validity
     *
     * @param string $name Name to validate
     * @return bool Validity is ok or not
     */
    public static function isName($name)
    {
        return preg_match(Tools::cleanNonUnicodeSupport('/^[^0-9!<>,;?=+()@#"°{}_$%:]*$/u'), stripslashes($name));
    }

    /**
     * Check for sender name validity
     *
     * @param string $mail_name Sender name to validate
     * @return bool Validity is ok or not
     */
    public static function isMailName($mail_name)
    {
        return (is_string($mail_name) && preg_match(Tools::cleanNonUnicodeSupport('/^[^<>;=#{}]*$/u'), $mail_name));
    }

    /**
     * Check for e-mail subject validity
     *
     * @param string $mail_subject e-mail subject to validate
     * @return bool Validity is ok or not
     */
    public static function isMailSubject($mail_subject)
    {
        return preg_match(Tools::cleanNonUnicodeSupport('/^[^<>]*$/u'), $mail_subject);
    }

    /**
     * Check for a message validity
     *
     * @param string $message Message to validate
     * @return bool Validity is ok or not
     */
    public static function isMessage($message)
    {
        return !preg_match('/[<>{}]/i', $message);
    }

    /**
     * Check for a link (url-rewriting only) validity
     *
     * @param string $link Link to validate
     * @return bool Validity is ok or not
     */
    public static function isLinkRewrite($link)
    {
        if (Configuration::get('PS_ALLOW_ACCENTED_CHARS_URL')) {
            return preg_match(Tools::cleanNonUnicodeSupport('/^[_a-zA-Z0-9\pL\pS-]+$/u'), $link);
        }
        return preg_match('/^[_a-zA-Z0-9\-]+$/', $link);
    }

    /**
     * Check for search query validity
     *
     * @param string $search Query to validate
     * @return bool Validity is ok or not
     */
    public static function isValidSearch($search)
    {
        return preg_match(Tools::cleanNonUnicodeSupport('/^[^<>;=#{}]{0,64}$/u'), $search);
    }

    /**
     * Check for standard name validity
     *
     * @param string $name Name to validate
     * @return bool Validity is ok or not
     */
    public static function isGenericName($name)
    {
        return empty($name) || preg_match(Tools::cleanNonUnicodeSupport('/^[^<>={}]*$/u'), $name);
    }

    /**
     * Check for HTML field validity (no XSS please !)
     *
     * @param string $html HTML field to validate
     * @return bool Validity is ok or not
     */
    public static function isCleanHtml($html, $allow_iframe = false)
    {
        $events = 'onmousedown|onmousemove|onmmouseup|onmouseover|onmouseout|onload|onunload|onfocus|onblur|onchange';
        $events .= '|onsubmit|ondblclick|onclick|onkeydown|onkeyup|onkeypress|onmouseenter|onmouseleave|onerror|onselect|onreset|onabort|ondragdrop|onresize|onactivate|onafterprint|onmoveend';
        $events .= '|onafterupdate|onbeforeactivate|onbeforecopy|onbeforecut|onbeforedeactivate|onbeforeeditfocus|onbeforepaste|onbeforeprint|onbeforeunload|onbeforeupdate|onmove';
        $events .= '|onbounce|oncellchange|oncontextmenu|oncontrolselect|oncopy|oncut|ondataavailable|ondatasetchanged|ondatasetcomplete|ondeactivate|ondrag|ondragend|ondragenter|onmousewheel';
        $events .= '|ondragleave|ondragover|ondragstart|ondrop|onerrorupdate|onfilterchange|onfinish|onfocusin|onfocusout|onhashchange|onhelp|oninput|onlosecapture|onmessage|onmouseup|onmovestart';
        $events .= '|onoffline|ononline|onpaste|onpropertychange|onreadystatechange|onresizeend|onresizestart|onrowenter|onrowexit|onrowsdelete|onrowsinserted|onscroll|onsearch|onselectionchange';
        $events .= '|onselectstart|onstart|onstop';

        if (preg_match('/<[\s]*script/ims', $html) || preg_match('/('.$events.')[\s]*=/ims', $html) || preg_match('/.*script\:/ims', $html)) {
            return false;
        }

        if (!$allow_iframe && preg_match('/<[\s]*(i?frame|form|input|embed|object)/ims', $html)) {
            return false;
        }

        return true;
    }

    /**
     * Check for password validity
     *
     * @param string $passwd Password to validate
     * @param int $size
     * @return bool Validity is ok or not
     */
    public static function isPasswd($passwd, $size = Validate::PASSWORD_LENGTH)
    {
        return (strlen($passwd) >= $size && strlen($passwd) < 255);
    }

    public static function isPasswdAdmin($passwd)
    {
        return Validate::isPasswd($passwd, Validate::ADMIN_PASSWORD_LENGTH);
    }

    /**
     * Check for boolean validity
     *
     * @param bool $bool Boolean to validate
     * @return bool Validity is ok or not
     */
    public static function isBool($bool)
    {
        return $bool === null || is_bool($bool) || preg_match('/^(0|1)$/', $bool);
    }

    /**
     * Check for phone number validity
     *
     * @param string $number Phone number to validate
     * @return bool Validity is ok or not
     */
    public static function isPhoneNumber($number)
    {
        return preg_match('/^[+0-9. ()-]*$/', $number);
    }

    /**
     * Check for an integer validity
     *
     * @param int $value Integer to validate
     * @return bool Validity is ok or not
     */
    public static function isInt($value)
    {
        return ((string)(int)$value === (string)$value || $value === false);
    }

    /**
     * Check for an integer validity (unsigned)
     *
     * @param int $value Integer to validate
     * @return bool Validity is ok or not
     */
    public static function isUnsignedInt($value)
    {
        return ((string)(int)$value === (string)$value && $value < 4294967296 && $value >= 0);
    }

    /**
     * Check for an integer validity (unsigned)
     * Mostly used in database for auto-increment
     *
     * @param int $id Integer to validate
     * @return bool Validity is ok or not
     */
    public static function isUnsignedId($id)
    {
        return Validate::isUnsignedInt($id); /* Because an id could be equal to zero when there is no association */
    }

    public static function isNullOrUnsignedId($id)
    {
        return $id === null || Validate::isUnsignedId($id);
    }

    /**
     * Check url validity (disallowed empty string)
     *
     * @param string $url Url to validate
     * @return bool Validity is ok or not
     */
    public static function isUrl($url)
    {
        return preg_match(Tools::cleanNonUnicodeSupport('/^[~:#,$%&_=\(\)\.\? \+\-@\/a-zA-Z0-9\pL\pS-]+$/u'), $url);
    }

    /**
     * Check url validity (allowed empty string)
     *
     * @param string $url Url to validate
     * @return bool Validity is ok or not
     */
    public static function isUrlOrEmpty($url)
    {
        return empty($url) || Validate::isUrl($url);
    }

    /**
     * Check if URL is absolute
     *
     * @param string $url URL to validate
     * @return bool Validity is ok or not
     */
    public static function isAbsoluteUrl($url)
    {
        if (!empty($url)) {
            return preg_match('/^(https?:)?\/\/[$~:;#,%&_=\(\)\[\]\.\? \+\-@\/a-zA-Z0-9]+$/', $url);
        }
        return true;
    }

    /**
     * Check for standard name file validity
     *
     * @param string $name Name to validate
     * @return bool Validity is ok or not
     */
    public static function isFileName($name)
    {
        return preg_match('/^[a-zA-Z0-9_.-]+$/', $name);
    }

    /**
     * Check for standard name directory validity
     *
     * @param string $dir Directory to validate
     * @return bool Validity is ok or not
     */
    public static function isDirName($dir)
    {
        return (bool)preg_match('/^[a-zA-Z0-9_.-]*$/', $dir);
    }

    /**
     * Check for admin panel tab name validity
     *
     * @param string $name Name to validate
     * @return bool Validity is ok or not
     */
    public static function isTabName($name)
    {
        return preg_match(Tools::cleanNonUnicodeSupport('/^[^<>]+$/u'), $name);
    }

    /**
     * Price display method validity
     *
     * @param string $data Data to validate
     * @return bool Validity is ok or not
     */
    public static function isString($data)
    {
        return is_string($data);
    }

    public static function isControllerName($name)
    {
        return (bool)(is_string($name) && preg_match(Tools::cleanNonUnicodeSupport('/^[0-9a-zA-Z-_]*$/u'), $name));
    }
}
