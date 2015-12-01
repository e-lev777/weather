<?php
namespace Lib;

class RegistrationForm
{
    private $login;
    private $email;
    private $password;
    private $password_confirm;
    private $errors = array();

    public function __construct(Request $_request){
        $this->login = $_request->post('login');
        $this->email = $_request->post('email');
        $this->password = $_request->post('password');
        $this->password_confirm = $_request->post('password_confirm');
    }

    public function passMatch(){
        return $this->password == $this->password_confirm;
    }

    public function getLogin(){
        return isset($this->login) ? $this->login : null;
    }

    public function getEmail(){
        return isset($this->email) ? $this->email : null;
    }

    public function validate(){
        $count = 0;

        if( empty($this->login) ) {
            $this->errors['login'] = "Login field is empty";
            $count++;
        }
        if ( empty($this->email) ) {
            $this->errors['email'] = "E-mail field is empty";
            $count++;
        }
        if ( empty($this->password) ) {
            $this->errors['password'] = "Password field is empty";
            $count++;
        }
        if( empty($this->password_confirm) ) {
            $this->errors['password_confirm'] = "Confirm field is empty";
            $count++;
        }
        if( !$this->passMatch() ){
            $this->errors['pass_match'] = "Field password doesn't match field confirm password";
            $count++;
        }

        if( $count != 0 ){
           return false;
        } else {
            return true;
        }
    }

    public function showError(){
        return $this->errors;
    }
}