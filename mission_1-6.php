<html>
<head>
	<title>mission1-6</title>
</head>
<body>
<?php
$fast_year = 2000;
$now_year = 2019;

for($year = $fast_year; $year <= $now_year; $year = $year + 4 ) {
echo $year."<br>";
}
echo "<br>";

$shiritori = array("しりとり","りんご","ごりら","らっぱ","ぱんだ");
echo $shiritori[2]."<br>";

$anki = "";
$shiritori = array("しりとり","りんご","ごりら","らっぱ","ぱんだ");
foreach($shiritori as $word){
$anki = $anki.$word;
echo $anki."<br>";
}

?>
</body>
</html>
