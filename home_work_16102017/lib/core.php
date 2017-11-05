<?php

error_reporting(0);

include_once'db.php';
spl_autoload_register(function ($name){
    include_once ucfirst(strtolower($name)).'.php';
});