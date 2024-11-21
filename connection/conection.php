<?php
require_once('config.php');
$connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

var_dump($connection);