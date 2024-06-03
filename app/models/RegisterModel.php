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
        $classTeacher = $this->data['class'] . $this->data['department'][0];
        $sql = 'INSERT INTO teachers (`full_name`, `email`, `password`, `class_teacher`) VALUES (?, ?, ?, ?)';
        $stmt = $this->db->query($sql);
        $stmt->bind_param('ssss', $this->data['fullname'], $this->data['email'], $hashPassword, $classTeacher);
        // $stmt->close();
        // $this->db->conn->close();

        return $this->db->stmt->execute() ? true : false;
    }

    public function validateUserData (): bool
    {
        $password = $this->data['password'];
        $user = $this->findUserByEmail();
        if ($user)
        {
            $hashPassword = $user['password'];
            $verify = password_verify($password, $hashPassword);
            return ($user && $verify) ? true : false;
        }
        return false;
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

    public function getName(): string
    {
        return $this->data['fullname'];
    }

    public function setName($name): void
    {
        $this->data['fullname'] = $name;
    }

    public function getMail(): string
    {
        return $this->data['email'];
    }

    public function setMail($mail): void
    {
        $this->data['email'] = $mail;
    }

    public function getPassword(): string
    {
        return $this->data['password'];
    }

    public function setPassword($password): void
    {
        $this->data['password'] = $password;
    }

    public function getClassTeacher(): string
    {
        return $this->data['classteacher'];
    }

    public function setClassTeacher($classTeacher): void
    {
        $this->data['classteacher'] = $classTeacher;
    }

}