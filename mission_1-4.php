<html>
<head>
	<title>mission1-4</title>
</head>
<body>
<?php
//今年の西暦年ー自分の生まれた西暦年
echo 2019-1998;
echo '<br>';
//自分の年齢より干支で一回り上の方の年齢を加算で表示
//20+12
echo 20 + 12;
//自分の年齢より干支で二回り上の方の年齢を乗算で表示
echo '<br>';
echo 20 + (12*2);
//生まれてから夏季オリンピックを何回経験したか除算で算出しechoで表示しよう！
//余りを求め、余りを引いた上で除算しよう！
$nenrei = (2019-1998);
$amari = $nenrei % 4;
$kaisuu = ($nenrei - $amari)/4;
echo '<br>';
echo $kaisuu;
?>
</body>
</html>