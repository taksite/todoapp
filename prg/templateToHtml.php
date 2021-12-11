<?php

declare(strict_types=1);

# ###################### FUNCTIONS #######################

# zamienia wczytany szablon na html + odczyt zmiennych do wstawienia z tabeli 
# index tabeli to nazwa wystawiana w pliku pod postacią: {$var$}, gdzie var to index tabeli
# ========================================================================================================
# converts the loaded template to html + read variables to be inserted from the table
# table index is the name displayed in the file in the form: {$ var $}, where var is the table index
# ========================================================================================================

function templateToHtml (string $template, array $table) : string

{

    if (!file_exists($template)) {
        return $templt="error";
    }

    $templt = file_get_contents ($template); // get template
    
    foreach($table as $ind => $data) {

        $templt=str_replace("{\$".$ind."\$}", $data, $templt);

    }
    $templt=preg_replace('({\$(.*?)\$})', "zapomniales!", $templt);   //inserting if not included in the template
    return $templt;
}
