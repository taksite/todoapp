<?php

declare(strict_types=1);

namespace Dto\Model;

use Dto\Controller\Request;
use Dto\Database\DBquery;
use Dto\Model\Notes;
use Dto\View\Messages\MsgDeleteNote;

class DeleteNote extends Notes
{

    public function delete () : bool
    {
 
        $id_user = ($this->request->getSessionIdUser());
        $id_note = $this->request->getIdNote();

        if ($id_note == 0)
        {
            MsgDeleteNote::noteMissing();
            return false;
        }
        else 
        {
            if ($this->dbquery->deleteNote($id_note, $id_user))
            {
                MsgDeleteNote::noteDeleted();
                return true;
            }
            else 
            {
                MsgDeleteNote::noteMissing();
                return false;
            }
        }


    }
}