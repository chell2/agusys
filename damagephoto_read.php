<?php
session_start();
include("functions.php");
check_session_id();


$files = getAllFile();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>職員画面:写真一覧</title>
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="staffpage.css">
	<style>
		img {
			width: 270px;
			height: auto;
		}

		.appllistinnerwrap {
			font-size: .8em;
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
	<div class="applreadmain">
		<p class="msg">&emsp;ログインID: <?= $_SESSION['staffname'] ?>
			&emsp;&emsp;
			<a href="admin_login.php" class="linkstyle">管理者ログイン画面</a> /
			<a href="staff_register.php" class="linkstyle">アカウント登録画面</a> /
			<a href="damagelist_read.php" class="linkstyle">申請一覧画面</a> /
			<a href="admin_logout.php" class="linkstyle">ログアウト</a>
		</p>
		<p class="adminpagetitle">写真一覧</p>
		<div class="appllistwrap">
			<div class="appllistinnerwrap">
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
			</div>
		</div>
	</div>
</body>

</html>