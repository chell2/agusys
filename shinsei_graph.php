<?php
session_start();
include("functions.php");
check_session_id();
?>

<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>確認画面</title>
	<style>
		body {
			font-family: Roboto, "Yu Gothic Medium", "游ゴシック Medium", YuGothic, "游ゴシック体", "ヒラギノ角ゴ Pro W3", "メイリオ", sans-serif;
			padding: auto 0.5rem;
		}

		iframe {
			border: 1px solid #666;
			border-radius: 8px;
			width: 98%;
			height: 350px;
			margin: auto;
		}

		/* .wrapChartL {
			display: flex;
			justify-content: center;
			flex-direction: column;
		}

		.wrapChartM {
			width: 90%;
			display: flex;
			margin: auto;
		}

		.wrapChartMM {
			width: 60%;
			display: flex;
			margin: auto;
		}

		.wrapChartS {
			width: 45%;
			height: auto;
			margin: auto;
		} */
	</style>
</head>

<body>
	<header>
		<div>
			<p><?= $_SESSION['staffname'] ?>さん！おつかれさまです！</p>
			<a href="shinsei_input.php">入力画面</a> /
			<a href="shinsei_read.php">申請一覧</a> /
			<a href="photo_read.php">受取写真</a> /
			<a href="shinsei_map.php">農振図</a> /
			<a href="staff_logout.php">ログアウト</a>
		</div>
	</header>
	<main>
		<div class="wrapIframe">
			<iframe id="txtRead" title="txtRead" src="shinsei_read.php">
			</iframe>
			<iframe id="imgRead" title="imgRead" src="photo_read.php">
			</iframe>
		</div>
		<!-- <div class="wrapChartL">
			<div class="wrapChartM">
				<div class="wrapChartS">
					<canvas id="myChart1"></canvas>
				</div>
				<div class="wrapChartS">
					<canvas id="myChart2"></canvas>
				</div>
			</div>
			<div class="wrapChartMM">
				<canvas id="myChart3"></canvas>
			</div>
		</div> -->
	</main>
	<footer>
	</footer>

	<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>

	<script type="text/javascript">
		// Chart1：ドーナッツ（被災品目内訳）
		var ctx1 = document.getElementById('myChart1').getContext('2d');
		var myChart = new Chart(ctx1, {
			type: 'doughnut',
			data: {
				labels: [
					'いちご',
					'軟弱野菜',
					'その他野菜',
					'花卉・花木',
					'その他'
				],
				datasets: [{
					label: '品目別件数',
					data: [1, 4, 4, 0, 0],
					backgroundColor: [
						'rgb(255, 99, 132)',
						'rgb(75, 192, 192)',
						'rgb(255, 205, 86)',
						'rgb(54, 162, 235)',
						'rgb(201, 203, 207)',
					],
					hoverOffset: 4
				}]
			}
		});

		// Chart2：鶏頭図（被災地区内訳）
		var ctx2 = document.getElementById('myChart2').getContext('2d');
		var myChart = new Chart(ctx2, {
			type: 'polarArea',
			data: {
				labels: [
					'東部',
					'西部',
					'南部',
					'北部'
				],
				datasets: [{
					label: '地区別件数',
					data: [3, 2, 1, 2],
					backgroundColor: [
						'rgb(255, 99, 132)',
						'rgb(75, 192, 192)',
						'rgb(255, 205, 86)',
						'rgb(54, 162, 235)'
					]
				}]
			}
		});

		// Chart3：複合グラフ（浸水深と被害件数）
		var ctx3 = document.getElementById('myChart3').getContext('2d');
		new Chart(ctx3, {
			type: "bar",
			data: {
				labels: ["〜50cm", "51〜60cm", "61〜70cm", "71cm以上"],
				datasets: [{
					label: "申請件数",
					data: [2, 4, 1, 1],
					borderColor: "rgb(255, 99, 132)",
					backgroundColor: "rgba(255, 99, 132, 0.2)"
				}, {
					label: "地区別",
					data: [3, 2, 1, 2],
					type: "line",
					fill: false,
					borderColor: "rgb(54, 162, 235)"
				}]
			},
			options: {
				scales: {
					yAxes: [{
						ticks: {
							beginAtZero: true
						}
					}]
				}
			}
		});
	</script> -->


</body>

</html>