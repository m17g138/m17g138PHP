<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mission_2-2-2</title>
</head>
<style>
</style>
<body>
<form  method="post" action="mission_2-2-2.php">
<p>コメント</p>
    <input type="text" name="comment">
    <input type="submit" value="送信">
<?php
//ダブルクォーテーション「"」で扱った場合には変数が展開されますが、シングルクォーテーションは、変数の中身が取り出されず、そのまま表示されますので、変数名を表示したい時などには便利です。
// !は否定　つまり、下の文は、もし$_POST['comment']がemptyではないならば、$_POST['comment']を$commentに代入するという意味になる
//=== はnot same の意味。2つのオペランドの「値」と「型」が等しい場合はtrueを返します。そうでない場合にfalseを返します。
if(isset($_POST['comment'])){
   if (!empty($_POST['comment'])) {
    $comment = $_POST['comment'];
    echo '<br>';
    echo $comment.'を受け付けました';
   }else{
    echo '<br>';
    echo '入力されていません。';
 }
}



?>
</form>
</body>
</html>
