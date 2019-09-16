<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mission_2-2-1</title>
</head>
<style>
</style>
<body>
<form  method="post" action="mission_2-2-1.php">
<p>コメント</p>
    <input type="text" name="comment">
    <input type="submit" value="送信">
<?php

if(isset($_POST['comment'])){
   if (!empty($_POST['comment'])) {
    $message = $_POST['comment'];
      $filename = "mission_2-2-1.txt";
      $fp = fopen($filename ,"w");
      fwrite( $fp ,  $message );
      fclose( $fp );
   }else{
    echo '<br>';
    echo '入力されていません。';
    
 }
}

?>
</form>
</body>
</html>
