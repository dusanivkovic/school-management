<?php
namespace app\models;
use app\models\Db;

class RegisterModel extends Db
{
    const FULL_NAME = 'Name is required';
    const PASSWORD_REQUIRED = 'Password is required';
    const PASSWORD_MIN = 'Password must be at least 8 characters long';
    const EMAIL_REQUIRED = 'Email is required';
    const PASSWORD_MATCH = 'Password does not match';
    const EMAIL_FORMAT = 'Invalid email format';
    public array $errors = [];
    public array $data = [];
    //public Db $db;

    // public function __construct($postData)
    // {
    //     $this->data =  $postData;
    // }

    public  function loadData($postData)
    {
        $this->data = $postData;
        //return self::$data;
    }

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