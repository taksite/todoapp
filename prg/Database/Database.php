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
                echo ('wystąpił błąd połączenia z bazą.');
            }
            
        }

        public function closeDb ():void
        {
            unset($this->conn);
        }

        /*
        public function getConnect()
        {
            return $this->$conn;
        }
        */

}