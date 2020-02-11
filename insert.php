<?php
require 'datalayer.php';
$function = $_GET['action'];
$data = $_POST;

if (function_exists($function)) {
    $function($data);
}