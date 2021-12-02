<?php

declare(strict_types=1);

session_start();

### ---------------------------------------------------------------------
spl_autoload_register(function (string $classNamespace) {
    $path = str_replace(['\\', 'Dto/'], ['/', ''], $classNamespace);
    $path = "prg/$path.php";
    require_once($path);
  });
### ---------------------------------------------------------------------

require_once("./Utils/debug.php");

### ---------------------------------------------------------------------

use Dto\Controller\Controller;
use Dto\Controller\Request;
use Dto\Exception\DtoException;
use Dto\Exception\ConfigException;

### ---------------------------------------------------------------------

try {

    if (isset($_GET))
        {$get=$_GET;} else {$get = [];}
    if (isset($_POST))
        {$post=$_POST;} else {$post = [];}
    if (isset ($_SESSION))
        { $session=$_SESSION;} else {$session= [];}

    $request = new Request($get,$post,$session, $_SERVER);
    $configuration = require_once("./config/config.php");
    Controller::initConfiguration($configuration);
    (new Controller($request))->executor();

    } 
catch (StorageException $e )
    {
        echo "There is a problem with the base.";
    }
catch  (ConfigException $e)
    {   
        echo "A configuration error has occurred.";
    } 
catch (\Throwable $e) 
    {
        echo '<h1>Oh, here\'s a big bug in the application.</h1>';
        dump($e);
    }
 
