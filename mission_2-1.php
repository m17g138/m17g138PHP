<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>mission_2-1</title>
</head>
<style>
</style>
<body>
<form  method="post" action="mission_2-1.php">
<p>コメント</p>
    <input type="text" name="comment">
    <input type="submit" value="送信">
<?php
$comment =  $_POST['comment'];
echo '<br>';
echo  $comment.'を受け付けました。';
?>
</form>
</body>
</html>