<?php
declare(strict_types=1);

namespace Dto\Database;
use SQLite3;

class Database {

        protected object $conn;
        private string $configDb = "";  

        public function __construct (string $configDb = "./database/notes.sqlite3")
        {
            $this->configDb = $configDb;

            try {
                
                $this->conn =  new SQLite3($this->configDb,SQLITE3_OPEN_READWRITE);
            }
            catch (Exception $e)
            {
                throw new DtoException('Failed to prepare sql query.'); 
            }
            
        }

        public function closeDb ():void
        {
            unset($this->conn);
        }

}