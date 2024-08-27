<?php
namespace app\models;
use app\helpers\Db;

class TestModel extends Db
{
    public Db $db;
    public array $data;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function registerTest ($subject, $classes, $testType, $termin, $userId ): bool
    {
        $sql = 'INSERT INTO testes (`subject`, `class`, `test_type`, `termin`, `user_id`) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->db->query($sql);
        foreach ($classes as $class)
        {
        $stmt->bind_param('sssss', $subject, $class, $testType, $termin, $userId);
        $result = $stmt->execute();
        }

        return $result ? true : false;
    }

    public function findAllTestesForUser ($id)
    {
        $sql = "SELECT * FROM testes WHERE user_id = ?";
        $stmt = $this->db->query($sql);
        $stmt->bind_param('s', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $testes = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $testes;
    }

    public function deleteTest ($id): bool
    {
        $sql = "DELETE FROM testes WHERE id = ?";
        $stmt = $this->db->query($sql);
        $stmt->bind_param('i', $id);
        //$stmt->close();
        return $this->db->stmt->execute() ? true : false;
    }

    public function findTestById ($id)
    {
        $sql = "SELECT * FROM testes WHERE id = ?";
        $stmt = $this->db->query($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $test = $result->fetch_assoc();
        $stmt->close();

        return $result->num_rows > 0 ? $test : false;
    }

    public function updateTest ($subject, $class, $testType, $termin, $id)
    {
        $subject = $this->db->conn->real_escape_string($subject);
        $class = $this->db->conn->real_escape_string($class);
        $testType = $this->db->conn->real_escape_string($testType);
        $termin = $this->db->conn->real_escape_string($termin);

        $sql = "UPDATE testes SET subject = ?, class = ?, test_type = ?, termin = ?  WHERE id = ?";
        $stmt = $this->db->query($sql);
        $stmt->bind_param('ssssi', $subject, $class, $testType, $termin, $id);

        return $this->db->stmt->execute() ? true : false;
    }
}