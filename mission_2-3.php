<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mission_2-3</title>
</head>
<style>
</style>
<body>
<form  method="post" action="mission_2-3.php">
<p>コメント</p>
    <input type="text" name="comment">
    <input type="submit" value="送信">
<?php
if(isset($_POST['comment'])){
	if(!empty($_POST['comment']) && $_POST['comment'] === '完成'){
  	echo '<br>';
  	echo 'おめでとう！';
  	$message = $_POST['comment'];
    $filename = "mission_2-3.txt";
    $fp = fopen($filename ,"a");
    fwrite( $fp ,  $message."\n");
    fclose( $fp );
  }elseif (!empty($_POST['comment'])) {
    $comment = $_POST['comment'];
    echo '<br>';
    echo $comment.'を受け付けました';
    $message = $_POST['comment'];
    $filename = "mission_2-3.txt";
    $fp = fopen($filename ,"a");
    fwrite( $fp ,  $message."\n");
    fclose( $fp );
  }else{
    echo '<br>';
    echo '入力されていません。';
    $message = "未入力";
    $filename = "mission_2-3.txt";
    $fp = fopen($filename ,"a");
    fwrite( $fp ,  $message."\n" );
    fclose( $fp );
 }
}
?>
</form>
</body>
</html>
