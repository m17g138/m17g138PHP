<?php
error_reporting(0);//全てのエラーを非表示
date_default_timezone_set('Asia/Tokyo');//どこの国の時間を参照するか
$fn = 'mission_3-3.txt';//ファイル名データ
$name = $_POST['name'];//名前データ
$cpass = $_POST['cpass'];//コメントパスワードデータ
$comment = $_POST['comment'];//コメントデータ
$edit = $_POST['edit'];//編集番号データ
$epass = $_POST['epass'];//編集パスワードデータ
$delete = $_POST['delete'];//削除番号データ
$dpass = $_POST['dpass'];//削除パスワードデータ
$date = date('Y年m月d日 H:i:s');//日時データ
//投稿機能
if(empty($edit) && !empty($cpass)){
	if(!empty($name) || !empty($comment)){
		if(empty($comment)){
			$comment = '未入力';
		}elseif(empty($name)){
			$name = '未入力';
		}
			$data = $name." ".$comment." を受け付けました。";
	}else{
		$name = '未入力';
		$comment = '未入力';
		$data = "何も入力されていません";
	}
	//ファイルに表示
	$fp = fopen($fn,'a');
	//投稿番号の取得
	if(file_exists($fn)){
		$lines=file($fn);
		$lastline=$lines[count($lines)-1];
		$postnumber=explode('<>',$lastline)[0]+1;
	}else{
		$postnumber=1;
	}
	$fd = $postnumber."<>".$name."<>".$comment."<>".$date."<>".$cpass."<>"."\n" ;
	fwrite($fp, $fd);
	fclose($fp);
}elseif(!empty($edit)&&!empty($cpass)){
	//編集機能
    $ret_array = file($fn); //読み込んだファイルの中身を配列に格納する
    $fp = fopen($fn,"w"); //ファイルを書き込みモードでオープン＋中身を空に
    foreach ($ret_array as $line){ //配列の数だけループさせる
    	$data = explode("<>", $line); //explode関数でそれぞれの値を取得
        if($data[0]==$edit && $data[4]==$cpass){ //投稿番号と編集番号が一致し、かつ、パスワードが一致したら
          	fwrite($fp, $edit."<>".$name."<>".$comment."<>".$date."<>".$cpass."<>"."編集済み"."<>"."\n"); //編集のフォームから送信された値と差し替えて上書き
        }else{
        	fwrite($fp, $line); //一致しなかったところはそのまま書き込む
        }
    }
    fclose($fp);
    $data = $edit."を編集しました";
}

 //編集データ読み出し機能
if(!empty($edit)&&!empty($epass)){
    $ediCon = file($fn);
    $fp = fopen($fn,'r+');
    for($e = 0; $e < count($ediCon); $e++){
        $ediData = explode("<>", $ediCon[$e]);
        if($ediData[0]==$edit && $ediData[4]==$epass){
        	$edinum = $ediData[0];
            $ediname = $ediData[1];
            $edicomment = $ediData[2];
        }
       	fclose($fp);
    }
}

//削除機能
if(!empty($delete)&&!empty($dpass)){
    $delCon = file($fn);
    $fp = fopen($fn,'w');
    for($j = 0; $j < count($delCon); $j++){
        $delData = explode("<>", $delCon[$j]);
        if($delData[0]==$delete && $delData[4]==$dpass){
         	fwrite($fp,"削除されました。\n");
            $data = "投稿を削除しました。";
        }else{
        	fwrite($fp, $delCon[$j]);
        }
    }
    fclose($fp);
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3-3</title>
</head>
<body>

	<h4>入力/編集フォーム</h4>
    <form action="mission_3-3.php" method="post">
      <!--入力フォームの作成-->
	  <label>名前 : </label>
	  <input type="text" name="name" placeholder="名前を入力" value="<?php if(isset($ediname)){echo $ediname;}?>" >
      <label>コメント : </label>
      <input type="text" name="comment" placeholder="コメントを入力" value="<?php if(isset($edicomment)) {echo $edicomment;} ?>">
      <label></label>
      <input type="hidden" name="edit" placeholder="編集対象番号を入力" value="<?php if(isset($edinum)) {echo $edinum;} ?>"><br>
      <label>パスワード : </label>
	  <input type="password" name="cpass" placeholder="パスワードを入力">
      <input type="submit" name="form1" value="送信">
     </form>
	
	<h4>削除フォーム</h4>
    <form method="POST" action="mission_3-3.php">
      <label>削除 : </label>
	  <input type="text" name="delete" placeholder="削除対象番号を入力"><br>
	  <label>パスワード : </label>
	  <input type="password" name="dpass" placeholder="パスワードを入力">
	  <input type="submit" name="form3" value="削除">
	</form>
	
	<h4>編集番号入力フォーム</h4>
	<form method="POST" action="mission_3-3.php">
        <label>編集 :</label>
        <input type="text" name="edit" placeholder="編集対象番号を入力"><br>
        <label>パスワード : </label>
	  	<input type="password" name="epass" placeholder="パスワードを入力">
        <input type="submit" name="form2" value="編集"><br>
 	</form>
 	
 	<h4></h4>
 	<?php
 	echo '--------------------------------------------------------------------------------------------';
 	echo '<br>'.$data.'<br>';
 	echo '--------------------------------------------------------------------------------------------'.'<br>';
 	?>
	<h4>投稿一覧</h4>
		<?php
			//ウェブ上に表示
			$fp = fopen($fn,'r');
			//ファイルを1行ずつ出力
			if($fp){
 				while($line = fgets($fp)){
  					$fdata = explode("<>", $line);
    				echo $fdata[0];
    				echo $fdata[1];
    				echo $fdata[2];
    				echo $fdata[3].'<br>';
    			}
			}
			fclose($fp);
		?>

</body>
</html>