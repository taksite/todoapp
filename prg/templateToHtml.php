<?php

declare(strict_types=1);

# ###################### FUNCTIONS #######################

# zamienia wczytany szablon na html + odczyt zmiennych do wstawienia z tabeli 
# index tabeli to nazwa wystawiana w pliku pod postacią: {$var$}, gdzie var to index tabeli


function templateToHtml (string $template, array $table) : string

{

    if (!file_exists($template)) {
        return $templt="error";
    }

    $templt = file_get_contents ($template); // get template
    
    foreach($table as $ind => $data) {

        $templt=str_replace("{\$".$ind."\$}", $data, $templt);

    }
    $templt=preg_replace('({\$(.*?)\$})', "zapomniales!", $templt);   //wstawianie do pozostałości nie uwzględnionych w bazie
    return $templt;
}
