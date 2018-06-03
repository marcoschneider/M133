<?php
/**
 * Created by PhpStorm.
 * User: maschneider
 * Date: 03.06.18
 * Time: 21:19
 */


class Database {

  protected $host;
  protected $username;
  protected $pass;
  protected $dbname;

  private $connected = false;
  public $mysqli;

  public function __construct($credentials) {

    $this->host = $credentials["host"];
    $this->username = $credentials["username"];
    $this->pass = $credentials["password"];
    $this->dbname = $credentials["dbname"];
  }

  public function conn(){
    if ($this->connected) {
      $this->disconnect();
    }
    $this->mysqli = new mysqli($this->host, $this->username, $this->pass, $this->dbname);
    if ($this->mysqli->connect_errno) {
      echo "Failed to connect to MySql: (" . $this->mysqli->connect_errno . ") " .$this->mysqli->connect_error;
    }else{
      $this->connected = true;
    }
    $this->mysqli->set_charset("uft-8");
  }

  public function query($sql) {
    if (!$this->connected) $this->conn();
    $result = $this->mysqli->query($sql);
    try {
      if (!$result) {
        throw new Exception("Error: (".$this->mysqli->errno .") ". $this->mysqli->error);
      }
    }catch (Exception $e) {
      return $e->getMessage();
    }
    return $result;
  }

  public function disconnect () {
    if ($this->connected) return;
    $this->mysqli->disconnect();
    $this->connected = false;
  }

}