<?php
/**
 * Created by PhpStorm.
 * User: maschneider
 * Date: 03.06.18
 * Time: 18:16
 */

if (isset($_POST["login"])) {
  $auth = new Authenticate($loginMessages, $conn);
  var_dump($_POST["username"], $_POST["password"]);
  $loginResponse = $auth->login($_POST["username"], $_POST["password"]);
  if ($loginResponse === TRUE) {
    header("Location: ?page=main");
  }else{
    var_dump($loginResponse);
  }
}


?>

<div class="container">
  <form class="col-6" method="post" action="">
    <div class="form-group">
      <label for="usernameLogin">Benutzername</label>
      <input type="text" class="form-control" id="usernameLogin" name="username">
    </div>
    <div class="form-group">
      <label for="passwordLogin">Password</label>
      <input type="password" class="form-control" id="passwordLogin" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="login">Submit</button>
  </form>
</div>
