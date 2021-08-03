<?php
session_start();
include("functions.php");
check_session_id();

if (
	!isset($_POST['staffname']) || $_POST['staffname'] == '' ||
	!isset($_POST['password']) || $_POST['password'] == ''
) {
	header("Location:staff_register_noinput.php");
	exit();
}

$staffname = $_POST["staffname"];
$password = $_POST["password"];
$adminname = $_POST["adminname"];

$pdo = connect_to_db();
// DBにユーザデータがあるか検索
$sql = 'SELECT COUNT(*) FROM staff_table WHERE staffname=:staffname';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':staffname', $staffname, PDO::PARAM_STR);
$status = $stmt->execute();
if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
}

if ($stmt->fetchColumn() > 0) {
	header("Location:staff_register_error.php");
	exit();
}

$sql = 'INSERT INTO staff_table(id, staffname, password, is_admin, is_deleted, created_at, updated_at, created_by, updated_by) VALUES(NULL, :staffname, :password, 0, 0, sysdate(), sysdate(), :adminname, :adminname)';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':staffname', $staffname, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':adminname', $adminname, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	header("Location:admin_read.php");
	exit();
}
// var_dump($_POST);
// exit();