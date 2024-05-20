<?php
namespace app\models;
use app\helpers\Db;

class RegisterModel extends Db
{
    // const FULL_NAME = 'Name is required';
    // const PASSWORD_REQUIRED = 'Password is required';
    // const PASSWORD_MIN = 'Password must be at least 8 characters long';
    // const EMAIL_REQUIRED = 'Email is required';
    // const PASSWORD_MATCH = 'Password does not match';
    // const EMAIL_FORMAT = 'Invalid email format';
    public array $errors = [];
    public array $data = [];
    public Db $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public  function loadData($postData)
    {
        $this->data = $postData;
        //return self::$data;
    }

    public function registerUser ()
    {
        $sql = 'INSERT INTO teachers (`full_name`, `email`, `password`, `subject`, `class_teacher`) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->db->query($sql);
        $hashPassword = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $stmt->bind_param('sssss', $this->data['fullname'], $this->data['email'], $hashPassword, $this->data['subject'], $this->data['classteacher']);
        $stmt->execute();
        // $stmt->close();
        // $this->db->conn->close();
        echo $this->db->stmt->execute() ? "<span style='color: green'>Registration Successful!</span>" : "<span style='color: red'>Registration Unsuccessful!</span>";

        // return $this->db->stmt->execute() ? true : false;
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

    public function addError($key, $message) 
    {
        $this->errors[$key] = $message;
    }

}