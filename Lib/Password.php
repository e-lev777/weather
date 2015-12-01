<?php
namespace Lib;

class Password
{
    const SALT = 'This is salt-text. 254682135';

    private $password;
    private $salt;
    private $hashPassword;

    public function __construct($password, $saltText = null){
        $this->password = $password;
        $this->salt = md5( is_null($saltText) ? self::SALT : $saltText );
        $this->hashPassword = md5( $this->salt.$password );
    }

    public function __toString(){
        return $this->hashPassword;
    }
}