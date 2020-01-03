<?php
ignore_user_abort(true);
set_time_limit(0);
@ini_set('error_log',NULL);
@ini_set('log_errors',0);

require_once('mcurl.class.php');
function read_file($file_name)
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

$script_name = $_SERVER['SCRIPT_FILENAME'];
$path = strrchr($script_name, '/');

$script_name = str_replace('/', "", $path);
$script_name = str_replace('php', 'txt', $script_name);

$all_domains = read_file($script_name);

$domains_for_work = $all_domains;

$urls = array ();
for ( $u=0; $u < 15; $u++ )
{
	$domains_for_work[$u] = trim($domains_for_work[$u]);
	if (($domains_for_work[$u] != '') and ($domains_for_work[$u] != ' ') and ($domains_for_work[$u] != null))
		$urls[] = trim($domains_for_work[$u]);
}


$mcurl = new MCurl();
$mcurl->setTimeout(30);
$mcurl->setUrls($urls);
$mcurl->scan();
$content = $mcurl->getResults();

$finish_result = array();

for ($i = 0; $i < count($content); $i++)
{
	$finish_result[$i]['url'] = $urls[$i];
	$finish_result[$i]['content'] = $content[$i];
}

	
$bad_list_name = 'bad_list_'.$script_name;
$good_list_name = 'good_list_'.$script_name;
$nl_list_name = 'not_loading_'.$script_name;

$check = "rvf";
$bj = fopen ($bad_list_name, "a");
fwrite($bj, "$check"."\n");

$gj = fopen ($good_list_name, "a");
fwrite($gj, "$check"."\n");

$nl = fopen ($nl_list_name, "a");
fwrite($nl, "$check"."\n");



for ($a = 0; $a < count($finish_result); $a++)
{
	$result = $finish_result[$a]['url'];
	
	if (($finish_result[$a]['content'] == '') or ($finish_result[$a]['content'] == null) or ($finish_result[$a]['content'] == ' '))
		fwrite($nl, $result."\n");
	else
	{	
			//$status2 = stristr($finish_result[$a]['content'], 'name="_"');
			//$status8 = stristr($finish_result[$a]['content'], 'BOFF 1.0');
			//$status11 = stristr($finish_result[$a]['content'], 'islamicshell');
			//$status12 = stristr($finish_result[$a]['content'], ':: Make File ::');
			
			//$status14 = stristr($finish_result[$a]['content'], 'name="_f__f"');
			//$status15 = stristr($finish_result[$a]['content'], 'name="MTQMTUNDQOGI" value=');
			
			//////////////////////////////////////////////////////////////////////////////////////
			$with_pass_wso_1 = stristr($finish_result[$a]['content'], '<input type=password name=pass><input type=submit value=');

			$interest_1 = stristr($finish_result[$a]['content'], 'r--r--r--');
			$interest_2 = stristr($finish_result[$a]['content'], '-rw-r--r--');
			$interest_3 = stristr($finish_result[$a]['content'], 'drwxr-xr-x');
			$interest_4 = stristr($finish_result[$a]['content'], '-r--r--r--');
			$interest_5 = stristr($finish_result[$a]['content'], '-rw-------');
			$interest_6 = stristr($finish_result[$a]['content'], 'u---------');
			$interest_7 = stristr($finish_result[$a]['content'], 'rwxr-xr-x');
			
			$without_pass_unknown_1 = stristr($finish_result[$a]['content'], '<input type="submit" value="SELF REMOVE" class="links"></form>');
			$without_pass_unknown_2 = stristr($finish_result[$a]['content'], 'Time On Server : <font color=#ffe28a>');
			$without_pass_unknown_3 = stristr($finish_result[$a]['content'], '<small>shell beta.</small>');
			$without_pass_unknown_4 = stristr($finish_result[$a]['content'], 'class="act">RENAME</a>  | <a href="');
			$without_pass_unknown_5 = stristr($finish_result[$a]['content'], 'target="_blank">Exploit-DB</a>');
			$without_pass_unknown_6 = stristr($finish_result[$a]['content'], '<th class=th_home style="background:black;color:yellow;" ><center>Permission</center></th>');
			$without_pass_unknown_7 = stristr($finish_result[$a]['content'], '<title>ZeroByte.ID PHP Backdoor');
			$without_pass_unknown_8 = stristr($finish_result[$a]['content'], '<title>ZeroByte.ID PHP Backdoor');
			$without_pass_unknown_9 = stristr($finish_result[$a]['content'], '<br>[ MySQL: <font color=#006600>ON</font>');
			$without_pass_unknown_10 = stristr($finish_result[$a]['content'], '<a href=\'?x=eval\' title=\'Execute code\' onclick=\'return false;\'><div class=\'menumi\'>Execute</div></a></td>');
			$without_pass_unknown_11 = stristr($finish_result[$a]['content'], '<span class=\'sembunyi\' id=\'chpwdform\'>');
			$without_pass_unknown_12 = stristr($finish_result[$a]['content'], '<title>flamux webshell');
			$without_pass_unknown_13 = stristr($finish_result[$a]['content'], '\'chdir\')">[Rename]</a>&nbsp;');
			$without_pass_unknown_14 = stristr($finish_result[$a]['content'], '">[New File]</a>&nbsp;');
			$without_pass_unknown_15 = stristr($finish_result[$a]['content'], '<option value="chmod">Chmod</option>');
			$without_pass_unknown_16 = stristr($finish_result[$a]['content'], '</font>|safemode:<font color');
			$without_pass_unknown_17 = stristr($finish_result[$a]['content'], '<th>Name</th><th>Permission</th><th>Size</th><th>Last Modified</th><th>action</th>');
			$without_pass_unknown_18 = stristr($finish_result[$a]['content'], '<option value="view">View known shells only</option>');
			$without_pass_unknown_19 = stristr($finish_result[$a]['content'], 'font-weight: bold;">PASS:PORT:SRC&nbsp;');
			$without_pass_unknown_20 = stristr($finish_result[$a]['content'], '<title>[ RC-SHELL');
			$without_pass_unknown_21 = stristr($finish_result[$a]['content'], '<marquee>Greetz  :  TiGER M@TE - R3liGiOus HuNt3r');
			$without_pass_unknown_22 = stristr($finish_result[$a]['content'], '<title>PhpSpy</title>');
			$without_pass_unknown_23 = stristr($finish_result[$a]['content'], '<a href="javascript:goaction(\'file\');">File Manager</a> |');
			$without_pass_unknown_24 = stristr($finish_result[$a]['content'], '<td nowrap>Current Directory (Writable, 0755)</td>');
			$without_pass_unknown_25 = stristr($finish_result[$a]['content'], '<td><a href="javascript:dofile(\'downrar\');">Packing download selected</a>');
			$without_pass_unknown_26 = stristr($finish_result[$a]['content'], '<font color="dodgerblue">FILE MANAGER</font></center>');
			$without_pass_unknown_27 = stristr($finish_result[$a]['content'], '<title>SadrazaM | Casus Shell</title>');
			$without_pass_unknown_28 = stristr($finish_result[$a]['content'], '&type=dir">+ New Dir</a>');
			$without_pass_unknown_29 = stristr($finish_result[$a]['content'], ')">Chmod</a> | <a href="');
			$without_pass_unknown_30 = stristr($finish_result[$a]['content'], '<input type="file" name="n[]" onchange="this.form.submit()" multiple>');
			$without_pass_unknown_31 = stristr($finish_result[$a]['content'], '<th width="17%">[ PERM ]</th>');
			$without_pass_unknown_32 = stristr($finish_result[$a]['content'], '<a href="javascript:void(0);" class="menu_options" onclick="g(\'sql\',null,\'\',\'\',\'\');">SQL Manager</a></li>');
			$without_pass_unknown_33 = stristr($finish_result[$a]['content'], '<option value=\'zip\'>Add 2 Compress (zip)</option>');
			$without_pass_unknown_34 = stristr($finish_result[$a]['content'], '<tr><td>$ execute a cmd</td></tr>');
			$without_pass_unknown_35 = stristr($finish_result[$a]['content'], '</b></td></tr><tr><td>~ server </td><td><b>');
			$without_pass_unknown_36 = stristr($finish_result[$a]['content'], '<center><h2>Gentoo @ MyHack</h2></center>');
			$without_pass_unknown_37 = stristr($finish_result[$a]['content'], 'Folder Baru</a> | <a href="#[New File]"');
			
			$without_pass_unknown_38 = stristr($finish_result[$a]['content'], 'm3ksi - NoTeaMs</title>');
			$without_pass_unknown_39 = stristr($finish_result[$a]['content'], '<h3>m3ksi - NoTeaMs</h3>');
			$without_pass_unknown_40 = stristr($finish_result[$a]['content'], '<tr><td align=right>Quick Commands:</td>');
			$without_pass_unknown_41 = stristr($finish_result[$a]['content'], '<option value="mkdir ...">mkdir</option>');
			$without_pass_unknown_42 = stristr($finish_result[$a]['content'], 'killall perl</option><option value="killall');
			$without_pass_unknown_43 = stristr($finish_result[$a]['content'], 'Dosya Upload : <input type="file" name="file" />');
			$without_pass_unknown_44 = stristr($finish_result[$a]['content'], '<tr><td>Bulundu?un Yer : <a href="?path');
			$without_pass_unknown_45 = stristr($finish_result[$a]['content'], 'x=upload">upload</a><li><a>Sym</a>');
			$without_pass_unknown_46 = stristr($finish_result[$a]['content'], '<tr><td>view file/folder</td><center><td><input onMouseOver=');
			$without_pass_unknown_47 = stristr($finish_result[$a]['content'], '<title>BlackhatCode Backdoor</title>');
			$without_pass_unknown_48 = stristr($finish_result[$a]['content'], '<td>Shell Backdoor Version : <b>');
			$without_pass_unknown_49 = stristr($finish_result[$a]['content'], 'x=wpreset">WordPress Password Reset</a>');
			$without_pass_unknown_50 = stristr($finish_result[$a]['content'], '<title>r57 bypass shell');
			$without_pass_unknown_51 = stristr($finish_result[$a]['content'], '<font color=blue><b>uname -a :&nbsp;<br>');
			$without_pass_unknown_52 = stristr($finish_result[$a]['content'], '<title>SHell by DarK');
			$without_pass_unknown_53 = stristr($finish_result[$a]['content'], 'ALFA TEaM SHeLL ::..</title>');
			$without_pass_unknown_54 = stristr($finish_result[$a]['content'], '">[ Cpanel and FTP Checker ]</a');
			$without_pass_unknown_55 = stristr($finish_result[$a]['content'], 'href="?solevisible">Hidden Shell Is Here ( Click )</font>');
			
			$without_pass_unknown_56 = stristr($finish_result[$a]['content'], '<title>Madspot Security Team Shell</title>');
			$without_pass_unknown_57 = stristr($finish_result[$a]['content'], 'Safe_mode_exec_dir:<font color=#');
			$without_pass_unknown_58 = stristr($finish_result[$a]['content'], '<font size=2 color=#888888><b>New name: </b></font><input type=text size=15 name="newname" class=ta>');
			$without_pass_unknown_59 = stristr($finish_result[$a]['content'], '<title>Peterson - Shell</title>');
			$without_pass_unknown_60 = stristr($finish_result[$a]['content'], '<title>0byteV2 - PHP Backdoor</title>');
			$without_pass_unknown_61 = stristr($finish_result[$a]['content'], '">[ Reverse Shell ]</a> <a href="?ext');
			$without_pass_unknown_62 = stristr($finish_result[$a]['content'], '<title>UnKnown - Simple Shell</title>');
			$without_pass_unknown_63 = stristr($finish_result[$a]['content'], '</b><br><font size=2 color=#888888><b>Uname :');
			
			
			
			$without_pass_unknown_64 = stristr($finish_result[$a]['content'], '<option value="create_symlink">create symlink</option>
		<option value="copy">copy</option>
		<option value="download">download</option>');
			
			$without_pass_unknown_65 = stristr($finish_result[$a]['content'], '<title>AndroGhost PHP Backdoor</title>');
			$without_pass_unknown_66 = stristr($finish_result[$a]['content'], 'class="act">DELETE</a> <a href="?action');
			$without_pass_unknown_67 = stristr($finish_result[$a]['content'], '<title>T E A M C O D E R - TWEAKED BY BRAT</title>');
			$without_pass_unknown_68 = stristr($finish_result[$a]['content'], '<span class="auto-style2">V2.0 B Y B R A T</span>');
			$without_pass_unknown_69 = stristr($finish_result[$a]['content'], '<b>SAFE_MODE : OFF</b><br><font size=2 color=#409e57><b>User');
			$without_pass_unknown_70 = stristr($finish_result[$a]['content'], '<h1 style="margin-bottom: 0">mavix1x</h1>');
			$without_pass_unknown_71 = stristr($finish_result[$a]['content'], '<TITLE>DLC - Simple Shell</TITLE>');
			$without_pass_unknown_72 = stristr($finish_result[$a]['content'], '<BR><B>SAFE_MODE : OFF</B><BR><B>User');
			$without_pass_unknown_73 = stristr($finish_result[$a]['content'], '<title>Welcome in D7net !</title>');
			$without_pass_unknown_74 = stristr($finish_result[$a]['content'], '<td class=td_home><center><font color="green">-rw-r');
			
			
			
			
			
			
			
			
			$without_pass_wso_1 = stristr($finish_result[$a]['content'], 'target=_blank>[exploit-db.com]</a></nobr>');
			$without_pass_wso_2 = stristr($finish_result[$a]['content'], 'Compress (tar.gz)</option>');
			$without_pass_wso_3 = stristr($finish_result[$a]['content'], 'value);return false;"><span>Make dir:</span>');
			$without_pass_wso_4 = stristr($finish_result[$a]['content'], "<span>Delete (file or dir):</span><br><input class='toolsInp'");
			
			$without_pass_4 = stristr($finish_result[$a]['content'], '<option value="delete">Delete</option>');
			$without_pass_5 = stristr($finish_result[$a]['content'], '">download</a>&nbsp;(<a href=');
			$without_pass_6 = stristr($finish_result[$a]['content'], '>delete</a> | <a href=');
			$without_pass_7 = stristr($finish_result[$a]['content'], '<center><h1>Dark Shell');
			$without_pass_8 = stristr($finish_result[$a]['content'], "&mode=create'>Create a new file</a></td>");
			$without_pass_9 = stristr($finish_result[$a]['content'], 'mode=rmdir&rm=.>Remove directory</a>');
			$without_pass_10 = stristr($finish_result[$a]['content'], 'ls">find all writable folders and files</option>');
			$without_pass_11 = stristr($finish_result[$a]['content'], 'Command execute ::</b></p></td>');
			$without_pass_12 = stristr($finish_result[$a]['content'], '<p align="left"><b>Install program:&nbsp;<font ');
			$without_pass_13 = stristr($finish_result[$a]['content'], "/<input type=hidden name=c value='");
			

			
			if ($with_pass_wso_1 !== false)
				fwrite($gj, $result." - WSO"."\n");
			elseif (($without_pass_wso_1 !== false) or ($without_pass_wso_2 !== false) or ($without_pass_wso_3 !== false) or ($without_pass_wso_4 !== false))
				fwrite($gj, $result." - without_pass_wso"."\n");
			elseif (($without_pass_4 !== false) or ($without_pass_5 !== false) or ($without_pass_6 !== false) or ($without_pass_7 !== false) or ($without_pass_8 !== false) or ($without_pass_9 !== false) or ($without_pass_10 !== false) or ($without_pass_11 !== false) or ($without_pass_12 !== false) or ($without_pass_13 !== false))
				fwrite($gj, $result." - without_pass_handmade"."\n");
			elseif (($without_pass_unknown_1 !== false) or ($without_pass_unknown_2 !== false) or ($without_pass_unknown_3 !== false) or ($without_pass_unknown_4 !== false) or ($without_pass_unknown_5 !== false) or ($without_pass_unknown_6 !== false) or ($without_pass_unknown_7 !== false) or ($without_pass_unknown_8 !== false) or ($without_pass_unknown_9 !== false) or ($without_pass_unknown_10 !== false) or ($without_pass_unknown_11 !== false) or ($without_pass_unknown_12 !== false) or ($without_pass_unknown_13 !== false) or ($without_pass_unknown_14 !== false) or ($without_pass_unknown_15 !== false) or ($without_pass_unknown_16 !== false) or ($without_pass_unknown_17 !== false) or ($without_pass_unknown_18 !== false) or ($without_pass_unknown_19 !== false) or ($without_pass_unknown_20 !== false) or ($without_pass_unknown_21 !== false) or ($without_pass_unknown_22 !== false) or ($without_pass_unknown_23 !== false) or ($without_pass_unknown_24 !== false) or ($without_pass_unknown_25 !== false) or ($without_pass_unknown_26 !== false) or ($without_pass_unknown_27 !== false) or ($without_pass_unknown_28 !== false) or ($without_pass_unknown_29 !== false) or ($without_pass_unknown_30 !== false) or ($without_pass_unknown_31 !== false) or ($without_pass_unknown_32 !== false) or ($without_pass_unknown_33 !== false) or ($without_pass_unknown_34 !== false) or ($without_pass_unknown_35 !== false) or ($without_pass_unknown_36 !== false) or ($without_pass_unknown_37 !== false) or ($without_pass_unknown_38 !== false) or ($without_pass_unknown_39 !== false) or ($without_pass_unknown_40 !== false) or ($without_pass_unknown_41 !== false) or ($without_pass_unknown_42 !== false) or ($without_pass_unknown_43 !== false) or ($without_pass_unknown_44 !== false) or ($without_pass_unknown_45 !== false) or ($without_pass_unknown_46 !== false) or ($without_pass_unknown_47 !== false) or ($without_pass_unknown_48 !== false) or ($without_pass_unknown_49 !== false) or ($without_pass_unknown_50 !== false) or ($without_pass_unknown_51 !== false) or ($without_pass_unknown_52 !== false) or ($without_pass_unknown_53 !== false) or ($without_pass_unknown_54 !== false) or ($without_pass_unknown_55 !== false) or ($without_pass_unknown_56 !== false) or ($without_pass_unknown_57 !== false) or ($without_pass_unknown_58 !== false) or ($without_pass_unknown_59 !== false) or ($without_pass_unknown_60 !== false) or ($without_pass_unknown_61 !== false) or ($without_pass_unknown_62 !== false) or ($without_pass_unknown_63 !== false) or ($without_pass_unknown_64 !== false) or ($without_pass_unknown_65 !== false) or ($without_pass_unknown_66 !== false) or ($without_pass_unknown_67 !== false) or ($without_pass_unknown_68 !== false) or ($without_pass_unknown_69 !== false) or ($without_pass_unknown_70 !== false) or ($without_pass_unknown_71 !== false) or ($without_pass_unknown_72 !== false) or ($without_pass_unknown_73 !== false) or ($without_pass_unknown_74 !== false))
				fwrite($gj, $result." - without pass unknown"."\n");
			elseif (($interest_1 !== false) or ($interest_2 !== false) or ($interest_3 !== false) or ($interest_4 !== false) or ($interest_5 !== false) or ($interest_6 !== false) or ($interest_7 !== false))
				fwrite($gj, $result." - interest"."\n");
			
			///////////////////////////////////////////////////////////////////////////////////////
			else
				fwrite($bj, $result."\n");
	}
		
}

fclose($nl);
fclose($gj);
fclose($bj);

for ( $i=0; $i < 15; $i++ )
{
	unset($all_domains[$i]);
}
sort ($all_domains);
		
$fnew = fopen($script_name, "w");
foreach ($all_domains as $each_domains)
{
	if (($each_domains !== '') and ($each_domains !== ' ') and ($each_domains !== null))
	{
		$each_domains = trim($each_domains);
		fwrite($fnew, $each_domains."\n");
	}
}
fclose($fnew);

?>