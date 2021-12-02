<?php

declare(strict_types=1);

namespace Dto\Controller;

use Dto\Controller\Request;
use Dto\View\View;
use Dto\Controller\Login;
use Dto\Database\DBquery;
use Dto\Model\ListNotes;
use Dto\Model\DeleteNote;
use Dto\Model\UpdateNote;
use Dto\Model\CreateNote;
use Dto\Model\SearchNote;

class Controller 
{
    ### ---------------------------------------------------------------------
    private static array $configuration = [];
    private DBquery $dbquery;
    protected Request $request;
    ### ---------------------------------------------------------------------

    public function __construct(Request $request)
    {
      if (empty(self::$configuration['database'])) 
      {
        throw new ConfigException('Configuration error.');
      }
      $this->request = $request;

      $this->dbquery = new DBquery();

    }

    ### ---------------------------------------------------------------------
    public static function initConfiguration(array $configuration): void
    {
      self::$configuration = $configuration;
    }

    public static function getConfiguration() : array
    {
        $retValue = self::$configuration;
        return $retValue;
    }

    ### ---------------------------------------------------------------------

    public static function getDbQuery() : DBquery
    {
        return $this->dbquery;
    }

    ### ---------------------------------------------------------------------
    
    # main loop

    public function executor(): void
    {
        switch ($this->request->isLogon())
        {
            case false:
                        if ($this->request->isPostButtonLogon())
                        {
                            $userAndPass = $this->request->getUserAndPass();
                            $login = new Login($this->request);

                            if ($login->checkUser($userAndPass, $this->dbquery))
                            {
                                $_SESSION['logon'] = 'yes';
                                header('Refresh: 1; URL=index.php');
                                exit();
                                break;
                            }

                            if (!$login->checkUser($userAndPass, $this->dbquery))
                            {
                            $table = [
                                'info_user' => "Enter correct username.",
                                'value_user' => $userAndPass['user'],
                                'info_password' => "Enter correct password.",
                                'value_password' => $userAndPass['password'],
                                'path'              => (string) self::$configuration['templates']['path'],
                                'action'            => (string) $_SERVER['PHP_SELF'],  
                            ];

                            $login -> showLoginForm($table);
                            break;
                            }
                        }

                        $table = [
                            'info_user' => "",
                            'value_user' => "",
                            'info_password' => "",
                            'value_password' => "",
                            'path'              => (string) self::$configuration['templates']['path'],
                            'action'            => (string) $_SERVER['PHP_SELF'],  
                        ];                        
                        $login = new Login($this->request);
                        $login -> showLoginForm($table);
                        break;

            case true:
                        
                        if ($this->request->isPost() && $this->request->isLogon())
                        {
                            $this->routePost();
                        }

                        if ($this->request->isGet()  && $this->request->isLogon() )
                        {
                            $this->routeGet();
                        }
                        break;

        }

    }

    ### ---------------------------------------------------------------------

    private function routePost()
    {
        if ($this->request->isPostButtonCreate()) 
        {
            $configuration = self::$configuration['templates'];
            (new CreateNote($configuration, $this->request, $this->dbquery))->createStage2();
        }

        if ($this->request->isPostButtonUpdate())
        {
            $configuration = self::$configuration['templates'];
            (new UpdateNote($configuration, $this->request, $this->dbquery))->updateStage2();
        }

        if ($this->request->isPostButtonSearch())
        {
            $configuration = self::$configuration['templates'];
            (new SearchNote($configuration, $this->request, $this->dbquery))->searchStage2();           
        }

    }

    ### ---------------------------------------------------------------------

    private function routeGet()
    {

        $action = $this->request->getPage();

        switch ($action)
        {
            case 'list':
            case 'read':
            default:
                        $configuration = self::$configuration['templates'];
                        (new ListNotes($configuration, $this->request, $this->dbquery))->list();
                        break;

            case 'create':
                        $configuration = self::$configuration['templates'];              
                        (new CreateNote($configuration, $this->request, $this->dbquery))->createStage1();
                        break;
            case 'update':                   
                        $configuration = self::$configuration['templates'];
                        (new UpdateNote($configuration, $this->request, $this->dbquery))->updateStage1();
                        break;
            case 'delete':
                        $configuration = self::$configuration['templates'];
                        (new DeleteNote($configuration, $this->request, $this->dbquery))->delete();
                        break;
            case 'search':
                        $configuration = self::$configuration['templates'];
                        (new SearchNote($configuration, $this->request, $this->dbquery))->searchStage1();
                        break;
            case 'logout':
                        unset($_SESSION['logon']);
                        unset($_SESSION['id_user']);
                        header('Refresh: 1; URL=index.php');
                        exit();
                        break;
        }

    }


}
