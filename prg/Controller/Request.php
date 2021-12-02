<?php

declare(strict_types=1);

namespace Dto\Controller;

class Request
{
    private array $get = [];
    private array $post = [];
    private array $session = [];
    private array $server = [];

    ### ---------------------------------------------------------------------
    public function __construct (array $get, array $post, array $session, array $server) 
    {
        $this->get = $get;
        $this->post = $post;
        $this->session = $session;
        $this->server = $server;
    }
    ### ---------------------------------------------------------------------

    public function isPost(): bool
    {
        return $this->server['REQUEST_METHOD'] === 'POST';
    }

    public function isGet() : bool
    {
        return $this->server['REQUEST_METHOD'] === 'GET';
    }

    public function isLogon(): bool
    {
        if (isset($this->session['logon']) && $this->session['logon'] === 'yes' ) return true;
        return false;
    }
 
    ### ---------------------------------------------------------------------
    public function isPostButtonLogon () : bool
    {
        if (isset($this->post['button']) && $this->post['button'] === 'logon') return true;
        return false;
    } 

    public function clearButtonLogon() : void
    {
       unset($_POST['button']);
    }
   
    ### ---------------------------------------------------------------------
    public function getUserAndPass () : array
    {
        if (isset($this->post['user']))
            {$user = $this->post['user'];} else { $user =""; }
        if (isset($this->post['password']))
            {$password = $this->post['password'];} else {$password="";}
        return [
            'user' => $user,
            'password' => $password
        ];
    }

    public function getPage() : string
    {
        if (isset($this->get['page']))
        {
            return $this->get['page'];
        } else {
            return 'list';
        }
    }

    public function getPost() : array
    {
        return $this->post;
    }
   
    ### ---------------------------------------------------------------------
    public function isPostButtonCreate () : bool
    {
        if (isset($this->post['button']) && $this->post['button'] === 'create') return true;
        return false;
    } 

    public function clearButton() : void
    {
       unset($_POST['button']);
    }

    public function getPostCreatedNote () : array
    {
        $table = [];
        if (isset($this->post['title'])) $table['title'] = $this->post['title'];
        if (isset($this->post['description'])) $table['description'] = $this->post['description'];
        if (isset($this->post['deadline'])) $table['deadline'] = $this->post['deadline'];
        return $table;
    }


    public function sanitization(string $value): string
    {
        return $value =  htmlentities(trim($value));
    }

    public function cutToLength(string $value, int $lenght= 250): string
    {
        return substr($value,0, $lenght);
    }

    public function getSessionIdUser () : int
    {
        if (isset($this->session['id_user']))
            { return (int) $this->session['id_user']; } else { return 0;}

    }

    public function getIdNote () : int
    {
        if (isset($this->get['id_note'])) return (int) $this->get['id_note'];
        return 0;
    }

    public function isPostButtonUpdate() : bool
    {
        if (isset($this->post['button']) && $this->post['button'] === 'update') return true;
        return false;
    }

    public function getPostUpdateNote() : array
    {
        $table = $this->getPostCreatedNote();

        if (isset($this->post['update_note'])) 
            {$table['id_note'] = $this->post['update_note'];} else { $table['id_note'] = '0';}
        return $table;
    }

    public function isPostButtonSearch() : bool
    {
        if (isset($this->post['button']) && $this->post['button'] === 'search') return true;
        return false;
    }

    public function getPostSearch() : string
    {
        if (isset($this->post['search']))
            {return $this->post['search'];} else {return "";}
    }
}