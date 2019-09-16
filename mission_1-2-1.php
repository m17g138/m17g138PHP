<?php

$message = "HELLO,WORLD!";
$filename = "mission_1-3.txt";

$fp = fopen($filename ,"w");
fwrite( $fp ,  $message );
fclose( $fp );

?>