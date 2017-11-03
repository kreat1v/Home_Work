<?php

include_once'db.php';
//require_once('button.php');
//require_once('pagination.php');
spl_autoload_register(function ($name){
    include_once ucfirst(strtolower($name)).'.php';
});