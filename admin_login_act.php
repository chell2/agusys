<?php
session_start();
include('functions.php');
$pdo = connect_to_db();
$staffname = $_POST['staffname'];
$password = $_POST['password'];
// DBにデータがあるか検索
$sql = 'SELECT * FROM staff_table
          WHERE staffname=:staffname
            AND password=:password
            AND is_admin=1
            AND is_deleted=0';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':staffname', $staffname, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();

if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	$val = $stmt->fetch(PDO::FETCH_ASSOC);
	if (!$val) {
		header("Location:admin_login_error.php");
		exit();
	} else {
		$_SESSION = array();
		$_SESSION["session_id"] = session_id();
		$_SESSION["is_admin"] = $val["is_admin"];
		$_SESSION["staffname"] = $val["staffname"];
		header("Location:admin_read.php");
		exit();
	}
}
