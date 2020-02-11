<?php
require 'datalayer.php';
$function = $_GET['action'];
$id = $_GET['id'];

if (function_exists($function)) {
    $function($id);
}