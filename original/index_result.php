<!DOCTYPE html>
<html lang="ja">
<head>
<!-- bootstap manual-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- script一覧 -->
<script src="//code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- HTML5形式の文字コード指定には対応していません meta charset="utf-8" -->
<meta http-equiv="content-Type" content="text/html; charset=utf-8">

<style>
footer {
 text-align: center;
 background: #101010;
 margin-top:10%;
 padding-top: 3%;
}

.main-content{
margin-top: 100px;
}

</style>
</head>
<body>
<?php
require_once("function.php");


//以下１０件文のURLを取得する
$json_d = json($_GET['select'],$_GET['search']);

?>
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-header">


<!-- ブランド名 ロゴ名の表示 -->
<a class="navbar-brand" href="./index.php">HOME</a>

<!-- トグルボタンの設置 -->
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#nav-content">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</div><!--navbar-header -->

<div id="nav-content" class="collapse navbar-collapse">

<!-- リンクリスト メニューリスト -->
<ul class="nav navbar-nav">
<li><a href="">企業概要</a></li>
<li><a href="">お問い合わせ</a></li>
</ul>
</div><!--nav-content -->
</nav>


<!-- main-content -->
<div class="container main-content">
<div class="row">
<?php
//一つ目のURLだけ取り出す
$get_url = $json_d["items"][0]["link"];


var_dump($get_url);


//HTMLを読み込む
$dom = new DOMDocument();

//HTMLファイルを読み込む @=htmlに誤りがあってもエラー表示しない
//マルチバイト文字すべてをHTMLエンティティ形式に変換する
@$dom->loadHTMLFile(mb_convert_encoding($get_url,'HTML-ENTITIES','UTF-8'));

mb_language('Japanese');
//タグの検索
$xpath = new DOMXPath($dom);

var_dump($xpath);
//title 一番目 itemは最初の要素を指定 nodeValueはノードから値を取り出す
$title = $xpath->query('//head/meta[1]')->item(0)->nodeValue;
var_dump($title);

// id="content" *=すべての要素を対象div[@id]としてもいい
// $content = $xpath->query('//div[@id="content"]')->item(0);

// echo $content->nodeValue ."\n";

//
//取り出す方法・条件選択して
// $result = $xpath->query('//sample[[text()="green" or text()="red"]]');
// foreach($result as $node){
// 	echo $node->nodeValue ."<br />";
// }


//スクレイピングしたいhtmlを読み込む＋エラー処理
// libxml_use_internal_errors(true);
// $html = $dom->loadHTML( '$get_url' );
// libxml_clear_errors();



// var_dump($html);


//タイトル、URL、記事上段取得
// for($i=0; $i<10; $i++){
// 	$get_title = $json_d["items"][$i]["title"];
// 	$get_url = $json_d["items"][$i]["link"];
// 	$get_snippet = $json_d["items"][$i]["snippet"];
// 	?>

	<?php
// 	echo "$get_snippet"."<br><br>";
// }
?>
</div><!-- row -->
</div><!-- main-content -->

<!-- フッター -->
<footer class="container-fluid">
<small><a href="/">Copyright (c) 2016 squize All Rights Reserved.</a></small>
</footer>


</body>
</html>


