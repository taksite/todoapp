<?php

declare(strict_types=1);

namespace Dto\Controller;

use Dto\View\View;
use Dto\Controller\Request;
use Dto\Database\DBquery;

class Login 
{
    
    private array $configuration = [];
    private Request $request;
    private object $dbquery;

    public function __construct($request)
    {
        $this->request = $request;
        $this->configuration = Controller::getConfiguration();
    }

    public function showLoginForm(array $table = []) : void
    {
        $inputHtml = $this->configuration['templates']['login'];

        $content = View::templateToHtml($inputHtml, $table);  

        $inputHtml = $this->configuration['templates']['index']; 
        $table = [
            'title' => "NotesToDo - Enter Login",
            'path'              => (string) $this->configuration['templates']['path'],
            'action'            => (string) $_SERVER['PHP_SELF'],            
            'contents' => $content
        ];
        View::showHtml (View::templateToHtml($inputHtml, $table));
    } 
    
    public function checkUser(array $user, object $dbquery) : bool
    {
        $this->dbquery = $dbquery;

        $userDB = $this->dbquery->getUser($user['user']);

        // dump ($userDB);
        if (!$userDB) return false;


        if (password_verify($user['password'], $userDB['password'])) 
        {
            $_SESSION['id_user'] = $userDB['id_user'];
            return true; 
        }
        return false;

        
    }
}