<?php
namespace Lib;

class LoginForm
{
    private $login ;
    private $password;
    private $errors = array();

    public function __construct(Request $_request){
        $this->login = $_request->post('login');
        $this->password = $_request->post('password');
    }

    public function validate(){
        $count = 0;
        if( empty($this->login) ){
            $this->errors['login'] = "Login field is empty";
            $count++;
        }
        if ( empty($this->password) ){
            $this->errors['password'] = "Password field is empty";
            $count++;
        }

        if( $count != 0 ){
            return false;
        }else {
            return true;
        }
    }

    public function showErrors(){
        return !empty($this->errors) ? $this->errors : null;
    }
}