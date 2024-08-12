<?php
  // Load Config
  require_once '../app/config/config.php';
//load helper

  // Autoload Core Libraries
  spl_autoload_register(function($className){
    require_once 'libraries/' . $className . '.php';
  });
  
