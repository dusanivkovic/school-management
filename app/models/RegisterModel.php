<?php
namespace app\models;
use app\helpers\Db;
use app\helpers\Session;

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
    private Db $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public  function loadData($postData)
    {
        $this->data = $postData;
        //return self::$data;
    }

    public function findUserByEmail ()
    {
        $sql = "SELECT * FROM teachers WHERE email = ?";
        $stmt = $this->db->query($sql);
        $stmt->bind_param('s', $this->data['email']);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();
        // $this->db->conn->close();
        return $result->num_rows > 0 ? $user : false;
    }

    public function registerUser (): bool
    {
        $hashPassword = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $sql = 'INSERT INTO teachers (`full_name`, `email`, `password`, `subject`, `class_teacher`) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->db->query($sql);
        $stmt->bind_param('sssss', $this->data['fullname'], $this->data['email'], $hashPassword, $this->data['subject'], $this->data['classteacher']);
        // $stmt->close();
        // $this->db->conn->close();

        return $this->db->stmt->execute() ? true : false;
    }

    public function checkUserExsist ()
    {
        $password = $this->data['password'];
        $user = $this->findUserByEmail();
        $hashPassword = $user['password'];
        $verify = password_verify($password, $hashPassword);
        return ($user && $verify) ? true : false;
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