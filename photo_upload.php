<?php
// ini_set('display_errors', 1);
// ini_set('error_reporting', E_ALL);
include('functions.php');

// ファイル関連の取得
$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$upload_dir = 'imgs/';
$save_filename = date('YmdHis') . $filename;
$err_msgs = array();  // エラーメッセージを配列に入れ、1つ以上あれば送信不可とする。
$save_path = $upload_dir . $save_filename;

// キャプションを取得（サニタイズはセキュリティ的にやったほうがいいこと）
$caption = filter_input(INPUT_POST, 'caption', FILTER_SANITIZE_SPECIAL_CHARS);

// キャプションのバリデーション
// 未入力
if (empty($caption)) {
	array_push($err_msgs, 'キャプションを入力してください。');
}
// 140文字か
if (strlen($caption) > 140) {
	array_push($err_msgs, 'キャプションは140文字以内で入力してください。');
}
// ファイルのバリデーション
// ファイルサイズが1MB未満か
// エラーメッセージの2はファイルサイズが超えた時
// エラーの値参照 https://www.php.net/manual/ja/features.file-upload.errors.php
if ($filesize > 3145728 || $file_err == 2) {
	array_push($err_msgs, 'ファイルサイズは3MB未満にしてください。');
}

// 拡張は画像形式か
$allow_ext = array('jpg', 'jpeg', 'png', 'gif');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if (!in_array(strtolower($file_ext), $allow_ext)) {
	array_push($err_msgs, '画像ファイルを添付してください。');
}

if (count($err_msgs) === 0) {
	// ファイルはあるかどうか？
	if (is_uploaded_file($tmp_path)) {
		if (move_uploaded_file($tmp_path, $upload_dir . $save_filename)) {
			echo $filename . 'を' . $upload_dir . 'にアップしました！';

			// DBに保存（ファイル名、ファイルパス、キャプション）
			// 長くなるのでdbc.phpで別に処理を行う
			$result = fileSave($filename, $save_path, $caption);

			if ($result) {
				echo 'データベースに保存しました！';
				header('Location:photo_send.html');
			} else {
				echo 'データベースへの保存に失敗しました...';
			}
		} else {
			echo 'ファイルが保存できませんでした。';
		}
	} else {
		echo 'ファイルが選択されていません。';
	}
} else {
	foreach ($err_msgs as $msg) {
		echo $msg;
	}
}

?>
<div><a href="photo_form.php">戻る</a></div>