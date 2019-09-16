<html>
<head>
	<title>mission1-5</title>
</head>
<body>
<?php

$age = 18;

if ($age <= 18) {
	echo "自動車免許が取れます";
} elseif ($age < 18) {
	echo "自動車免許はまだ取得できません";
} elseif ($age >= 85 ) {
	echo "免許を返納しませんか？";
}

?>
</body>
</html>