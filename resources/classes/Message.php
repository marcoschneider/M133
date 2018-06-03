<?php
/**
 * Created by PhpStorm.
 * User: maschneider
 * Date: 03.06.18
 * Time: 22:49
 */

class Message {

  public $errors = [];
  public $values = [];

  public function errorMessage($message) {
    $this->errors[] = $message;
  }

  public function successMessage($message) {
    $this->values[] = $message;
  }

  public function __destruct() {
    $this->errors = [];
    $this->values = [];
  }

}