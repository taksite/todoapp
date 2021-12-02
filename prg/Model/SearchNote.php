<?php

declare(strict_types=1);

namespace Dto\Model;

use Dto\View\View;
use Dto\Controller\Request;
use Dto\Database\DBquery;
use Dto\Model\Notes;
use Dto\View\Messages\MsgSearchNote;

class SearchNote extends Notes
{
    public function searchStage1() : void
    {

        $inputHtml =$this->configuration['list'];
        $table = [
            'notes' => "",
            'path'              => (string) $this->configuration['path'],
            'action'            => (string) $_SERVER['PHP_SELF'],            
        ];                       

        $content = View::templateToHtml($inputHtml, $table);
        
        $inputHtml = $this->configuration['search'];
        $table = [
            'path'              => (string) $this->configuration['path'],
            'action'            => (string) $_SERVER['PHP_SELF'],     
        ];
        $content .= View::templateToHtml($inputHtml, $table);

        $table = [
            'title' => "ToDo search",
            'path'              => (string) $this->configuration['path'],
            'action'            => (string) $_SERVER['PHP_SELF'],            
            'contents' => $content
        ];
        $inputHtml = $this->configuration['index']; 
        View::showHtml(View::templateToHtml($inputHtml, $table)); 
    }

    public function searchStage2() : void
    {
        $phrase = $this->request->getPostSearch();
        $phrase = (string) $this->request->cutToLength($this->request->sanitization($phrase), 60);

        $inputHtml =$this->configuration['list'];
        $table = [
            'path'              => (string) $this->configuration['path'],
            'action'            => (string) $_SERVER['PHP_SELF'],            
            'notes' => ""
        ];                       
        $content = View::templateToHtml($inputHtml, $table);

        $content .= "<div><b> I found $phrase in: </b></div>";

        $id_user = ($this->request->getSessionIdUser());

        $table = $this->dbquery->findNotes ($phrase, $id_user);

        if (empty($table) || strlen($phrase) < 3) 
        {
            MsgSearchNote::noteNotFound();
        }

        foreach ($table as $key => $value) 
        {
            if (!isset($value['deadline']))  {$deadline = " ";} else {$deadline = $value['deadline'];}
            
            $table  = [
                'id_note'           => (string) $value['id_note'],
                'title'             => $value['title'],
                'description'       => $value['description'],
                'date'              => "",// $value['date_write'],
                'deadline'          => $deadline,
                'path'              => (string) $this->configuration['path'],
                'action'            => (string) (string) $_SERVER['PHP_SELF']
            ];
            $inputHtml = $this->configuration['listNote']; 
            $content .= View::templateToHtml($inputHtml, $table);
        }

        $table = [
            'title' => "NotesToDo search",
            'path'              => (string) $this->configuration['path'],
            'action'            => (string) $_SERVER['PHP_SELF'],
            'contents' => $content
        ];
        $inputHtml = $this->configuration['index']; 
        View::showHtml(View::templateToHtml($inputHtml, $table));    
    }

}