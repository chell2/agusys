<?php
session_start();
include("functions.php");
check_session_id();

$pdo = connect_to_db();

$sql = 'SELECT * FROM flood_damage_table';

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
	$error = $stmt->errorInfo();
	exit('sqlError:' . $error[2]);
} else {
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$output = "";
	foreach ($result as $record) {
		$output .= "<tr>";
		$output .= "<td>{$record["id"]}</td>";
		$output .= "<td>{$record["cause"]}</td>";
		$output .= "<td>{$record["jaBranch"]}</td>";
		$output .= "<td>{$record["reqName"]}</td>";
		$output .= "<td>{$record["kana"]}</td>";
		$output .= "<td>{$record["birth"]}</td>";
		$output .= "<td>{$record["zip"]}</td>";
		$output .= "<td>{$record["addr"]}</td>";
		$output .= "<td>{$record["tel"]}</td>";
		$output .= "<td>{$record["email"]}</td>";
		$output .= "<td>{$record["item"]}</td>";
		$output .= "<td>{$record["fieldAddr"]}</td>";
		$output .= "<td>{$record["fieldArea"]}</td>";
		$output .= "<td>{$record["levels"]}</td>";
		$output .= "<td>{$record["damages"]}</td>";
		$output .= "<td>{$record["amounts"]}</td>";
		$output .= "<td>{$record["memo"]}</td>";

		// $output .= "<td><a href='cnf_create.php?appldata_id={$appldata_id}&staff_id={$record["id"]}'>like</a></td>";
		// $output .= "<td><a href='cfm_create.php?damage_id={$damage_id}&staff_id={$record["id"]}'>like{$record["cnt"]}</a></td>";

		$output .= "<td><a href='indiv_edit.php?id={$record["id"]}' class='iconlink'><i class='fas fa-edit'></i></a></td>";
		$output .= "<td><a href='shinsei_delete.php?id={$record["id"]}' onclick='return confirm_del();' class='iconlink'><i class='fas fa-trash-alt'></i></a></td>";
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
	<title>職員画面:申請一覧</title>
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
	<div class="applreadmain">
		<p class="msg">&emsp;ログインID: <?= $_SESSION['staffname'] ?>
			&emsp;&emsp;
			<a href="admin_login.php" class="linkstyle">管理者ログイン画面</a> /
			<a href="staff_register.php" class="linkstyle">アカウント登録画面</a> /
			<!-- <a href="shinsei_graph.php" class="linkstyle">申請一覧画面</a> / -->
			<a href="damagephoto_read.php" class="linkstyle">写真一覧画面</a> /
			<a href="admin_logout.php" class="linkstyle">ログアウト</a>
		</p>
		<p class="adminpagetitle">申請一覧</p>
		<div class="appllistwrap">
			<div class="appllistinnerwrap">
				<table class="appllist">
					<thead>
						<tr>
							<th>No.</th>
							<th>り災原因</th>
							<th>地区</th>
							<th>氏名</th>
							<th>ふりがな</th>
							<th>生年月日</th>
							<th>〒</th>
							<th>住所</th>
							<th>TEL</th>
							<th>Eメール</th>
							<th>品目</th>
							<th>圃場住所</th>
							<th>面積</th>
							<th>浸水深</th>
							<th>被害項目</th>
							<th>被害金額</th>
							<th>状況詳細</th>
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