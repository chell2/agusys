<?php
include('functions.php');
$files = getAllFile();

?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<title>写真一覧</title>
	<style>
		body {
			font-family: Roboto, "Yu Gothic Medium", "游ゴシック Medium", YuGothic, "游ゴシック体", "ヒラギノ角ゴ Pro W3", "メイリオ", sans-serif;
			width: 97%;
		}

		p {
			color: #666;
			font-size: 1.2rem;
			text-align: center;
		}

		img {
			width: 300px;
			height: auto;
		}
	</style>
</head>

<body>
	<script>
		function confirm_del() {
			var select = confirm("本当に削除しますか？ \n「OK」で削除 \n「キャンセル」で中止");
			return select;
		}
	</script>
	<main>
		<p>////////////// 写真一覧 //////////////</p>

		<div>
			<?php foreach ($files as $file) : ?>
				<!-- foreach(配列 as 変数名) 配列の中身を先頭から順に展開する（変数に入って出力される） -->
				<img src="<?php echo "{$file['file_path']}"; ?>" alt="">
				<?php echo h("{$file['caption']}"); ?>
				<!-- functions.phpで定義した関数h() -->
				<?php echo h(" / {$file['file_name']}"); ?>
				<?php echo "<a href=photo_delete.php?file_id={$file['file_id']} onclick='return confirm_del();'><i class='fas fa-trash-alt'></i></a>" ?>
			<?php endforeach; ?>
		</div>
	</main>

</body>

</html>