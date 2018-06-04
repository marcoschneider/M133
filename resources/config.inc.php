<?php
/**
 * Created by PhpStorm.
 * User: maschneider
 * Date: 03.06.18
 * Time: 17:04
 */

//error_reporting(E_ALL &~ E_NOTICE);

define('RESOURCE_PATH', realpath(dirname(__FILE__)));
define('TEMPLATES_PATH', realpath(dirname(__DIR__)).'/templates');

function getConfig(){
  return [
    "db" => [
      "host" => "127.0.0.1",
      "username" => "root",
      "password" => "toor",
      "dbname" => "m133_easy_budget"
    ],

  ];
}

function getScripts(){
  return [
    "bower_components/jquery/dist/jquery.min.js",
    "bower_components/bootstrap/dist/js/bootstrap.min.js",
    "assets/js/script.js"
  ];
}


function getDb() {
  $config = getConfig();
  $credentials = getConfig()["db"];
  require_once RESOURCE_PATH."/classes/Database.php";
  $db = new Database($config["db"]);
  //$db = new mysqli($credentials["host"], $credentials["username"], $credentials["password"], $credentials["dbname"]);
  return $db;
}