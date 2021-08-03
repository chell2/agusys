<?php
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);

include('functions.php');
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

$id = $_POST['id'];
$pdo = connect_to_db();

$sql = "UPDATE flood_damage_table SET cause=:cause,jaBranch=:jaBranch,reqName=:reqName,kana=:kana,birth=:birth,zip=:zip,addr=:addr,tel=:tel,email=:email,item=:item,fieldAddr=:fieldAddr,fieldArea=:fieldArea,levels=:levels,damages=:damages,amounts=:amounts,memo=:memo,created_at=sysdate(),updated_at=sysdate() WHERE id=:id";
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
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

$status = $stmt->execute();
// var_dump($_POST);
// exit();

if ($status == false) {
	$error = $stmt->errorInfo();
	echo json_encode(["error_msg" => "{$error[2]}"]);
	exit();
} else {
	header("Location:shinsei_graph.php");
	exit();
}
