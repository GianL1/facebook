<?php

require "environment.php";

global $config;
$config = array();

if(ENVIRONMENT == "development") {
    define("BASE_URL", "http://localhost/php/facebook/");
    $config['dbname']="facebook";
    $config['host']="localhost";
    $config['dbuser']="postgres";
    $config['dbpass']="root";
}else {
    define("BASE_URL", "http://localhost/php/facebook/");
    $config['dbname']="facebook";
    $config['host']="localhost";
    $config['dbuser']="postgres";
    $config['dbpass']="root";
}