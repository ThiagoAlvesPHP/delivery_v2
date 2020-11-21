<?php
session_start();
require 'config.php';
/*require 'vendor/autoload.php';*/
date_default_timezone_set('America/Sao_Paulo');
set_time_limit(0);

spl_autoload_register(function($class){

    if (file_exists('controllers/'.$class.'.php')) {
        require 'controllers/'.$class.'.php';
    } 
    elseif (file_exists('models/'.$class.'.php')) {
        require 'models/'.$class.'.php';
    } 
    elseif (file_exists('core/'.$class.'.php')) {
        require 'core/'.$class.'.php';
    }
});


$core = new Core();
$core->run();