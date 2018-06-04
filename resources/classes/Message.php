<?php
/**
 * Created by PhpStorm.
 * User: maschneider
 * Date: 03.06.18
 * Time: 22:49
 */

class Message {

  public $errors = [];
  private $values = [];

  public function errorMessage($message) {
    $this->errors[] = $message;
  }

  public function successMessage($message) {
    $this->values[] = $message;
  }

  public function outputErrors() {
    echo '<div class="alert alert-danger">';
    foreach ($this->errors as $error) {
      //var_dump($this->errors);
      echo '<span class="error-text">'.$error.'</span>';
    }
    echo '</div>';
  }

  public function outputSuccess() {
    echo '<div class="alert alert-success">';
    foreach ($this->values as $value) {
      echo '<span class="error-text">'.$value.'</span>';
    }
    echo '</div>';
  }

  public function __get($name) {
    return $this->$name;
  }

  public function __set($name, $value) {
    $this->$name = $value;
  }

  public function __destruct() {
    $this->errors = [];
    $this->values = [];
  }

}