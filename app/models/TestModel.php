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

    public function registerTest ($subject, $class, $testType, $termin, $userId ): bool
    {
        $sql = 'INSERT INTO testes (`subject`, `class`, `test_type`, `termin`, `user_id`) VALUES (?, ?, ?, ?, ?)';
        $stmt = $this->db->query($sql);
        $stmt->bind_param('sssss', $subject, $class, $testType, $termin, $userId);

        return $this->db->stmt->execute() ? true : false;
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
}