<?php

declare(strict_types=1);

namespace Dto\View\Messages;

use Dto\View\View;
use Dto\Controller\Request;
use Dto\Database\DBquery;
use Dto\Controller\Controller;

class Messages
{
    protected static array $configuration;

    public function __construct ()
    {

    }

    public static function getConfiguration()
    {
        self::$configuration = Controller::getConfiguration();
    }

    protected static function prepareMsg($note) : string
    {
        self::getConfiguration();
        $inputHtml =self::$configuration['templates']['note'];
        $table = [
            'note' => $note,
            'path'              => (string) self::$configuration['templates']['path'],
            'action'            => (string) $_SERVER['PHP_SELF'],            
        ];                       
        return View::templateToHtml($inputHtml, $table);
    }

    protected static function showMsg($note) : string
    {
        $note = self::prepareMsg($note);
        $inputHtml =self::$configuration['templates']['list'];
        $table = [
            'notes' => $note,
            'path'              => (string) self::$configuration['templates']['path'],
            'action'            => (string) $_SERVER['PHP_SELF'],              
        ];                       
        $content = View::templateToHtml($inputHtml, $table);

        $table = [
            'title' => "NotesToDo list",
            'contents' => $content,
            'path'              => (string) self::$configuration['templates']['path'],
            'action'            => (string) $_SERVER['PHP_SELF']
        ];
        $inputHtml = self::$configuration['templates']['index']; 
        return View::templateToHtml($inputHtml, $table);        
    }

    protected static function cool(string $note, string $link ="") : void
    {
        $path = (string) self::$configuration['templates']['path'];
        $action = (string) $_SERVER['PHP_SELF'];

        echo $note;
        header("Refresh: 2; URL=".$path.$action.$link);
        exit();    

    }

}
