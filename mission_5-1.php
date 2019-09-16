<?php
ini_set('display_errors',1);//画面にエラーを表示
error_reporting(E_ALL);//全ての種類のエラーを表示？
date_default_timezone_set('japan');
//データベース接続
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
//テーブル作成
$sql = "CREATE TABLE IF NOT EXISTS test2"
    ." ("
    . "id INT AUTO_INCREMENT PRIMARY KEY,"
    . "name char(32),"
    . "comment TEXT,"
    . "date datetime,"
    . "password TEXT"
    . ");";
$stmt = $pdo->query($sql);
//投稿機能
if(isset($_POST['form1'])){
    $name=$_POST['name'];//名前データ
	$comment=$_POST['comment'];//コメントデータ
	$password=$_POST['cpass'];
	$date=date('y/m/d h:i:s');
	    if(!empty($name) || !empty($comment)){
		    if(empty($comment)){
			    $comment='未入力';
		    }elseif(empty($name)){
			    $name='名無し';
		    }
		    $sql = $pdo -> prepare("INSERT INTO test2 (name, comment, date, password) VALUES (:name, :comment, :date, :password)");
	        $sql -> bindParam(':name', $name, PDO::PARAM_STR);
	        $sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
	        $sql -> bindParam(':date', $date, PDO::PARAM_STR);
	        $sql -> bindParam(':password', $password, PDO::PARAM_STR);
	        $sql -> execute();//データベースの登録を実行
			$sline='!--------------------------------------------------------!'.'<br>';
		    $eline='!--------------------------------------------------------!'.'<br>';
			$data=$name." ".$comment." を受け付けました。".'<br>';
	    }else{
	        $sline='!--------------------------------------------------------!'.'<br>';
		    $eline='!--------------------------------------------------------!'.'<br>';
		    $data="何も入力されていません".'<br>';
	    }
}
//編集機能
if(!empty($_POST['form2'])){
	if(!empty($_POST['ename'])&&!empty($_POST['ecomment'])&&!empty($_POST['epass'])){
		$epassword=$_POST["epass"];
        $Originpassword=$password;
        if($epassword=$Originpassword){
			$id=$_POST['edit']; //変更する投稿番号
			$name=$_POST['ename'];//名前データ
			$comment=$_POST['ecomment'];//コメントデータ
			$date=date('y/m/d h:i:s');
		    $sql = 'updatetime test2 set name=:name,comment=:comment,date=:date where id=:id';
			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(':name', $name, PDO::PARAM_STR);
			$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
			$stmt->bindParam(':date', $date, PDO::PARAM_STR);
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->execute();
			$sline='!--------------------------------------------------------!'.'<br>';
    		$eline='!--------------------------------------------------------!'.'<br>';
			$data=$id."を".$name." ".$comment." に変更しました。".'<br>';
		}
	}
}
//削除
if(!empty($_POST['form3'])){
	if(!empty($_POST['delete'])&&!empty($_POST['dpass'])){
    	$dpassword=$_POST["dpass"];
        $Originpassword=$password;
        if($dpassword=$Originpassword){
    		$id = $_POST['delete'];
    		$sql = 'delete from test2 where id=:id';
    		$stmt = $pdo->prepare($sql);
    		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
    		$stmt->execute();
    		$sline='!--------------------------------------------------------!'.'<br>';
    		$eline='!--------------------------------------------------------!'.'<br>';
			$data=$id."を削除しました。".'<br>';
		}
	}
}
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>mysql.test3</title>
    </head>
    <body>
    <h4>投稿フォーム</h4>
    <form method="POST" action="mysql.test3.php">
      <!--投稿フォームの作成-->
	  <label>名前 : </label>
	  <input type="text" name="name" placeholder="名前を入力">
      <label>コメント : </label>
      <input type="text" name="comment" placeholder="コメントを入力">
      <label>パスワード : </label>
	  <input type="password" name="cpass" placeholder="パスワードを入力">
      <input type="submit" name="form1" value="送信">
     </form>
	
	<h4>削除フォーム</h4>
    <form method="POST" action="mysql.test3.php">
      <label>削除 : </label>
	  <input type="text" name="delete" placeholder="削除対象番号を入力"><br>
	  <label>パスワード : </label>
	  <input type="password" name="dpass" placeholder="パスワードを入力">
	  <input type="submit" name="form3" value="削除">
	</form>
	
	<h4>編集フォーム</h4>
	<form method="POST" action="mysql.test3.php">
        <label>編集 :</label>
        <input type="text" name="edit" placeholder="編集対象番号を入力"><br>
        <label>名前 : </label>
	    <input type="text" name="ename" placeholder="名前を入力">
        <label>コメント : </label>
        <input type="text" name="ecomment" placeholder="コメントを入力">
        <label>パスワード : </label>
	  	<input type="password" name="epass" placeholder="パスワードを入力">
        <input type="submit" name="form2" value="編集"><br>
 	</form>
        <h4></h4>
 	       <?php
 	       echo $sline;
 	       echo '<br>'.$data.'<br>';
 	       echo $eline;
 	       ?>
    <form>
        <br><div>
        ------------------------------------<br>
        【投稿一覧】
        </div><br>
        <?php
            $sql = 'SELECT * FROM test2';
	        $stmt = $pdo->query($sql);
	        $results = $stmt->fetchAll();
	        foreach ($results as $row){
		        //$rowの中にはテーブルのカラム名が入る
		        echo $row['id'].'';
		        echo $row['name'].'';
		        echo $row['comment'].'';
		        echo $row['date'].'<br>';
	        }
        ?>
    </form>
    </body>
</html>
