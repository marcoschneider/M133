<?php
/**
 * Created by PhpStorm.
 * User: School
 * Date: 04.06.2018
 * Time: 18:53
 */

class User {

  private $messager;
  private $db;

  public function __construct($message, $mysqli) {
    $this->messager = $message;
    $this->db = $mysqli;
  }

  public function getUserdata($username) {
    $query = "
      SELECT 
        id,
        email,
        username,
        uid
      FROM
        users
      WHERE username = '".$username."'
    ";

    $result = $this->db->query($query)->fetch_assoc();

    return $result;
  }

}