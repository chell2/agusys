<?php
session_start();
include("functions.php");
// check_session_id();

$id = $_GET['id'];
$pdo = connect_to_db();
$sql = 'SELECT * FROM flood_damage_table WHERE id=:id';
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
	<title>職員画面:申請情報の編集</title>
	<link rel="stylesheet" href="staffpage.css">
	<style>
		fieldset.indiv {
			width: 96%;
			margin: 2.5em auto;
			padding: 0;
			border-color: #22661e;
			border-width: 0px;
			border-radius: 15px;
			background-color: #fff;
		}

		table.appllist {
			width: 100%;
			border-collapse: collapse;
			border-spacing: 0;
			font-size: .6em;
		}

		table.appllist thead th {
			/* 縦スクロール時に固定する */
			position: -webkit-sticky;
			position: sticky;
			top: 0;
			/* tbody内のセルより手前に表示する */
			z-index: 1;
		}

		table.appllist th,
		table.appllist td {
			padding: 5px 0;
			text-align: center;
		}

		table.appllist th {
			background-color: #eee;
		}

		table.appllist tr:nth-child(even) {
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
	<form action="shinsei_update.php" method="POST" onsubmit="return false;">
		<!-- Enterキーでの誤送信を防ぐ(1) onsubmit="return false";でsubmitを中止 -->
		<fieldset class="indiv">
			<p class="msg">&emsp;ログインID:
				<?= $_SESSION['staffname'] ?>
				&emsp;&emsp;
				<a href="admin_login.php" class="linkstyle">管理者ログイン画面</a> /
				<a href="staff_register.php" class="linkstyle">アカウント登録画面</a> /
				<a href="damagelist_read.php" class="linkstyle">申請一覧画面</a> /
				<a href="admin_logout.php" class="linkstyle">ログアウト</a>
			</p>
			<p class="adminpagetitle">個別データ編集</p>
			<div class="appllistwrap">
				<div class="appllistinnerwrap">
					<table class="appllist">
						<thead>
							<tr>
								<th>氏名:</th>
								<th><input type="text" name="reqName" id="reqName" value="<?= $record['reqName'] ?>"></th>
								<th>ふりがな:</th>
								<th><input type="text" name="kana" id="kana" value="<?= $record['kana'] ?>"></th>
								<th>生年月日:</th>
								<th><input type="date" name="birth" value="<?= $record['birth'] ?>"></th>
								<th>地区:</th>
								<th>
									<select name="jaBranch" id="jaBranch">
										<option><?= $record['jaBranch'] ?></option>
										<option value="東部">東部</option>
										<option value="西部">西部</option>
										<option value="南部">南部</option>
										<option value="北部">北部</option>
									</select>
								</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>郵便番号:</td>
								<!-- ▼郵便番号入力フィールド(7桁) -->
								<td><input type="text" name="zip" onKeyUp="AjaxZip3.zip2addr(this,'','addr','addr');" id="zip" value="<?= $record['zip'] ?>"></td>
								<td>住所:</td>
								<td>
									<!-- ▼住所入力フィールド(都道府県+以降の住所) -->
									<textarea name="addr" id="addr" rows="1"><?php print($record['addr']); ?></textarea>
								</td>
								<td>TEL:</td>
								<td><input type="tel" name="tel" value="<?= $record['tel'] ?>"></td>
								<td>Eメール:</td>
								<td><input type="email" name="email" value="<?= $record['email'] ?>"></td>
							</tr>
							<tr>
								<th>り災日:</th>
								<td><input type="date" name="cause" value="<?= $record['cause'] ?>"></td>
								<td>品目:</td>
								<td>
									<select name="item">
										<option><?= $record['item'] ?></option>
										<option value="小松菜">小松菜</option>
										<option value="サラダ菜">サラダ菜</option>
										<option value="リーフレタス">リーフレタス</option>
										<option value="ほうれんそう">ほうれんそう</option>
										<option value="その他軟弱">その他軟弱野菜</option>
										<option value="いちご">いちご</option>
										<option value="トマト">トマト</option>
										<option value="きゅうり">きゅうり</option>
										<option value="その他軟弱">その他野菜</option>
										<option value="菊">菊</option>
										<option value="その他花卉">その他花卉花木</option>
										<option value="その他園芸">その他園芸作物</option>
									</select>
								</td>
								<td>圃場住所:</td>
								<td><input type="text" name="fieldAddr" value="<?= $record['fieldAddr'] ?>"></td>
								<td>面積:</td>
								<td><input type="number" min="0" step="0.01" name="fieldArea" value="<?= $record['fieldArea'] ?>">a</td>
							</tr>
							<tr>
								<td>浸水深:</td>
								<td><input type="number" min="0" step="0.5" name="levels" value="<?= $record['levels'] ?>">cm</td>
								<td>被害項目:</td>
								<td>
									<select name="damages">
										<option><?= $record['damages'] ?></option>
										<option value="作物">作物</option>
										<option value="ハウス">ハウス</option>
										<option value="附帯施設">附帯施設</option>
										<option value="機械">農業用機械</option>
										<option value="その他">その他</option>
									</select>
								</td>
								<td>被害額:</td>
								<td><input type="number" min="0" step="1" name="amounts" value="<?= $record['amounts'] ?>">円
								</td>
								<td>状況詳細:</td>
								<td><textarea name="memo" rows="1"><?php print($record['memo']); ?></textarea></td>
							</tr>
						</tbody>
					</table>
					<button type="button" onclick="submit()"> 更新 </button>
					<input type="hidden" name="id" value="<?= $record['id'] ?>">
					<!-- Enterキーでの誤送信を防ぐ(2) type=”submit”だと送信されてしまうのでtype=”button”に変更。
						onclick=”submit();”でボタンを押した時だけsubmitさせる -->
		</fieldset>
	</form>
	</main>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
	</script>
	<!-- ふりがなのスクリプト -->
	<script src="jquery.autoKana.js" type="text/javascript"></script>
	<!-- 郵便番号のスクリプト -->
	<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>
	<script>
		$(function() {
			$.fn.autoKana('#reqName', '#kana');
		});
	</script>

</body>

</html>