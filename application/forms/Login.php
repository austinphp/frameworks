<?php
class Form_Login extends Zend_Form
{
    public function __construct()
    {
        parent::__construct();

        $this->setMethod('POST');
        $this->setAction('/admin/login');

        $username = $this->createElement('text', 'username');
        $username->setRequired(true)
                 ->setLabel('Username: ');

        $password = $this->createElement('password', 'password');
        $password->setRequired(true)
                 ->setLabel('Password: ');

        $submit = $this->createElement('submit', 'login');

        $this->addElement($username)
             ->addElement($password)
             ->addElement($submit);
    }
}