<?php

if (isset($_POST['register'])) {
  $registerAuth = new Authenticate($registerMessage, $conn);
  $regiResponse = $registerAuth->register($_POST);
  if($regiResponse === true){
    $registerMessage->successMessage("Registrierung war erfolgreich");
  }else{
    $registerMessage->errorMessage($regiResponse);
  }
}

?>

<div class="container">
  <form class="col-6" method="post" action="">
    <div class="form-group">
      <label for="firstnameRegi">Vorname</label>
      <input type="text" class="form-control" id="firstnameRegi" name="firstname">
    </div>
    <div class="form-group">
      <label for="surnameRegi">Nachname</label>
      <input type="text" class="form-control" id="surnameRegi" name="surname">
    </div>
    <div class="form-group">
      <label for="emailRegi">E-Mail Adresse</label>
      <input type="text" class="form-control" id="emailRegi" name="email">
    </div>
    <div class="form-group">
      <label for="usernameRegi">Benutzername</label>
      <input type="text" class="form-control" id="usernameRegi" name="username">
    </div>
    <div class="form-group">
      <label for="passwordRegi">Password</label>
      <input type="password" class="form-control" id="passwordRegi" name="pass">
    </div>
    <button type="submit" class="btn btn-primary mb-5" name="register">Registrieren</button>
    <?php
    if(isset($_POST['register'])){
      if(isset($registerMessage->errors)){
        $registerMessage->outputErrors();
      }else{
        $registerMessage->outputSuccess();
      }
    }
    ?>
  </form>
</div>
