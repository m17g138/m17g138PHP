<?php

$message = "HELLO,WORLD!";
$filename = "mission_1-2.txt";

$fp = fopen($filename ,"w");
fwrite( $fp ,  $message );
fclose( $fp );

?>