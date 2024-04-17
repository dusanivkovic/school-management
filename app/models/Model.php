<?php
namespace app\models;
use app\models\Format;

class Model 
{
    const FULL_NAME = 'Name is required';
    const PASSWORD_REQUIRED = 'Password is required';
    const PASSWORD_MIN = 'Password must be at least 8 characters long';
    const EMAIL_REQUIRED = 'Email is required';
    const EMAIL_FORMAT = 'Invalid email format';
    public array $errors = [];

    public function labels()
    {
        return [];
    }

    public function getLabel($attribute)
    {
        return $this->labels()[$attribute] ?? $attribute;
    }
    // protected function validateFirstname() {
    //     $fullName = $this->fm->validation($this->data['fullname']);
    //     empty($fullName) ? $this->addError('fullname', self::FULL_NAME) : '';
    // }

    public function hasError ($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        $errors = $this->errors[$attribute] ?? [];
        return $errors[0] ?? '';
    }

    public function addError($key, $message) {
        $this->errors[$key] = $message;
    }

    public static function prntR ($attribute)
    {
        echo '<pre>';
        print_r($attribute) ;
        echo '</pre>';
    }

}