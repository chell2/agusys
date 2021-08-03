<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>写真アップロード</title>
	<style>
		body {
			font-family: Roboto, "Yu Gothic Medium", "游ゴシック Medium", YuGothic, "游ゴシック体", "ヒラギノ角ゴ Pro W3", "メイリオ", sans-serif;
		}

		h1 {
			color: #666;
			font-size: 1.2rem;
			text-align: center;
		}

		fieldset {
			border-color: #5b94e5;
			border-radius: 1rem;
		}

		legend {
			color: #5b94e5;
			font-weight: bold;
		}

		form {
			margin: .5rem auto;
			padding: auto;
		}

		form dl dt {
			width: 6rem;
			padding: 0.2rem;
			float: left;
			clear: both;
		}

		form dl dd {
			padding: 0.2rem;
		}

		textarea {
			resize: vertical;
			min-height: 26px;
			max-height: 200px;
		}

		input,
		textarea {
			width: 90%;
			font-size: 90%;
		}

		button {
			display: block;
			margin: 1rem auto 1rem;
		}

		.wrapForm {
			width: 290px;
			margin: auto;
			display: flex;
			justify-content: center;
			flex-direction: column;
		}

		.imgarea {
			margin-top: 10px;
			margin-bottom: 10px;
		}

		img {
			max-width: 290px;
			max-height: 290px;
		}


		/* ぱんくずリスト */
		/*-- 最初にリスト要素のスタイルを初期化 --*/
		ul {
			margin: .2em;
			padding: 0;
			list-style: none;
		}

		#breadcrumbs {
			overflow: hidden;
			width: 60%;
		}

		#breadcrumbs li {
			float: left;
			margin: 0 1.8em 0 0;
			font-size: .8rem;
		}

		#breadcrumbs a {
			padding: .6em 0em .6em .6em;
			float: left;
			text-decoration: none;
			color: #444;
			background: #ddd;
			position: relative;
			z-index: 1;
			/* text-shadow: 0 1px 0 rgba(255, 255, 255, .5); */
			border-radius: .4em 0 0 .4em;
		}

		#breadcrumbs a:hover {
			background: #abe0ef;
		}

		#breadcrumbs a::after {
			background: #ddd;
			content: "";
			height: 2.4em;
			margin-top: -1.25em;
			position: absolute;
			right: -1em;
			top: 50%;
			width: 2.4em;
			z-index: -1;
			transform: rotate(45deg);
			border-radius: .4em;
		}

		#breadcrumbs a:hover::after {
			background: #abe0ef;
		}

		#breadcrumbs .current,
		#breadcrumbs .current:hover {
			color: #fff;
			background: #5b94e5;
		}

		#breadcrumbs .current::after {
			background: #5b94e5;
		}

		#breadcrumbs .current:hover::after {
			background: #5b94e5;
		}
	</style>
</head>

<body>
	<header>
		<div>
			<h1>り災の報告/証明書申請フォーム</h1>
		</div>
		<!-- ぱんくずリスト -->
		<nav>
			<ul id="breadcrumbs">
				<li><a href="shinsei_input.php">り災状況の入力</a></li>
				<!-- <li><a href="shinsei_create.php">確認・送信</a></li> -->
				<li><a href="" class="current">写真の送信</a></li>
				<li><a href="shinsei_graph.php">内容の確認</a></li>
			</ul>
		</nav>
	</header>

	<body>
		<form enctype="multipart/form-data" action="./photo_upload.php" method="POST">
			<fieldset>
				<legend>■ 被害状況がわかる写真</legend>
				<div class="wrapForm">
					<div class="imgarea">
						<input type="hidden" name="MAX_FILE_SIZE" value="3145728" />
						<input name="img" type="file" accept="image/*" />
					</div>
					<div>
						<textarea name="caption" placeholder="キャプション： 氏名・ほ場住所など（140文字以下）" id="caption"></textarea>
					</div>
					<button type="button" onclick="submit()">Upload</button>
				</div>
			</fieldset>
		</form>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
		</script>
		<script>
			$(function() {
				$('input[type=file]').after('<span></span>');

				// アップロードするファイルを選択
				$('input[type=file]').change(function() {
					var file = $(this).prop('files')[0];
					// 画像表示
					var reader = new FileReader();
					reader.onload = function() {
						var img_src = $('<img>').attr('src', reader.result);
						$('span').html(img_src);
					}
					reader.readAsDataURL(file);
				});
			});
		</script>
	</body>

</html>