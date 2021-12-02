<?php

declare(strict_types=1);

namespace Dto\View\Messages;

use Dto\View\View;
use Dto\View\Messages\Messages;


class MsgDeleteNote extends Messages
{
    public static function noteMissing() : void
    {
       $note = "Note is missing";
       echo self::showMsg($note);
        header('Refresh: 2; URL=index.php');
        exit();       
    }

    public static function noteDeleted() : void
    {
        $note = "Note has been deleted";
        echo self::showMsg($note);
        header('Refresh: 1; URL=index.php');
        exit();        
    }

    // The note is missing
    // Note has been deleted
}