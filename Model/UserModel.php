<?php
namespace Model;

use Lib\Registry;
use PDO;

class UserModel
{
    public function saveUser($login, $hash_password, $email, $active){

        $data = $this->getUser($login, $hash_password);

        if( $data ){
            return false;
        } else {
            /** @var PDO $dbh */
            $dbh = Registry::get('dbh');
            /** statement handler */
            $sth = $dbh->prepare("INSERT INTO users (login, hash_password, email, active)
                                       VALUES (:login, :password, :email, :active)");
            $params = array("login"    => $login,
                            "password" => $hash_password,
                            "email"    => $email,
                            "active"   => $active);
            $sth->execute($params);
            return true;
        }
    }

    public function getUser($login, $hash_password){

        /** @var PDO $dbh */
        $dbh = Registry::get('dbh');
        /** statement handler */
        $sth = $dbh->prepare("SELECT * FROM users WHERE login         = :login
                                                    AND hash_password = :password
                                                    AND active        = :is_active");
        $params = array('login'     => $login,
                        'password'  => $hash_password,
                        'is_active' => (int)1,);
        $sth->execute($params);
        $data = $sth->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
}