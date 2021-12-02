<?php

### ---------------------------------------------------------------------
// configuration file

return [

    // SQLite file
    'database' => 
        [
            'file'      => './database/notes.sqlite3'
        ],

    'templates' =>
        [
            'path'          => "",
            'index'         => './template/templateIndex.php',
            'login'         => './template/login_tpl.php',
            'list'          => './template/main_page_tpl.php',
            'create'        => './template/create_tpl.php',
            'listNote'      => './template/list_note.php',
            'updateNote'    => './template/update_tpl.php',
            'search'        => './template/search_tpl.php',
            'note'          => './template/note_tpl.php'
        ]
];