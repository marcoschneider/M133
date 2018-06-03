<?php
/**
 * Created by PhpStorm.
 * User: maschneider
 * Date: 03.06.18
 * Time: 22:42
 */

class Authenticate {

  private $messager;
  private $mysqli;

  public function __construct($message, $mysqli) {
    $this->messager = $message;
    $this->mysqli = $mysqli;
  }

  public function login($username, $password) {
    $escPassword = "";
    $values = [];

    //Form Validation
    if(isset($username) && $username != ""){
      $username = htmlspecialchars($username);
      $values["username"] = mysqli_real_escape_string($this->mysqli, $username);
    }else{
      $this->messager->errorMessage("Benutzername angeben");
    }

    if(isset($password) && $password != ""){
      $password = hash("sha256", htmlspecialchars($password));
      $values["password"] = mysqli_real_escape_string($this->mysqli, $password);
    }else{
      $this->messager->errorMessage("Passwort angeben");
    }

    if (count($this->messager->errors) < 1) {
      $query = "
        SELECT 
          id,
          email,
          username,
          uid
        FROM
          users
        WHERE username = '".$values['username']."' AND pass = '".$values['password']."'
      ";

      $result = $this->mysqli->query($query);

      if ($result->num_rows > 0) {
        return TRUE;
      }else{
        return $result;
      }

    }else{
      return $this->messager->errors;
    }
  }

}