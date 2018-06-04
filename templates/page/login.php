<?php
/**
 * Created by PhpStorm.
 * User: maschneider
 * Date: 03.06.18
 * Time: 18:16
 */

// redirect if logged in already
if(isset($_SESSION['loggedin'])){
  header('Location: ?page=main');
}

if (isset($_POST["login"])) {
  $loginAuth = new Authenticate($loginMessages, $conn);
  $loginResponse = $loginAuth->login($_POST["username"], $_POST["password"]);
  if ($loginResponse === true) {
    $_SESSION['loggedin'] = $_POST['username'];
    header("Location: ?page=main");
  }else{
    $loginMessages->errorMessage("");
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
    <button type="submit" class="btn btn-primary mb-5" name="login">Login</button>
    <?php
    if(isset($_POST['login'])) {
      $loginMessages->outputErrors();
    }
    ?>
  </form>
</div>
