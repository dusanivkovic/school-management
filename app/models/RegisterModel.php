<?php
namespace app\models;
use app\helpers\Db;
use app\helpers\Session;

class RegisterModel extends Db
{
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

    public function findUserByUserId ($id)
    {
        $sql = "SELECT * FROM teachers WHERE user_id = ?";
        $stmt = $this->db->query($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $stmt->close();

        return $result->num_rows > 0 ? $user : false;
    }

    public function registerUser (): bool
    {
        $hashPassword = password_hash($this->data['password'], PASSWORD_DEFAULT);
        $classTeacher = $this->data['class'] == 'Разред' ? '' : $this->data['class'] . $this->data['department'][0];
        $sql = 'INSERT INTO teachers (`full_name`, `email`, `password`, `class_teacher`) VALUES (?, ?, ?, ?)';
        $stmt = $this->db->query($sql);
        $stmt->bind_param('ssss', $this->data['fullname'], $this->data['email'], $hashPassword, $classTeacher);

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

    public function editUser ($userId, $fullName, $email, $password, $classTeacher)
    {
        $fullName = $this->db->conn->real_escape_string($fullName);
        $email = $this->db->conn->real_escape_string($email);
        $password = $this->db->conn->real_escape_string(password_hash($password, PASSWORD_DEFAULT));
        $classTeacher = $this->db->conn->real_escape_string($classTeacher);

        $sql = "UPDATE teachers SET full_name = ?, email = ?, password = ?, class_teacher = ?  WHERE user_id = ?";
        $stmt = $this->db->query($sql);
        $stmt->bind_param('ssssi', $fullName, $email, $password, $classTeacher, $userId);

        return $this->db->stmt->execute() ? true : false;
    }

    public function editClassTeacher ($classTeacher, $userId)
    {
        $sql = "UPDATE teachers SET class_teacher = ? WHERE user_id = ?";
        $stmt = $this->db->query($sql);
        $stmt->bind_param('si', $classTeacher, $userId);

        return $this->db->stmt->execute() ? true : false;
    }

    public function importUserData ()
    {
        
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

    public function getUserId(): string
    {
        return $this->data['userId'];
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

    public function getClass()
    {
        return $this->data['class'] ?? NULL;
    }

    public function setClass($class): void
    {
        $this->data['class'] = $class;
    }
    
    public function getDepartment()
    {
        return $this->data['department'][0] ?? NULL;
    }

    public function setDepartment($class): void
    {
        $this->data['department'] = $class;
    }

}