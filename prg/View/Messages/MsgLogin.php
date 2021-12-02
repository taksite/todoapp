<?php

declare(strict_types=1);

namespace Dto\View\Messages;

use Dto\View\View;
use Dto\View\Messages\Messages;

class Login extends Messages
{
    public static function login() : void
    {
        // usage:
        // $login = new Login($this->request);
        // $login -> showLoginForm();
    }
}