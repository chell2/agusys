<?php
session_start();
include("functions.php");
check_session_id();

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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>申請編集画面</title>
	<style>
		body {
			font-family: Roboto, "Yu Gothic Medium", "游ゴシック Medium", YuGothic, "游ゴシック体", "ヒラギノ角ゴ Pro W3", "メイリオ", sans-serif;
		}

		h1 {
			color: #666;
			font-size: 1.2rem;
			text-align: center;
		}

		fieldset {
			border-color: #5b94e5;
			border-radius: 1rem;
		}

		legend {
			color: #5b94e5;
			font-weight: bold;
		}

		form {
			margin: .5rem auto;
			padding: auto;
		}

		form dl dt {
			width: 6rem;
			padding: 0.2rem;
			float: left;
			clear: both;
		}

		form dl dd {
			padding: 0.2rem;
		}

		textarea {
			resize: vertical;
			min-height: 16px;
			max-height: 200px;
		}

		input,
		textarea {
			width: 8.2rem;
			font-size: 90%;
		}

		button {
			display: block;
			margin: 0 auto 1rem;
		}

		.wrapForm {
			width: 290px;
			margin: auto;
			display: flex;
			justify-content: center;
			flex-direction: column;
		}
	</style>
</head>

<body>
	<form action="shinsei_update.php" method="POST" onsubmit="return false;">
		<!-- Enterキーでの誤送信を防ぐ(1) onsubmit="return false";でsubmitを中止 -->
		<fieldset>
			<legend>申請内容の編集</legend>
			<div class="wrapForm">
				<dl>
					<dt>り災原因:</dt>
					<dd><input type="date" name="cause" value="<?= $record['cause'] ?>">の<br>大雨/台風によるもの</dd>
					<dt>地区:</dt>
					<dd><select name="jaBranch" id="jaBranch" value=" <?= $record['jaBranch'] ?>"">
							<option hidden>--- ※ 地区を選択 ---</option>
							<option value=" 東部">東部</option>
							<option value="西部">西部</option>
							<option value="南部">南部</option>
							<option value="北部">北部</option>
						</select></dd>
					<dt>氏名:</dt>
					<dd><input type="text" name="reqName" id="reqName" value="<?= $record['reqName'] ?>"></dd>
					<dt>ふりがな:</dt>
					<dd><input type="text" name="kana" id="kana" value="<?= $record['kana'] ?>"></dd>
					<dt>生年月日:</dt>
					<dd><input type="date" name="birth" value="<?= $record['birth'] ?>"></dd>
					<dt>郵便番号:</dt>
					<!-- ▼郵便番号入力フィールド(7桁) -->
					<dd><input type="text" name="zip" onKeyUp="AjaxZip3.zip2addr(this,'','addr','addr');" id="zip" value="<?= $record['zip'] ?>"></dd>
					<dt>住所:</dt>
					<dd>
						<!-- ▼住所入力フィールド(都道府県+以降の住所) -->
						<textarea name="addr" id="addr" rows="2"><?php print($record['addr']); ?></textarea>
					</dd>
					<dt>TEL:</dt>
					<dd><input type="tel" name="tel" value="<?= $record['tel'] ?>"></dd>
					<dt>Eメール:</dt>
					<dd><input type="email" name="email" value="<?= $record['email'] ?>"></dd>
					<!-- あとで正規表現を追加 -->
					<dt>品目:</dt>
					<dd>
						<select name="item" value="<?= $record['item'] ?>">
							<option hidden>--- ※ 品目を選択 ---</option>
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
					</dd>
					<dt>圃場住所:</dt>
					<dd><input type="text" name="fieldAddr" value="<?= $record['fieldAddr'] ?>"></dd>
					<dt>面積:</dt>
					<dd><input type="number" min="0" step="0.01" name="fieldArea" value="<?= $record['fieldArea'] ?>">a</dd>
					<dt>浸水深:</dt>
					<dd><input type="number" min="0" step="0.5" name="levels" value="<?= $record['levels'] ?>">cm</dd>
					<dt>被害項目:</dt>
					<dd><select name="damages" value="<?= $record['damages'] ?>">
							<option hidden>--- ※ 項目を選択 ---</option>
							<option value="作物">作物</option>
							<option value="ハウス">ハウス</option>
							<option value="附帯施設">附帯施設</option>
							<option value="機械">農業用機械</option>
							<option value="その他">その他</option>
						</select></dd>
					<dt>被害額:</dt>
					<dd><input type="number" min="0" step="1" name="amounts" value="<?= $record['amounts'] ?>">円</dd>
					<dt>状況詳細:</dt>
					<dd><textarea name="memo" rows="4"><?php print($record['memo']); ?></textarea></dd>
				</dl>
				<button type="button" onclick="submit()"> 更新 </button>
				<input type="hidden" name="id" value="<?= $record['id'] ?>">
				<!-- Enterキーでの誤送信を防ぐ(2) type=”submit”だと送信されてしまうのでtype=”button”に変更。
            onclick=”submit();”でボタンを押した時だけsubmitさせる -->
			</div>
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