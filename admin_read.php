<?php
session_start();
include("functions.php");
check_session_id();
check_admin_id();

$pdo = connect_to_db();
$login_id = $_SESSION["id"];  // staffnameが取れる

$sql = 'SELECT * FROM staff_table';
// $sql = "SELECT * FROM staff_table 
// LEFT OUTER JOIN (SELECT staff_id, COUNT(id) AS cnt 
// FROM cfm_table GROUP BY ok_cnt) AS ok 
// ON staff_table.id = ok.ok_cnt";

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$output = "";
	foreach ($result as $record) {
		$output .= "<tr>";
		$output .= "<td>{$record["staffname"]}</td>";
		$output .= "<td>{$record["password"]}</td>";
		$output .= "<td>{$record["is_admin"]}</td>";
		// $output .= "<td><a href='cfm_create.php?login_id={$login_id}&ok_cnt={$record["id"]}'>ok{$record["cnt"]}</a></td>";
		$output .= "<td><a href='admin_edit.php?id={$record["id"]}' class='iconlink'><i class='fas fa-edit'></i></a></td>";
		$output .= "<td><a href='admin_delete.php?id={$record["id"]}' onclick='return confirm_del();' class='iconlink'><i class='fas fa-trash-alt'></i></a></td>";
		$output .= "</tr>";
	}
	unset($value);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>管理者画面:職員一覧</title>
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<link rel="stylesheet" href="staffpage.css">
</head>

<body>
	<script>
		function confirm_del() {
			var select = confirm("本当に削除しますか？ \n「OK」で削除 \n「キャンセル」で中止");
			return select;
		}
	</script>
	<div class="adminreadmain">
		<p class="msg">&emsp;ログイン: <?= $_SESSION['staffname'] ?>さん</p>
		<p class="adminpagetitle">職員一覧</p>
		&emsp;
		<a href="admin_login.php" class="linkstyle">管理者ログイン画面</a> /
		<a href="staff_register.php" class="linkstyle">アカウント登録画面</a> /
		<a href="damagelist_read.php" class="linkstyle">申請一覧画面</a> /
		<a href="damagephoto_read.php" class="linkstyle">写真一覧画面</a> /
		<a href="admin_logout.php" class="linkstyle">ログアウト</a>
		<div class="stafflistwrap">
			<div class="stafflistinnerwrap">
				<table class="stafflist">
					<thead>
						<tr>
							<th>職員ID</th>
							<th>パスワード</th>
							<th>管理者権限</th>
							<!-- <th>確認</th> -->
							<th>編集</th>
							<th>削除</th>
						</tr>
					</thead>
					<tbody>
						<!-- ここに<tr><td>担当者Id</td><td>パスワード</td>...<tr>の形でデータが入る -->
						<?= $output ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>

</html>