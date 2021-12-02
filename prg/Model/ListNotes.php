<?php

declare(strict_types=1);

namespace Dto\Model;

use Dto\View\View;
use Dto\Controller\Request;
use Dto\Database\DBquery;
use Dto\Model\Notes;

class ListNotes extends Notes
{
    public function list () : void
    {



        $table = [
            'notes' => "",
            'path'              => (string) $this->configuration['path'],
            'action'            => (string) $_SERVER['PHP_SELF']
        ];   
        $inputHtml =$this->configuration['list'];

        $content = View::templateToHtml($inputHtml, $table);

        // $id_user = ($this->request->getSessionIdUser());
        $table = $this->dbquery->getAllNotes($this->request->getSessionIdUser());




        foreach ($table as $key => $value) 
        {
            if (!isset($value['deadline']))  {$deadline = " ";} else {$deadline = $value['deadline'];}
            
            $table  = [
                'id_note'           => (string) $value['id_note'],
                'title'             => $value['title'],
                'description'       => $value['description'],
                'date'              => $value['date_write'],
                'path'              => (string) $this->configuration['path'],
                'action'            => (string) $_SERVER['PHP_SELF'],
                'deadline'          => $deadline
            ];
            $inputHtml = $this->configuration['listNote']; 
            $content .= View::templateToHtml($inputHtml, $table);
        }

        $table = [
            'title' => "NotesToDo list",
            'path'              => (string) $this->configuration['path'],
            'action'            => (string) $_SERVER['PHP_SELF'],
            'contents' => $content
        ];
        $inputHtml = $this->configuration['index']; 
        View::showHtml(View::templateToHtml($inputHtml, $table));       

        # ---- cut here for release
        // dump($this->dbquery->getAllUsers());
        // dump($this->dbquery->countNotes($this->request->getSessionIdUser()));
        # ---- cut here for release
    }
}