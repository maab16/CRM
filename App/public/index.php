<?php
session_start();
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define("VIEWS_PATH", ROOT.DS."App".DS."Views");

require_once ROOT.DS.'vendor'.DS.'autoload.php';

new Blab\Libs\defaultSettings();

// Logged In User
(new Blab\Libs\Blab_User())->loggedInUser();

Blab\Mvc\Bootstrap::run($_SERVER['REQUEST_URI']);