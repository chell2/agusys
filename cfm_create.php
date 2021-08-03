<?php
var_dump($_GET);
exit();

include('functions.php');

$pdo = connect_to_db();

$login_id = $_GET["login_id"];
$ok_cnt = $_GET["ok_cnt"];

$sql = "SELECT COUNT(*) FROM cfm_table WHERE login_id=:login_id AND ok_cnt=:ok_cnt";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(":login_id", $login_id, PDO::PARAM_INT);
$stmt->bindValue(":ok_cnt", $ok_cnt, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	$ok_count = $stmt->fetch();
}

if ($ok_count[0] != 0) {
	$sql = "DELETE FROM like_table WHERE login_id=:login_id AND ok_cnt=:ok_cnt";
} else {
	$sql = "INSERT INTO like_table(id, login_id, ok_cnt, created_at)VALUES(NULL, :login_id, :ok_cnt, sysdate())";
}
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":login_id", $login_id, PDO::PARAM_INT);
$stmt->bindValue(":ok_cnt", $ok_cnt, PDO::PARAM_INT);
$status = $stmt->execute();
if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	header("Location:admin_read.php");
	exit();
}
