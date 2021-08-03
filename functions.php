<?php
function connect_to_db()
{
	$dbname = "agusys";
	$port = "3306";
	$host = "localhost";
	$user = "root";
	$pwd = "";

	$dbn = "mysql:dbname=$dbname;charset=utf8;port=$port;host=$host";

	// DB起動しない例外をキャッチする
	try {
		return new PDO($dbn, $user, $pwd);
	} catch (PDOException $e) {
		echo json_encode(["dberror" => "$e->getMessage()"]);
		exit();
	}
}

// ドライバオプション
// PDO::ERRMODE_EXCEPTION ..例外をスローしてくれる。これを選択しておくのが一番無難。
// DO::ATTR_DEFAULT_FETCH_MODE ..fetchメソッドで引数が省略された場合や，ステートメントがforeach文に直接かけられた場合のフェッチスタイルを設定。
// PDO::FETCH_ASSOC ..カラム名をキーとする連想配列で取得する
function dbc()
{
	// DB接続情報
	$dbname = "agusys";
	$port = "3306";
	$host = "localhost";
	$user = "root";
	$pwd = "";

	$dbn = "mysql:dbname=$dbname;charset=utf8;port=$port;host=$host";

	// DB起動しない例外をキャッチする
	try {
		$pdo = new PDO(
			$dbn,
			$user,
			$pwd,
			[
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			]
		);
		// echo "成功!";
		return $pdo;
	} catch (PDOException $e) {
		exit($e->getMessage());
	}
}
// dbc();


/*-----
* ファイルデータを保存する関数を定義
* @pram string $filename ファイル名
* @param string $save_path 保存先のパス
* @param string $caption 投稿の説明
* @return bool $result
*-----*/

function fileSave($filename, $save_path, $caption)
{
	$result = False;

	$sql = "INSERT INTO flood_damage_photo_table(file_name, file_path,
	caption) VALUE (?, ?, ?)";     // ???の中身は次のbind関数で設定
	try {
		$stmt = dbc()->prepare($sql);  // 準備
		$stmt->bindValue(1, $filename);
		$stmt->bindValue(2, $save_path);
		$stmt->bindValue(3, $caption);
		$result = $stmt->execute();    // executeで実行、
		return $result;                // returnで成功trueか失敗falseを返す
	} catch (\Exception $e) {
		echo $e->getMessage();         // エラーメッセージは本来はログに出力
		return $result;
	}
}

/*-----
* ファイルデータを取得する関数を定義
* 引数は不要
* @return array $fileData
*-----*/

function getAllFile()
{
	$sql = "SELECT*FROM flood_damage_photo_table";
	$fileData = dbc()->query($sql);
	return $fileData;
}

// 特殊文字のエスケープ処理を行う関数
// 参考 https://www.php.net/manual/ja/function.htmlspecialchars.php
function h($s)
{
	return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

// ログイン状態のチェック関数
function check_session_id()
{
	if (
		!isset($_SESSION['session_id']) ||
		$_SESSION['session_id'] != session_id()
	) {
		header('Location:staff_login.php');
	} else {
		session_regenerate_id(true);
		$_SESSION['session_id'] = session_id();
	}
}

function check_admin_id()
{
	// var_dump($_SESSION['is_admin']);
	// exit();
	if ($_SESSION['is_admin'] !== "1") {
		header('Location:admin_login.php');
	}
}
