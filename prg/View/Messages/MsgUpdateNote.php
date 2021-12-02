<?php

declare(strict_types=1);

namespace Dto\View\Messages;

use Dto\View\View;
use Dto\View\Messages\Messages;

class MsgUpdateNote extends Messages

{
    public static function noteMissing() : void
    {
        $note =  "Note is missing";
        self::cool(self::showMsg($note));      
    }

    public static function noteCheck() : void
    {
        $note = "Note is missing. Check inquiry.";
        self::cool(self::showMsg($note)); 
        // header('Refresh: 2; URL=index.php');
        // exit();         
    }

    public static function noteUpdateFail(int $id_note) : void
    {
        $note = "Title, content or date too short or missing!";
        self::cool(self::showMsg($note), "?page=update&id_note={$id_note}"); 
        // header("Refresh: 2; URL=index.php?page=update&id_note={$id_note}");
        // exit();        
    }

    public static function noteUpdateOk() : void
    {
        $note = "Note has been changed.";
        echo self::showMsg($note);
        header('Refresh: 1; URL=index.php');
        exit();        
    }

    public static function noteSomeWrong() : void
    {
        $note = "Some wrong.";
        echo self::showMsg($note);
        header('Refresh: 1; URL=index.php');
        exit();            
    }

}

/*
'path'              => (string) self::$configuration['templates']['path'],
'action'            => (string) $_SERVER['PHP_SELF'], 
*/