<?php
$pass = '';
$pass_hash = password_hash($pass, PASSWORD_DEFAULT);
echo "\n\r".$pass_hash."\n\r";

// var_dump(password_verify($pass, $pass_hash));
