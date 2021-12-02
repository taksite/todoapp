<?php

declare(strict_types=1);

namespace Dto\View\Messages;

use Dto\View\View;
use Dto\View\Messages\Messages;

class MsgCreateNote extends Messages

{
    public static function addNoteOk() : void
    {
        $note = "The note has been added.";
        echo self::showMsg($note);
        header('Refresh: 2; URL=index.php');
        exit();
    }

    public static function addNoteFail() : void
    {
        $note =  "Title, content or date too short or missing!";
        echo self::showMsg($note);
        header('Refresh: 2; URL=index.php?page=create');
        exit();        
    }
}