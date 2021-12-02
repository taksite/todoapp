<?php

declare(strict_types=1);

namespace Dto\Model;

use Dto\View\View;
use Dto\Controller\Request;
use Dto\Database\DBquery;
use Dto\Model\Notes;
use Dto\View\Messages\MsgCreateNote;

class CreateNote extends Notes
{

    public function createStage1()
    {
        $inputHtml =$this->configuration['list'];
        $table = [
            'path'              => (string) $this->configuration['path'],
            'action'            => (string) $_SERVER['PHP_SELF'],            
            'notes' => ""
        ];                       
        $content = View::templateToHtml($inputHtml, $table);
        
        $id_user = (int) $this->request->getSessionIdUser();

        $inputHtml = $this->configuration['create'];
        $table = [
            'deadline' => date("Y-m-d"),
            'path'              => (string) $this->configuration['path'],
            'action'            => (string) $_SERVER['PHP_SELF'],
        ];
        $content .= View::templateToHtml($inputHtml, $table);

        $table = [
            'title' => "NotesToDo create",
            'path'              => (string) $this->configuration['path'],
            'action'            => (string) $_SERVER['PHP_SELF'],
            'contents' => $content
        ];
        $inputHtml = $this->configuration['index']; 
        View::showHtml(View::templateToHtml($inputHtml, $table)); 

    }

    public function createStage2()
    {
        $note = $this->request->getPostCreatedNote();

        $itOk = true;
        $id_user            = $this->request->getSessionIdUser();
        $title              = (string )$this->request->cutToLength($this->request->sanitization($note['title']), 60);
        if (empty($title) || strlen($title) <5) $itOk = false;
        $description        = (string) $this->request->cutToLength($this->request->sanitization($note['description']), 260);
        if (empty($description) || strlen($description) <3) $itOk = false;
        $deadline           = (string) $this->request->cutToLength($this->request->sanitization($note['deadline']), 18);

        $table = [
                    'path'              => (string) $this->configuration['path'],
                    'action'            => (string) $_SERVER['PHP_SELF'],
                   'id_user'       => $id_user,
                   'title'         => $title,
                   'description'   => $description,
                   'deadline'      => $deadline
        ];

        if ($itOk) 
        {   
            $this->dbquery->createNote($table);
            MsgCreateNote::addNoteOk();
        } 
        else 
        {
            MsgCreateNote::addNoteFail();
        }       
    }

}