<?php
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);
session_start();
include("functions.php");
check_session_id();

// DB接続
$pdo = connect_to_db();

// データ参照
$sql = 'SELECT * FROM flood_damage_table';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();   // SQLの実行結果(未取得)

if ($status == false) {
	$error = $stmt->errorInfo();
	exit('sqlError:' . $error[2]);
} else {
	$result = $stmt->fetchAll(PDO::FETCH_ASSOC);    // データの出力用変数、fetchAllで全データ取得
	$output = "";
	foreach ($result as $record) {
		$output .= "<tr>";
		// edit deleteリンクを追加
		$output .= "<td><a href=shinsei_delete.php?id={$record["id"]} onclick='return confirm_del();'><i class='fas fa-trash-alt'></i></a></td>";
		$output .= "<td><a href=shinsei_edit.php?id={$record["id"]}><i class='fas fa-edit'></i></a></td>";
		// ここからデータ
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
		$output .= "</tr>";
	}
	unset($record); // $recordの参照を解除
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
	<title>申請一覧</title>
	<style>
		body {
			font-family: Roboto, "Yu Gothic Medium", "游ゴシック Medium", YuGothic, "游ゴシック体", "ヒラギノ角ゴ Pro W3", "メイリオ", sans-serif;
		}

		p {
			color: #666;
			font-size: 1.2rem;
			text-align: center;
		}

		table {
			width: 100%;
			border-collapse: collapse;
			border-spacing: 0;
			font-size: .8rem;
		}

		table th,
		table td {
			padding: 10px 0;
			text-align: center;
		}

		table th {
			background-color: #eee;
		}

		table tr:nth-child(even) {
			background-color: #eee;
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
		<p>////////////// 申請一覧 //////////////</p>
		<div>
			<table>
				<thead>
					<tr>
						<th>削除</th>
						<th>編集</th>
						<th>No.</th>
						<th>り災原因</th>
						<th>地区</th>
						<th>氏名</th>
						<th>ふりがな</th>
						<th>生年月日</th>
						<th>郵便番号</th>
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
					</tr>
				</thead>
				<tbody>
					<?= $output ?>
				</tbody>
			</table>
		</div>
	</main>
</body>

</html>