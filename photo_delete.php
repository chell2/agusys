<?php
include('functions.php');
$pdo = connect_to_db();
$file_id = $_GET['file_id'];

$sql = 'DELETE FROM flood_damage_photo_table WHERE file_id=:file_id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':file_id', $file_id, PDO::PARAM_INT);

$status = $stmt->execute();

if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	header('Location:damagephoto_read.php');
	exit();
}
