<?php
	// -- 関数の定義開始　--

		//#エスケープするための関数
		function hs( $str ) {
			return htmlspecialchars( $str, ENT_QUOTES, 'UTF-8' );
		}

	// -- 関数の定義終了

	//-- 変数の定義開始 --

		//#表示される年の月のカレンダーの日付を取得
		//アンカータグを使ってurlに表示された日付から取得する
		if(isset( $_GET['dates'] )) {
			$dates = $_GET['dates'];
		} else {
			$dates = date( 'Y-m' );
		}

		//#取得した日付をタイムスタンプに直し、使いやすくする
		$timeStamp = strtotime( $dates . '-01' );

		//#表示される月の前の月と後の月の日付を取得
		$prev = date( 'Y-m', mktime( 0,0,0,date( 'm', $timeStamp )-1,1,date( 'Y', $timeStamp ) ) );
		$next = date( 'Y-m', mktime( 0,0,0,date( 'm', $timeStamp )+1,1,date( 'Y', $timeStamp ) ) );

		//#今月の最後の日にちを取得する
		$lastDay = date('t', $timeStamp);

		//#その月の一日目が何曜日になるのかを取得
		$firstWeek = date( 'w', mktime( 0,0,0,date( 'm', $timeStamp ),1,date( 'Y', $timeStamp ) ) );

		//#weeksの中にweekを入れていく。一週間たったらweekを初期化
		$weeks = array();
		$week = '';

	// -- 変数の定義終了

	// -- 処理開始　--

		//#最初の日にちを曜日に合わせる
		$week .= str_repeat( '<td></td>', $firstWeek);

		#日にちを繰り返し
		for ($day=1; $day<=$lastDay; $day ++, $firstWeek ++) {

			//#日にちを繰り返してweekに加える
			$week .= sprintf( '<td>%d</td>', $day );

			if ($firstWeek % 7 == 6 || $day == $lastDay) {

				if ($day == $lastDay) {

					$week .= str_repeat( '<td></td>', 6 - ($firstWeek % 7) );

				}

				//改行する
				$weeks[] = '<tr class="week">' . $week . '</tr>';

				//weekの初期化
				$week = '';

			}

		}
	// -- 処理終了 --
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>CALENDER	</title>
	<style>
		body, h1, table, tr, th, td {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		.container {
			font-size: 20px;
			margin: 0 auto;
			width: 500px;
			text-align: center;
		}
		h1 {
			background-color: #000;
			color: #fff;
		}
		table {
			text-align: center;
			width: 500px;
		}
		th {
			background-color: #eee;
		}
		th, td {
			border: 2px solid #ccc;
			height: 40px;
		}
		.Day th:first-child,
		.week td:first-child {
			color: #f00;
		}
		.Day th:last-child,
		.week td:last-child {
			color: #00f;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1>CALENDER</h1>
		<table>
			<thead>
			<tr>
				<th><a href="?dates=<?php echo hs($prev); ?>">&laquo;</a></th>
				<th colspan="5"><?php echo date('Y-m', $timeStamp); ?></th>
				<th><a href="?dates=<?php echo hs($next); ?>">&raquo;</a></th>
			</tr>
			<tr class="Day">
				<th>日</th>
				<th>月</th>
				<th>火</th>
				<th>水</th>
				<th>木</th>
				<th>金</th>
				<th>土</th>
			</tr>
			</thead>
			<tbody>
				<?php
					foreach ($weeks as $week) {
						echo $week;
					}
				?>
			</tbody>
		</table>
	</div>
</body>
</html>
