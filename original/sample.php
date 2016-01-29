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

// $tags = get_meta_tags('http://blog.livedoor.jp/itsoku/');

// var_dump($tags);

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
$url = "http://ameblo.jp/darvish-yu-blog/";
$html = file_get_contents($url);
$html = preg_replace('!<script.*?>.*?</script.*?>!is', '', $html);
$html = preg_replace('!<style.*?>.*?</style.*?>!is', '', $html);
$tags = strip_tags($html);

var_dump($tags);

// if (mb_substr_count($tags, $string)>=1) {
// 	//年月日のフォーマット検索
// 	if(preg_match('/(19|20)[0-9]{2}\/[0-9]{1,2}\/[0-9]{1,2}\((月|火|水|木|金|土|日)\)\s(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9].[0-5][0-9]\sID:/', $tags)){
// 		    echo "成功";
// 	}else{
//           	echo "無理";
//           }
// 	}else {
//            echo "無理1";
// 	}



//解析
$htmla = file_get_contents('http://ameblo.jp/darvish-yu-blog/');
$domDocument = new DOMDocument();
libxml_use_internal_errors(true);
$domDocument->loadHTML($htmla);
$xmlString = $domDocument->saveXML();
//xml文書をパースしてオブジェクト化する関数
$xmlObject = simplexml_load_string($xmlString);

print_r($xmlObject);

foreach($xmlObject->head as $value){
	$result[] = array('comment' => (string)$value->comment, 'meta' => (string)$value->meta);
}

echo json_encode($result);


//例2
$array = json_decode(json_encode($xmlObject), true);

var_dump($array);

echo $array['head']['comment'];







?>
