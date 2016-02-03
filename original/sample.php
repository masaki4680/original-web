<!DOCTYPE HTML>
<head>
<meta charset="UTF-8">
</head>
<body>
</body>
<?php
//phpQueryをロード
// require_once("phpQuery-onefile.php");

//HTMLデータを取得する,HTML/XMLのcontent-typeを自動判別。判別できないならUTF-8のtext/html読み込む
// $html = file_get_contents("http://paiza.hatenablog.com/",$contentType = null);

//HTMLのDOM解析オブジェクト生成
// $dom = phpQuery::newDocument($html);

//titleタグを取得
// $title = $dom['title'];

// echo $title->text();

// echo "<br>";
error_reporting(E_ALL ^ E_NOTICE);

$tags = get_meta_tags('http://yozawa-tsubasa.info/');
mb_language('japanese'); //言語を設定

$i = 0;

if(strpos($tags['viewport'],"width=device-width")!== false ){
	$i += 1;
}
if(strpos($tags['description'],'ブログ')!== false){
	$i += 1;
}
if(strpos($tags['keywords'],'ブログ')!== false){
	$i += 1;
}
if(strpos($tags['twitter:card'],'summary')!== false){
	$i += 1;
}
if(isset($tags['google-site-verification'])!== false){
	$i += 1;
}

var_dump($i);
$tag = mb_convert_encoding($tags['description'],"UTF-8","auto");
var_dump($tags);
var_dump($tag);

// if(strpos($tags['keywords'],"ニュース")){
// 	echo "失敗";
// }

// var_dump(strpos($tags['keywords'],"ニュース"));

//2chまとめサイト文字のみ表示
// readfile("http://www.yahoo.co.jp");

// if (! preg_match('/^(19|20)[0-9]{2}\/[0-9]{1,2}\/[0-9]{1,2}\z/', $str)) {
// 	// エラー
// } else {
// 	// 日付妥当性
// 	list($year, $month, $day) = explode('/\//', $str);
// 	if (! checkdate($month, $day, $year)) {
// 		// エラー
// 	}
// 	// 範囲
// 	if ($year < 1950 || $year > 2016) {
// 		// エラー
// 	}
// }
/*
$url = "http://yozawa-tsubasa.info/";
$html = file_get_contents($url);
$html = preg_replace('!<script.*?>.*?</script.*?>!is', '', $html);
$html = preg_replace('!<style.*?>.*?</style.*?>!is', '', $html);
$tags = strip_tags($html);

var_dump($tags);
*/

$url = "http://archive.org/wayback/available"."?url="."http://archive.org/wayback/available";


$html = file_get_contents($url);

$json = json_decode($html,false);

$success = $json->archived_snapshots->closest->available;

if($success){
	echo "maru";
}



//解析

$htmla = file_get_contents('http://yozawa-tsubasa.info/');
$domDocument = new DOMDocument();
libxml_use_internal_errors(true);
$domDocument->loadHTML($htmla);
$xmlString = $domDocument->saveXML();
//xml文書をパースしてオブジェクト化する関数
$xmlObject = simplexml_load_string($xmlString);

var_dump($xmlObject);



//例2
$array = json_decode(json_encode($xmlObject), true);

// var_dump($array);











?>
