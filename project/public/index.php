<?php 

include_once dirname(__FILE__) ."/../vendor/autoload.php";
require_once dirname(__FILE__) ."/../backend/autoload.php";

// start session
if (session_status() == PHP_SESSION_NONE)
    session_start();


$app = new App();

$app->run();
