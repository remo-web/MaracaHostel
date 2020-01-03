<?php
/**
 * 
 *  @package HREFLANG Tags\Includes\Variables
 *  @since 1.3.3
 * 
 */

if ( ! function_exists( 'add_filter' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

require_once( ABSPATH . 'wp-admin/includes/translation-install.php' );
$hreflanguages = wp_get_available_translations();
$hreflanguages['it'] = array('language' => 'it','english_name' => 'Italian','native_name' => 'Italiano','iso' => array('it'));
$hreflanguages['it_IT'] = array('language' => 'it_IT','english_name' => 'Italian (Italy)','native_name' => 'Italiano (Italia)','iso' => array('it'));
$hreflanguages['fr'] = array('language' => 'fr','english_name' => 'French','native_name' => 'Français','iso' => array('fr'));
$hreflanguages['es'] = array('language' => 'es','english_name' => 'Spanish','native_name' => 'Español','iso' => array('es'));
$hreflanguages['de'] = array('language' => 'de','english_name' => 'German (DE)','native_name' => 'Deutsch','iso' => array('de'));
$hreflanguages['de_AT'] = array('language' => 'de_AT','english_name' => 'German (Austria)','native_name' => 'Deutsch','iso' => array('de'));
$hreflanguages['kk'] = array('language' => 'kk','english_name' => 'Kazakh','native_name' => 'қазақ тілі','iso' => array('kk'));
$hreflanguages['tk'] = array('language' => 'tk','english_name' => 'Turkmen','native_name' => 'Türkmen','iso' => array('tk'));
$hreflanguages['uz'] = array('language' => 'uz','english_name' => 'Uzbek','native_name' => 'Oʻzbek','iso' => array('uz'));
$hreflanguages['tg'] = array('language' => 'tg','english_name' => 'Tajik','native_name' => 'тоҷикӣ','iso' => array('tg'));
$hreflanguages['en'] = array('language' => 'en','english_name' => 'English (EN)','native_name' => 'English','iso' => array('en','eng','eng'));
$hreflanguages['x-default'] = array('language' => '','english_name' => ' X-Default','native_name' => ' X-Default');
$hreflanguages['en_US'] = array('language' => 'en_US','english_name' => 'English (United States)','native_name' => 'English (United States)','iso' => array('en','eng','eng'));
$hreflanguages['en_IE'] = array('language' => 'en_IE','english_name' => 'English (Ireland)','native_name' => 'English (Ireland)','iso' => array('en','eng','eng'));
$hreflanguages['en_PH'] = array('language' => 'en_PH','english_name' => 'English (Philippines)','native_name' => 'English (Philippines)','iso' => array('en','eng','eng'));
$hreflanguages['en_HK'] = array('language' => 'en_HK','english_name' => 'English (Hong Kong)','native_name' => 'English (Hong Kong)','iso' => array('en','eng','eng'));
$hreflanguages['en_ID'] = array('language' => 'en_ID','english_name' => 'English (Indonesia)','native_name' => 'English (Indonesia)','iso' => array('en','eng','eng'));
$hreflanguages['en_MM'] = array('language' => 'en_MM','english_name' => 'English (Myanmar)','native_name' => 'English (Myanmar)','iso' => array('en','eng','eng'));
$hreflanguages['en_SG'] = array('language' => 'en_SG','english_name' => 'English (Singapore)','native_name' => 'English (Singapore)','iso' => array('en','eng','eng'));
$hreflanguages['en_MY'] = array('language' => 'en_MY','english_name' => 'English (Malaysia)','native_name' => 'English (Malaysia)','iso' => array('en','eng','eng'));
$hreflanguages['en_RO'] = array('language' => 'en_RO','english_name' => 'English (Romanian)','native_name' => 'English (Romanian)','iso' => array('en','eng','eng'));
$hreflanguages['nl_BE'] = array('language' => 'nl_BE','english_name' => 'Dutch (Belgium)','native_name' => 'Vlaams','iso' => array('nl'));
$hreflanguages['fr_LU'] = array('language' => 'fr_LU','english_name' => 'French (Luxembourg)','native_name' => 'Français du Luxembourg','iso' => array('fr'));
unset($hreflanguages['de_CH_informal']);
unset($hreflanguages['de_DE_formal']);
$hreflanguages['de_DE'] = array('english_name' => 'German (Germany)');
$hreflanguages['no_NO'] = array('language' => 'no_NO','english_name' => 'Norwegian','iso' => array('no'));
$hreflanguages['pt'] = array('language' => 'pt','english_name' => 'Portuguese','native_name' => 'Português','iso' => array('pt'));
$hreflanguages['zh_Hans'] = array('language' => 'zh_Hans','english_name' => 'Chinese (Simplified)','native_name' => '中文','iso' => array('zh'));
$hreflanguages['zh_Hant'] = array('language' => 'zh_Hant','english_name' => 'Chinese (Traditional)','native_name' => '中文','iso' => array('zh'));
$hreflanguages['ru_RU'] = array('english_name' => 'Russian (Russia)');
$hreflanguages['ru'] = array('language' => 'ru','english_name' => 'Russian','native_name' => 'Русский','iso' => array('ru'));
$hreflanguages['nl'] = array('language' => 'nl','english_name' => 'Dutch','native_name' => 'Nederlands','iso' => array('nl'));
$hreflanguages['cs'] = array('language' => 'cs','english_name' => 'Czech','native_name' => 'Czech','iso' => array('cs'));
$hreflanguages['sv'] = array('language' => 'sv','english_name' => 'Swedish','native_name' => 'Svenska','iso' => array('sv'));
$hreflanguages['sv_SE'] = array('language' => 'sv_SE','english_name' => 'Swedish (Sweden) ','native_name' => 'Svenska (Sverige)','iso' => array('sv'));
$hreflanguages = hreflang_array_sort($hreflanguages,'english_name');

global $hreflanguages;
