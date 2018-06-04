<?php
/**
 * Created by PhpStorm.
 * User: maschneider
 * Date: 03.06.18
 * Time: 22:42
 */

class Authenticate {

  private $messager;
  private $db;

  public function __construct($message, $mysqli) {
    $this->messager = $message;
    $this->db = $mysqli;
  }

  public function login($username, $password) {
    $values = [];

    //Form Validation
    if(isset($username) && $username != ""){
      $username = htmlspecialchars($username);
      $values["username"] = mysqli_real_escape_string($this->db->mysqli, $username);
    }else{
      $this->messager->errorMessage("Benutzernamen angeben");
    }

    if(isset($password) && $password != ""){
      $password = hash("sha256", htmlspecialchars($password));
      $values["password"] = mysqli_real_escape_string($this->db->mysqli, $password);
    }else{
      $this->messager->errorMessage("Passwort angeben");
    }

    if (count($this->messager->errors) < 1) {
      $query = "
        SELECT 
          id
        FROM
          users
        WHERE username = '".$values['username']."' AND pass = '".$values['password']."'
      ";

      $result = $this->db->query($query);

      if ($result->num_rows > 0) {
        return true;
      }else{
        return $result;
      }
    }else{
      return false;
    }
  }

  public function register($registerValues) {
    $values = [];

    //Form Validation
    if(isset($registerValues['firstname']) && $registerValues['firstname'] != ""){
      $registerValues['firstname'] = htmlspecialchars($registerValues['firstname']);
      $values["firstname"] = mysqli_real_escape_string($this->db->mysqli, $registerValues['firstname']);
    }else{
      $this->messager->errorMessage("Vorname angeben");
    }

    if(isset($registerValues['surname']) && $registerValues['surname'] != ""){
      $registerValues['surname'] = htmlspecialchars($registerValues['surname']);
      $values["surname"] = mysqli_real_escape_string($this->db->mysqli, $registerValues['surname']);
    }else{
      $this->messager->errorMessage("Nachname angeben");
    }

    if(isset($registerValues['email']) && $registerValues['email'] != ""){
      $registerValues['email'] = htmlspecialchars($registerValues['email']);
      $values["email"] = mysqli_real_escape_string($this->db->mysqli, $registerValues['email']);
    }else{
      $this->messager->errorMessage("E-Mail Addresse angeben");
    }

    if(isset($registerValues['username']) && $registerValues['username'] != ""){
      $registerValues['username'] = htmlspecialchars($registerValues['username']);
      $values["username"] = mysqli_real_escape_string($this->db->mysqli, $registerValues['username']);
    }else{
      $this->messager->errorMessage("Benutzernamen angeben");
    }

    if(isset($registerValues['pass']) && $registerValues['pass'] != ""){
      $registerValues['pass'] = hash("sha256", htmlspecialchars($registerValues['pass']));
      $values["pass"] = mysqli_real_escape_string($this->db->mysqli, $registerValues['pass']);
    }else{
      $this->messager->errorMessage("Passwort angeben");
    }

    $uuid = uniqid("M133_");

    if (count($this->messager->errors) < 1) {
      $query = "
        INSERT INTO users
          (firstname, surname, email, username, pass, uid)
        VALUES (
          '".$values['firstname']."',
          '".$values['surname']."',
          '".$values['email']."',
          '".$values['username']."',
          '".$values['pass']."',
          '".$uuid."'
        )
      ";

      $result = $this->db->query($query);

      var_dump($result);

      return $result;
    }else{
      return false;
    }
  }

}