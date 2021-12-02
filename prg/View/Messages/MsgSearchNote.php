<?php

declare(strict_types=1);

namespace Dto\View\Messages;

use Dto\View\View;
use Dto\View\Messages\Messages;

class MsgSearchNote extends Messages
{

    public static function noteNotFound() : void
    {
        $note = "You have nothing.";    
        echo self::showMsg($note); 
        header('Refresh: 1; URL=index.php?page=search');
        exit();          
    }

}