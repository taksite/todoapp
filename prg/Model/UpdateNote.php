<?php

declare(strict_types=1);

namespace Dto\Model;

use Dto\View\View;
use Dto\Controller\Request;
use Dto\Database\DBquery;
use Dto\Model\Notes;
use Dto\View\Messages\MsgUpdateNote;

class UpdateNote extends Notes
{
    public function updateStage1 () : void
    {
        $id_user = (int) $this->request->getSessionIdUser();
        $id_note = (int) $this->request->getIdNote();


        if ($id_note == 0)
        {
            MsgUpdateNote::noteMissing();
        }  
        else 
        {
           if (isset( $this->dbquery->getNote($id_note, $id_user)[0]))
           {
                $this->dbquery->getNote($id_note, $id_user)[0] ? $note = $this->dbquery->getNote($id_note, $id_user)[0] : $note = [];
           }
        }   

        if (!isset($note) || empty($note))
        {
            MsgUpdateNote::noteCheck();
        }
        else
        {
            $inputHtml =$this->configuration['list'];
            $table = [
                'notes' => "",
                'path'              => (string) $this->configuration['path'],
                'action'            => (string) $_SERVER['PHP_SELF'],                
            ];                       
            $content = View::templateToHtml($inputHtml, $table);

            $inputHtml = $this->configuration['updateNote'];

            $table = [
                'id_note'           => (string) $id_note,
                'title_note'        => (string) $note['title'],
                'description_note'  => (string) $note['description'],
                'path'              => (string) $this->configuration['path'],
                'action'            => (string) (string) $_SERVER['PHP_SELF'],
                'deadline'          => (string) $note['deadline']
            ];
            $content .= View::templateToHtml($inputHtml, $table);
            
            $table = [
                'title' => "NotesToDo update",
                'path'              => (string) $this->configuration['path'],
                'action'            => (string) $_SERVER['PHP_SELF'],
                'contents' => $content
            ];
            $inputHtml = $this->configuration['index']; 
            View::showHtml(View::templateToHtml($inputHtml, $table));             
        }
        
    }

    public function updateStage2 () : void   
    {
        $itOk = true;
        $table = $this->request->getPostUpdateNote();
        // $id_note = $table['id_note'];

        $table['id_note']           = (int) $this->request->sanitization($table['id_note']);

        $table['title']             = (string) $this->request->cutToLength($this->request->sanitization($table['title']), 60);
        if ( empty($table['title']) || strlen($table['title']) <5) $itOk = false;

        $table['description']       = (string) $this->request->cutToLength($this->request->sanitization($table['description']), 260);
        if ( empty($table['description']) || strlen($table['description']) <3) $itOk = false;

        $table['deadline']          = (string) $this->request->cutToLength($this->request->sanitization($table['deadline']), 18);
        if ( empty($table['deadline']) || strlen($table['deadline']) <7) $itOk = false;   // min. year & month

        $table['id_user'] = (int) $this->request->getSessionIdUser();


        if (!$itOk)
        {
            MsgUpdateNote::noteUpdateFail($table['id_note']);
        }
        
        else
        {
            if ($this->dbquery->updateNote($table))
            {
                MsgUpdateNote::noteUpdateOk();
            }
            else 
            {
                MsgUpdateNote::noteSomeWrong();
            }
        }


    }


}