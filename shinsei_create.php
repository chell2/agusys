<?php

// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);

if (
	!isset($_POST['cause']) || $_POST['cause'] == '' ||
	!isset($_POST['jaBranch']) || $_POST['jaBranch'] == '' ||
	!isset($_POST['reqName']) || $_POST['reqName'] == '' ||
	!isset($_POST['kana']) || $_POST['kana'] == '' ||
	!isset($_POST['birth']) || $_POST['birth'] == '' ||
	!isset($_POST['zip']) || $_POST['zip'] == '' ||
	!isset($_POST['addr']) || $_POST['addr'] == '' ||
	!isset($_POST['tel']) || $_POST['tel'] == '' ||
	!isset($_POST['email']) || $_POST['email'] == '' ||
	!isset($_POST['item']) || $_POST['item'] == '' ||
	!isset($_POST['fieldAddr']) || $_POST['fieldAddr'] == '' ||
	!isset($_POST['fieldArea']) || $_POST['fieldArea'] == '' ||
	!isset($_POST['levels']) || $_POST['levels'] == '' ||
	!isset($_POST['damages']) || $_POST['damages'] == '' ||
	!isset($_POST['amounts']) || $_POST['amounts'] == '' ||
	!isset($_POST['memo']) || $_POST['memo'] == ''
) {
	exit('ParamError...');
}

// データを変数に格納
$cause = $_POST['cause'];
$jaBranch = $_POST['jaBranch'];
$reqName = $_POST['reqName'];
$kana = $_POST['kana'];
$birth = $_POST['birth'];
$zip = $_POST['zip'];
$addr = $_POST['addr'];
$tel = $_POST['tel'];
$email = $_POST['email'];
$item = $_POST['item'];
$fieldAddr = $_POST['fieldAddr'];
$fieldArea = $_POST['fieldArea'];
$levels = $_POST['levels'];
$damages = $_POST['damages'];
$amounts = $_POST['amounts'];
$memo = $_POST['memo'];

// DB接続情報
$dbn = 'mysql:dbname=agusys;charset=utf8;port=3306;host=localhost';
$user = 'root';
$pwd = '';

// DB接続
try {
	$pdo = new PDO($dbn, $user, $pwd);
} catch (PDOException $e) {
	echo json_encode(["db error" => "{$e->getMessage()}"]);
	exit();
}

// SQL作成&実行
$sql = 'INSERT INTO
           flood_damage_table(id, cause, jaBranch, reqName, kana, birth, zip, addr,
		   tel, email, item, fieldAddr, fieldArea, levels, damages, amounts,
		   memo, created_at, updated_at)
           VALUES(NULL, :cause, :jaBranch, :reqName, :kana, :birth, :zip, :addr,
		   :tel, :email, :item, :fieldAddr, :fieldArea, :levels, :damages, :amounts,
		   :memo, sysdate(), sysdate())';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':cause', $cause, PDO::PARAM_STR);
$stmt->bindValue(':jaBranch', $jaBranch, PDO::PARAM_STR);
$stmt->bindValue(':reqName', $reqName, PDO::PARAM_STR);
$stmt->bindValue(':kana', $kana, PDO::PARAM_STR);
$stmt->bindValue(':birth', $birth, PDO::PARAM_STR);
$stmt->bindValue(':zip', $zip, PDO::PARAM_STR);
$stmt->bindValue(':addr', $addr, PDO::PARAM_STR);
$stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
$stmt->bindValue(':email', $email, PDO::PARAM_STR);
$stmt->bindValue(':item', $item, PDO::PARAM_STR);
$stmt->bindValue(':fieldAddr', $fieldAddr, PDO::PARAM_STR);
$stmt->bindValue(':fieldArea', $fieldArea, PDO::PARAM_STR);
$stmt->bindValue(':levels', $levels, PDO::PARAM_STR);
$stmt->bindValue(':damages', $damages, PDO::PARAM_STR);
$stmt->bindValue(':amounts', $amounts, PDO::PARAM_STR);
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
// var_dump($_POST);
// exit();
$status = $stmt->execute(); // SQLを実行



if ($status == false) {
	// 失敗の場合
	$error = $stmt->errorInfo();
	exit('sqlError:' . $error[2]);
} else {
	// 成功の場合
	header('Location:shinsei_send.html');
}
