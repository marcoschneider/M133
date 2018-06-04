<?php

session_start();

require "resources/config.inc.php";
function __autoload($classname) {
  require_once RESOURCE_PATH."/classes/".$classname.".php";
}

var_dump($_SESSION);

//Manages redirect to login page if not logged in
if(!isset($_SESSION['loggedin']) && $_SESSION['kernel']['userdata']['id'] === null) {
  header("Location: /?page=login");
  exit();
}

$scripts = getScripts();
$conn = getDb();
$conn->conn();

$loginMessages = new Message();
$actualUser = new User($loginMessages, $conn);
$userdata = $actualUser->getUserdata($_SESSION['loggedin']);
$_SESSION['kernel']['userdata']['id'] = $userdata['id'];
$_SESSION['kernel']['userdata']['email'] = $userdata['email'];

$registerMessage = new Message();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <title>Easy Budget</title>
  </head>
  <body>
    <?php
      include TEMPLATES_PATH.'/header.php';
    ?>
    <main>
      <?php
        if(isset($_GET['page'])){
          switch ($_GET['page']) {
            case 'login':
              include TEMPLATES_PATH.'/page/login.php';
              break;
            case 'register':
              include TEMPLATES_PATH.'/page/register.php';
              break;
            case 'main':
              include TEMPLATES_PATH.'/page/main.php';
          }
        }
      ?>
    </main>
    <?php
      foreach ($scripts as $script) {
        echo '<script type="text/javascript" src="'.$script.'"></script>';
      }
    ?>
  </body>
</html>