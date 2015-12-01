<?php
namespace Lib;

use Lib\Request;

class ContactForm
{
    public $firstName;
    public $lastName;
    public $email;
    public $phone;
    public $address;
    public $message;
    public $errors = [];



    public function __construct(){
        $_request = new Request();
        $this->firstName = $_request->post('firstName');
        $this->lastName  = $_request->post('lastName');
        $this->email     = $_request->post('email');
        $this->phone     = $_request->post('phone');
        $this->address   = $_request->post('address');
        $this->message   = $_request->post('message');
    }

    public function isValid()
    {
        if( empty($this->firstName) ) {
            $this->errors['firstName'] = 'Field first name is empty';
        }
        if ( empty($this->lastName) ) {
            $this->errors['lastName'] = 'Field last name is empty';
        }
        if ( empty($this->email) ) {
            $this->errors['email'] = 'Field e-mail is empty';
        }
        if ( empty($this->phone) ) {
            $this->errors['phone'] = 'Field phone is empty';
        }
        if ( empty($this->address) ) {
            $this->errors['address'] = 'Field address is empty';
        }
        if ( empty($this->message) ) {
            $this->errors['message'] = 'Field message is empty';
        } else {
            return true;
        }
    }

    public function showError(){
        return $this->errors;
    }
}