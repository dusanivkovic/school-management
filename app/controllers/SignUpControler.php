<?php
namespace app\controllers;

use app\models\RegisterModel;

class SignUpControler extends RegisterModel
{
    public string $fullName;
    public string $password;
    public string $email;
    public string $subject;
    public string $classTeacher;
    public RegisterModel $rm;
    public function __construct($postData)
    {
        // $this->fullName = $fullName;
        // $this->email = $email;
        // $this->password = $password;
        // $this->subject = $subject;
        // $this->classTeacher = $classTeacher;
        //parent::__construct($postData);  
        $this->loadData($postData);
    }

    public function validation($postData)
    {

        $data = trim($postData);
        $data = stripcslashes($postData);
        $data = htmlspecialchars($postData);
        return $data;
    }

    protected function validateFullname() {
        $fullName = $this->validation($this->data['fullname']);
        empty($fullName) ? self::addError('fullname', self::FULL_NAME) : '';
    }

    protected function validateEmail() {
        $email = $this->validation($this->data['email']);
        if (empty($email)) 
        {
            self::addError('email-empty', self::EMAIL_REQUIRED);
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            self::addError('email-format', self::EMAIL_FORMAT);
        }
    }

    protected function validatePassword() {
        $password = $this->data['password'];

        if (empty($password)) {
            $this->addError('password', self::PASSWORD_REQUIRED);
        } elseif (strlen($password) < 8) {
            $this->addError('password', self::PASSWORD_MIN);
        }
    }

    protected function validatePasswordMatch ()
    {
        $password = $this->data['password'];
        $confirmPassword = $this->data['passwordConfirm'];
        $password !== $confirmPassword ? $this->addError('confirm', self::PASSWORD_MATCH) : '';
    }

    public function signUp()
    {
		$this->validateFullname();
		$this->validateEmail();
        $this->validatePassword();
        $this->validatePasswordMatch();
        return $this->errors;
	}
}