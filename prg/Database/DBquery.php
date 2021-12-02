<?php
declare(strict_types=1);

namespace Dto\Database;

use SQLite3;
use Dto\Exception\DtoException;

class DBquery extends Database

{

    ### ---------------------------------------------------------------------
    public function getAllNotes($id_user) : array
    {
        $stmt = $this->conn->prepare("SELECT * FROM notes WHERE id_user = :id_user AND id_delete = '0' ORDER BY id_note DESC ");
        $stmt -> bindValue(':id_user', $id_user);

        if ($stmt)
        {
            $result = $stmt->execute();
            $returnResult = [];  
    
             while ($row = $result->fetchArray(SQLITE3_ASSOC)) 
            {
                $returnResult[] = $row;
            }    
            return $returnResult;
        }
        else 
        {
            throw new DtoException('Failed to prepare sql query.'); # code...
            return [];
        }
    

    }

      ### ---------------------------------------------------------------------

    public function getNote($id_note, $id_user) : array
    {
        $query = "SELECT * FROM notes WHERE id_note = :id_note AND id_user = :id_user";
        $stmt = $this->conn->prepare($query);
        $stmt   -> bindValue(':id_note', $id_note);
        $stmt   -> bindValue(':id_user', $id_user);
        $returnResult = [];
        
        if ($stmt)
        {
            $result = $stmt->execute();

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) 
            {
                $returnResult[] = $row;
            }    
            return $returnResult; 
        }

        {
            throw new DtoException('Failed to prepare sql query.'); 
            return [];           
        }

    }

      ### ---------------------------------------------------------------------      

      public function getAllUsers() : array
      {
        $stmt = $this->conn->prepare("SELECT * FROM users");

        if ($stmt)
        {        
            $result = $stmt->execute();    
            $returnResult = [];

            while ($row = $result->fetchArray(SQLITE3_ASSOC)) 
            {
                $returnResult[] = $row;
            }    
            return $returnResult;      
        }
        else 
        {
            throw new DtoException('Failed to prepare sql query.'); 
            return [];           
        }

      }

      ### ---------------------------------------------------------------------
      
      public function countNotes(int $id_user) : int
      {
        $query  = "SELECT count(*) AS cnt FROM notes WHERE id_user = :id_user AND id_delete = '0'";
        $stmt   =  $this->conn->prepare($query);
        $stmt   -> bindValue(':id_user', $id_user);

        if ($stmt)
        {
            $result = $stmt->execute();
            $row    = $result->fetchArray(SQLITE3_ASSOC);
            return (int) $row['cnt'];
        }
        else 
        {
            throw new DtoException('Failed to prepare sql query.'); 
            return 0;           
        }        

      }

    ### ---------------------------------------------------------------------

      public function getUser($user) : array | bool
      {
        $query  = "SELECT id_user, user, password FROM users WHERE user = :user AND id_delete = '0'";
        $stmt   =  $this->conn->prepare($query);
        $stmt   -> bindValue(':user',$user, SQLITE3_TEXT);

        if ($stmt)
        {
            $result = $stmt->execute();
            $row = $result->fetchArray(SQLITE3_ASSOC);  
            return $row;          
        }
        else
        {
            throw new DtoException('Failed to prepare sql query.'); 
            return false;
        }

      }

    ### ---------------------------------------------------------------------
      public function countUsers() : int
      {
        $stmt =  $this->conn->prepare("SELECT count(*) AS cnt FROM users");

        if ($stmt)
        {
            $result = $stmt->execute();
            $row = $result->fetchArray(SQLITE3_ASSOC);
            return (int) $row['cnt'];
        }
        else 
        {
            throw new DtoException('Failed to prepare sql query.'); 
            return 0;           
        }        

      }      

    ### ---------------------------------------------------------------------
      public function createNote (array $table) : bool
      {
          $query = "INSERT INTO notes VALUES( NULL, :id_user, :title, :description, :date_write, NULL, :id_delete, :deadline)";
          $stmt = $this->conn->prepare($query);
          $stmt -> bindValue(':id_user', $table['id_user']);
          $stmt -> bindValue(':title', $table['title'], SQLITE3_TEXT);
          $stmt -> bindValue(':description', $table['description'],SQLITE3_TEXT);
          $stmt -> bindValue(':date_write', date("Y-m-d G:i"), SQLITE3_TEXT);
          $stmt -> bindValue(':id_delete', 0);
          $stmt -> bindValue(':deadline', $table['deadline']);

          if ($result = $stmt->execute()) 
          {
                return true;
          }
          else 
          {
                throw new DtoException('Failed to prepare sql query.'); 
                return false;           
          }            
      }

    ### ---------------------------------------------------------------------
      public function updateNote (array $table) : bool
      {
          $query = "UPDATE notes SET title = :title, description = :description, date_modify = :date_modify, deadline = :deadline WHERE id_note = :id_note AND id_user = :id_user";
          $stmt = $this->conn->prepare($query);
          $stmt -> bindValue(':id_note', $table['id_note']);
          $stmt -> bindValue(':id_user', $table['id_user']);
          $stmt -> bindValue(':title', $table['title'], SQLITE3_TEXT);
          $stmt -> bindValue(':description', $table['description'],SQLITE3_TEXT);
          $stmt -> bindValue(':date_modify', date("Y-m-d G:i"), SQLITE3_TEXT);
          $stmt -> bindValue(':deadline', $table['deadline'],SQLITE3_TEXT);

          if ($result = $stmt->execute()) 
          {
                return true;
          }

          else 
          {
                throw new DtoException('Failed to prepare sql query.'); 
                return false;           
          }          

      }      

    ### ---------------------------------------------------------------------
      public function deleteNote(int $id_note, int $id_user) : bool
      {
          $query = "UPDATE notes SET id_delete = '1', date_modify = :date_modify WHERE id_note = :id_note AND id_user = :id_user";
          $stmt = $this->conn->prepare($query);
          $stmt -> bindValue(':id_note', $id_note);
          $stmt -> bindValue(':id_user', $id_user);
          $stmt -> bindValue(':date_modify', date("Y-m-d G:i"), SQLITE3_TEXT);   
          if ($result = $stmt->execute()) 
          {
                return true;
          }
          else 
          {
                throw new DtoException('Failed to prepare sql query.'); 
                return false;           
          }             
      }

    ### ---------------------------------------------------------------------

      public function findNotes ($phrase, $id_user) : array
      {
        $query = "SELECT id_note, id_user, title, description, deadline FROM notes 
                  WHERE ( id_user = :id_user 
                  AND ( title LIKE (:phrase)
                  OR description LIKE (:phrase)
                  OR deadline LIKE (:phrase) ))";

        $stmt = $this->conn->prepare($query);
        $stmt -> bindValue(':id_user', $id_user);
        $stmt -> bindValue(':phrase', '%'.$phrase.'%');

        if ($result = $stmt->execute()) 
        {
            $returnResult = [];
            while ($row = $result->fetchArray(SQLITE3_ASSOC)) 
              {
                $returnResult[] = $row;
              }    
              return $returnResult; 
        }
        else
        {
          return [];
        }

      }
    
      ### ---------------------------------------------------------------------
    ### ---------------------------------------------------------------------
    /*
                        (id_user = :id_user)
                    AND 
                    (
                    title LIKE %:pharse% 
                    OR decription LIKE %:pharse% 
                    OR deadline LIKE %:pharse%)
                    )



      private function findNotesT(
        ?string $phrase,
        int $pageNumber,
        int $pageSize,
        string $sortBy,
        string $sortOrder
      ): array {
        try {
          $limit = $pageSize;
          $offset = ($pageNumber - 1) * $pageSize;
      
          if (!in_array($sortBy, ['created', 'title'])) {
            $sortBy = 'title';
          }
      
          if (!in_array($sortOrder, ['asc', 'desc'])) {
            $sortOrder = 'desc';
          }
      
          $wherePart = '';
          if ($phrase) {
            $phrase = $this->conn->quote('%' . $phrase . '%', PDO::PARAM_STR);
            $wherePart = "WHERE title LIKE ($phrase)";
          }
      
          $query = "
            SELECT id, title, created 
            FROM notes
            $wherePart
            ORDER BY $sortBy $sortOrder
            LIMIT $offset, $limit
          ";
      
          $result = $this->conn->query($query);
          return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Throwable $e) {
          throw new StorageException('Nie udało się pobrać notatek', 400, $e);
        }
      }
      */
      ### ---------------------------------------------------------------------
}




