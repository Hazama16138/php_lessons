<?php
	//functions
	//時間を扱う関数
	//#time() -> 現在の時刻をタイムスタンプで取得
	$timeStamp = time();
	var_dump($timeStamp);

	//#date() -> 引数に渡した値のフォーマットで時間を取得
	$dateTime = date('Y-m-d');
	var_dump($dateTime);

	//また、第二引数にタイムスタンプを渡すとそれを基準に時間を取得

	$dateTime2 = date('Y-m-d', $timeStamp);
	var_dump($dateTime2);
?>
