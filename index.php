<?php

require "resources/config.inc.php";
function __autoload($classname) {
  require_once RESOURCE_PATH."/classes/".$classname.".php";
}

$scripts = getScripts();
$conn = getDb();
$conn->conn();

$loginMessages = new Message();
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
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