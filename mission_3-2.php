<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-2</title>
</head>
<body>
	<h1>入力フォーム</h1>
    <form action="mission_3-2.php" method="post">
      <!--入力フォームの作成-->
	  <label>名前 : </label><br>
	  <input type="text" name="name" placeholder="フルネームで入力"><br>
      <label>コメント : </label><br>
      <input type="text" name="comment" placeholder="コメントを入力"><br>
      <input type="submit" name="form1" value="送信"><br>
    
    <h1>削除フォーム</h1>
      <label>削除 : </label><br>
	  <input type="text" name="delete" placeholder="対象削除番号を入力"><br>
	  <input type="submit" name="form2" value="削除"><br>
      
     </form>
<?php
//全てのエラーを非表示
error_reporting(0);
//どこの時間を参照するか指定
date_default_timezone_set('Asia/Tokyo');
// フォームから値が送信されてきているかの確認
if(isset($_POST['form1'])){
//以下の条件の時に指定の処理を行う→条件分岐
	if(isset($_POST['name']) && isset($_POST['comment'])){
		if(!empty($_POST['name']) && !empty($_POST['comment'])){
   			echo '<br>'.'"'.$_POST['name'].'"'."、".'"'.$_POST['comment'].'"'.' を受け付けました'.'<br>';
		}elseif(empty($_POST['name']) && !empty($_POST['comment'])){
   			echo '<br>'.'名前が入力されていません。'.'<br>';
   			echo '"'.$_POST['comment'].'"'.' を受け付けました'.'<br>';
   			$_POST['name'] = '"未入力"';
		}elseif(!empty($_POST['name']) && empty($_POST['comment'])){
 			echo '<br>'.'"'.$_POST['name'].'"'.' を受け付けました'.'<br>';
 			echo 'コメントが入力されていません。'.'<br>';
			$_POST['comment'] = '"未入力"';
  		}elseif(empty($_POST['name']) && empty($_POST['comment'])){
    		echo '<br>'.'名前'."、".'コメント'.'が入力されていません。'.'<br>';
		}
	}
	//空白でない場合はテキストファイルに$dataの文字列を入力する処理を行う。
	if(!empty($_POST['name']) || !empty($_POST['comment'])){
			$fp = fopen("mission_3-2.txt",'a');
			$postnumber = count( file("mission_3-2.txt") ); // ファイルのデータの行数を数えて$numに代入
			$postnumber++; // 投稿番号を取得
			$data = $postnumber."<>".$_POST['name']."<>".$_POST['comment']."<>".date('Y年m月d日 H:i:s')."\n" ;
			fwrite($fp, $data);
			fclose( $fp );
	}
	//テキストファイルのデータを配列に入れる処理
	echo '<br>';
	$file = fopen("mission_3-2.txt", "r");
    if($file){
  		while ($line = fgets($file)) {
  			$return = explode("<>", $line);
  	 		$fdata = implode(" ",$return);
    		echo $fdata.'<br>';
  			}
	}
}elseif(isset($_POST['form2'])){
	if(!empty($_POST['delete'])){
		if (isset($_POST["delete"])) {
    		$delete = $_POST["delete"];
    		$delCon = file("mission_3-2.txt");
    		$fp = fopen("mission_3-2.txt", 'w');
    		for ($j = 0; $j < count($delCon); $j++) {
        	$delDate = explode("<>", $delCon[$j]);
        	if ($delDate[0] != $delete) {
            	fwrite($fp, $delCon[$j]);
            	echo $delCon[$j].'<br>';
        	}else{
            	fwrite($fp, "消去しました。\n");
            	echo "消去しました。".'<br>';
        	}
        	}
    		fclose($fp);
		}
	}
	
}

//やること
//投稿番号の削除



?>

</body>
</html>