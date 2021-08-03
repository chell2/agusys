<?php
session_start();
include("functions.php");
check_session_id();
check_admin_id();

$id = $_GET["id"];
$pdo = connect_to_db();

$sql = 'SELECT * FROM staff_table WHERE id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	$record = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>管理者画面:アカウント編集</title>
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="staffpage.css">
</head>

<body>
	<div class="adminreadmain">
		<p class="msg">&emsp;管理者: <?= $_SESSION['staffname'] ?>さん</p>
		<p class="adminpagetitle">アカウント編集</p>
		&emsp;
		<a href="admin_read.php" class="linkstyle">職員一覧</a> /
		<a href="admin_logout.php" class="linkstyle">ログアウト</a>
		<form action="admin_update.php" method="POST">
			<fieldset>
				<div class="inputbox">
					<img src="icon/user.png" class="icon"> <input type="text" name="staffname" placeholder="職員ID" value="<?= $record["staffname"] ?>">
				</div>
				<div class="inputbox">
					<img src="icon/loginkey.png" class="icon"> <input type="text" name="password" placeholder="パスワード" value="<?= $record["password"] ?>">
				</div>
				<div class="inputbox">
					管理者権限: <input type="number" name="is_admin" step="1" min="0" max="1" value="<?= $record["is_admin"] ?>">
				</div>
				<div class="loginbtnwrap">
					<button class="loginbtn">コウシン</button>
				</div>
				<input type="hidden" name="is_deleted" value="<?= $record["is_deleted"] ?>">
				<input type="hidden" name="id" value="<?= $record["id"] ?>">
				<input type="hidden" name="adminname" value="<?= $_SESSION['staffname'] ?>">
			</fieldset>
		</form>
	</div>
</body>

</html>