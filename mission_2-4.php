<html>
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<title>mission_2-4</title>
</head>
<style>
</style>
<body>
<form  method="post" action="mission_2-4.php">
<p>コメント</p>
    <input type="text" name="comment">
    <input type="submit" value="送信">
<?php
if(isset($_POST['comment'])){
	if(!empty($_POST['comment']) && $_POST['comment'] === '完成'){
  	echo '<br>';
  	echo 'おめでとう！'.'<br>';
  	$message = $_POST['comment'];
    $filename = "mission_2-4.txt";
    $fp = fopen($filename ,"a");
    fwrite( $fp ,  $message."\n");
    fclose( $fp );
  }elseif (!empty($_POST['comment'])) {
    $comment = $_POST['comment'];
    echo '<br>';
    echo '"'.$comment.'"'.' を受け付けました'.'<br>';
    $message = $_POST['comment'];
    $filename = "mission_2-4.txt";
    $fp = fopen($filename ,"a");
    fwrite( $fp ,  $message."\n");
    fclose( $fp );
  }else{
    echo '<br>';
    echo '入力されていません。'.'<br>';
    $message = "未入力";
    $filename = "mission_2-4.txt";
    $fp = fopen($filename ,"a");
    fwrite( $fp ,  $message."\n" );
    fclose( $fp );
 }
}

$file_name = "mission_2-4.txt"; /*読込ファイルの指定*/
$array = file( $file_name ); /*ファイルを全て配列に入れる*/
foreach ($array as $value) {
    echo $value . "<br />";
}
?>


</form>
</body>
</html>
