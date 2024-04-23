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
    public function __construct()
    {
        // $this->fullName = $fullName;
        // $this->email = $email;
        // $this->password = $password;
        // $this->subject = $subject;
        // $this->classTeacher = $classTeacher;
        //parent::__construct($postData);  

        $this->rm = new RegisterModel();

    }

    public function validation($postData)
    {

        $data = trim($postData);
        $data = stripcslashes($postData);
        $data = htmlspecialchars($postData);
        return $data;
    }

    protected function validateFullname() {
        $fullName = $this->validation($this->rm->data['fullname']);
        empty($fullName) ? $this->rm->addError('fullname', self::FULL_NAME) : '';
    }

    protected function validateEmail() {
        $email = $this->validation($this->rm->data['email']);
        if (empty($email)) 
        {
            $this->rm->addError('email-empty', self::EMAIL_REQUIRED);
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->rm->addError('email-format', self::EMAIL_FORMAT);
        }
    }

    protected function validatePassword() {
        $password = $this->rm->data['password'];

        if (empty($password)) {
            $this->rm->addError('password', self::PASSWORD_REQUIRED);
        } elseif (strlen($password) < 8) {
            $this->rm->addError('password', self::PASSWORD_MIN);
        }
    }

    protected function validatePasswordMatch ()
    {
        $password = $this->rm->data['password'];
        $confirmPassword = $this->rm->data['passwordConfirm'];
        $password !== $confirmPassword ? $this->rm->addError('confirm', self::PASSWORD_MATCH) : '';
    }

    public function signUpUser()
    {
		$this->validateFullname();
		$this->validateEmail();
        $this->validatePassword();
        $this->validatePasswordMatch();
        return $this->rm->errors;
	}
}