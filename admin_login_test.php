<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>管理者画面:ログイン</title>
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="staffpage.css">
	<style>
		body {
			font-family: Roboto, "Yu Gothic Medium", "游ゴシック Medium", YuGothic, "游ゴシック体", "ヒラギノ角ゴ Pro W3", "メイリオ", sans-serif;
			color: #666;
			font-size: 1.5em;
			min-width: 600px;
			/* background-color: rgba(34, 102, 30); */
		}

		/* 送信フォーム */
		fieldset {
			width: 87%;
			margin: 2.5em auto;
			padding: 0;
			border-color: #22661e;
			border-width: 0px;
			border-radius: 15px;
			background-color: #fff;
		}

		div.bg {
			margin: 0;
			padding: 0;
		}
	</style>
</head>

<body>
	<div class="bg" id="bg">
		<form action="admin_login_act.php" method="POST">
			<fieldset>
				<div class="logo">
					<img src="logo/agusyslogo_rcL.png" alt="logo" title="logo">
					<p class="adminpagetitle">管理者画面</p>
				</div>
				<div class="inputbox">
					<img src="icon/user.png" class="icon"> <input type="text" name="staffname" placeholder="職員ID">
				</div>
				<div class="inputbox">
					<img src="icon/loginkey.png" class="icon"> <input type="password" name="password" id="txtPass" placeholder="パスワード">
					<span id="btnEye" class="fa fa-eye" onclick="pushHideButton()"></span>
				</div>
				<div class="loginbtnwrap">
					<button class="loginbtn">ログイン</button>
				</div>
				<div class="linkwrap">
					<a href="staff_login.php" class="linkstyle">*担当者画面</a>
				</div>
			</fieldset>
		</form>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="Shards-master/shards.js"></script>
	<script>
		function pushHideButton() {
			var txtPass = document.getElementById("txtPass");
			var btnEye = document.getElementById("btnEye");
			if (txtPass.type === "text") {
				txtPass.type = "password";
				btnEye.className = "fa fa-eye";
			} else {
				txtPass.type = "text";
				btnEye.className = "fa fa-eye-slash";
			}
		}
		$(function() {
			$('#bg').shards(
				[10, 35, 180, .15],
				[255, 20, 220, .25],
				[0, 0, 0, .25],
				20,
				.58,
				2,
				.15,
				true
			);
		});
	</script>
</body>

</html>