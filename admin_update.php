<?php
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);

session_start();
include("functions.php");
check_session_id();
check_admin_id();

$staffname = $_POST['staffname'];
$password = $_POST['password'];
$is_admin = $_POST['is_admin'];
$is_deleted = $_POST['is_deleted'];
$adminname = $_POST['adminname'];
$id = $_POST['id'];
// DB接続
$pdo = connect_to_db();

$sql = "UPDATE staff_table SET staffname=:staffname, password=:password, is_admin=:is_admin, is_deleted=:is_deleted, updated_at=sysdate() ,updated_by=:adminname WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':staffname', $staffname, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':is_admin', $is_admin, PDO::PARAM_STR);
$stmt->bindValue(':is_deleted', $is_deleted, PDO::PARAM_STR);
$stmt->bindValue(':adminname', $adminname, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {

	// アップデート後の管理者数の確認
	// 0になる場合は「管理者権限」のみ1に戻して更新する
	$query = "SELECT SUM(is_admin) FROM staff_table";
	$stm = $pdo->prepare($query);
	$stm->execute();
	$row = $stm->fetch(PDO::FETCH_ASSOC);
	$sum = $row['SUM(is_admin)'];

	if ($sum < 1) {
		$stmt->bindValue(':is_admin', 1, PDO::PARAM_STR);
		$status = $stmt->execute();
		header("Location:admin_alert.php");
	} else {
		header("Location:admin_read.php");
		exit();
	}
}

// var_dump($_POST);
// exit();
