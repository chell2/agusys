<?php
session_start();
include("functions.php");
check_session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>農振図</title>
	<style>
		body {
			font-family: Roboto, "Yu Gothic Medium", "游ゴシック Medium", YuGothic, "游ゴシック体", "ヒラギノ角ゴ Pro W3", "メイリオ", sans-serif;
			padding: auto 0.5rem;
		}

		#noushinzu {
			border: 1px solid #666;
			border-radius: 8px;
			width: 98%;
			height: 700px;
			margin: auto;
		}
	</style>
</head>

<body>
	<header>
		<div>
			<a href="shinsei_input.php">入力画面</a> /
			<a href="shinsei_read.php">申請一覧</a> /
			<a href="image_read.php">受取写真</a>
		</div>
	</header>
	<main>
		<iframe id="noushinzu" title="noushinzu" src="noushinzu.pdf">
		</iframe>
	</main>
</body>

</html>