<?php
namespace app\models;
require_once __DIR__ .'/../config/config.php';

use mysqli;


class Db 
{
  public $host = DB_HOST;
  public $user = DB_USER;
  public $password = DB_PASSWORD;
  public $dataBase = DB_NAME;
  public $conn;


  public function __construct()
  {
    $this->conect();
  }

  private function conect()
  {
    $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dataBase);
    // $this->errors = $this->conn->connect_error ?('Connection fail: '.$this->conn->connect_errno) : '';
  }
}