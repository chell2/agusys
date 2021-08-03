<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
	setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
echo "<script>alert('ログアウトしました．');
  setTimeout(function(){window.location.href = 'admin_login.php';}, 1)</script>";
// header('Location:admin_login.php');
exit();
