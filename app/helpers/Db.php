<?php
namespace app\helpers;
require_once __DIR__ .'/../config/config.php';

use mysqli;

class Db 
{
  public $host = DB_HOST;
  public $user = DB_USER;
  public $password = DB_PASSWORD;
  public $dataBase = DB_NAME;
  public $conn;
  protected $error;
  public $stmt;


  public function __construct()
  {
    $this->conect();
  }

  private function conect()
  {
    $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dataBase);
    $this->error = $this->conn->connect_error ?('Connection fail: '.$this->conn->connect_errno) : '';
  }
  public function query($sql)
  {
    return $this->stmt = $this->conn->prepare($sql);
  }
}