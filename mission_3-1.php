<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-1</title>
</head>
<body>
	<h1>入力フォーム</h1>
    <form action="mission_3-1.php" method="post">
      <!--入力フォームの作成-->
	  <label>名前 : </label><br>
	  <input type="text" name="name" placeholder="フルネームで入力"><br>
      <label>コメント : </label><br>
      <input type="text" name="comment" placeholder="コメントを入力"><br>
      <input type="submit" value="送信"><br>

     </form>
<?php
//全てのエラーを非表示
error_reporting(0);
//どこの時間を参照するか指定
date_default_timezone_set('Asia/Tokyo');
// フォームから値が送信されてきているかの確認
if(isset($_POST['name']) && isset($_POST['comment'])){
	if(!empty($_POST['name']) && !empty($_POST['comment'])){
   		echo '<br>'.'"'.$_POST['name'].'"'."、".'"'.$_POST['comment'].'"'.' を受け付けました'.'<br>';
		$fp = fopen("mission_3-1.txt", "a");
		$postnumber = count( file ("mission_3-1.txt"));
		$postnumber++;
		$data = $postnumber."<>".$_POST['name']."<>".$_POST['comment']."<>".date('Y年m月d日 H:i:s')."\n" ;
		fwrite($fp, $data);
		fclose( $fp );
	}elseif(empty($_POST['name']) && !empty($_POST['comment'])){
   		echo '<br>'.'名前が入力されていません。'.'<br>';
   		echo '"'.$_POST['comment'].'"'.' を受け付けました'.'<br>';
   		$_POST['name'] = '"未入力"';
		$fp = fopen("mission_3-1.txt", "a");
		$postnumber = count( file ("mission_3-1.txt"));
		$data = $postnumber."<>".$_POST['name']."<>".$_POST['comment']."<>".date('Y年m月d日 H:i:s')."\n" ;
		fwrite($fp, $data);
		fclose( $fp );
	}elseif(!empty($_POST['name']) && empty($_POST['comment'])){
 		echo '<br>'.'"'.$_POST['name'].'"'.' を受け付けました'.'<br>';
 		echo 'コメントが入力されていません。'.'<br>';
		$_POST['comment'] = '"未入力"';
		$fp = fopen("mission_3-1.txt", "a");
		$postnumber = count( file ("mission_3-1.txt"));
		$data = $postnumber."<>".$_POST['name']."<>".$_POST['comment']."<>".date('Y年m月d日 H:i:s')."\n" ;
		fwrite($fp, $data);
		fclose( $fp );
  	}else{
    	echo '<br>'.'名前'."、".'コメント'.'が入力されていません。'.'<br>';
    	$_POST['name'] = '"未入力"';
    	$_POST['comment'] = '"未入力"';
		$fp = fopen("mission_3-1.txt", "a");
		$postnumber = count( file ("mission_3-1.txt"));
		$data = $postnumber."<>".$_POST['name']."<>".$_POST['comment']."<>".date('Y年m月d日 H:i:s')."\n" ;
		fwrite($fp, $data);
		fclose( $fp );
	}
echo '<br>';
$file_name = "mission_3-1.txt"; /*読込ファイルの指定*/
$array = file($file_name); /*ファイルを全て配列に入れる*/
foreach ($array as $value) {
    $return = explode("<>", $value);
    echo $return[0]." ".$return[1]." ".$return[2]." ".$return[3].'<br>';
    }

}
  


?>

</body>
</html>