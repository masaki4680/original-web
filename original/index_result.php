<?php
require_once("function.php");

//E_NOTICEエラー以外出力する
error_reporting(E_ALL ^ E_NOTICE);

const IMAGE = 'http://capture.heartrails.com/200x200/cool/shorten?';

?>


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

<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-header">


<!-- ブランド名 ロゴ名の表示 -->
<a class="navbar-brand" href="./index.php"><span class="glyphicon glyphicon-home"></span> HOME</a>

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
<li><a href=""><span class="glyphicon glyphicon-briefcase"></span> 企業概要</a></li>
<li><a href=""><span class="glyphicon glyphicon-envelope"></span> お問い合わせ</a></li>
</ul>
</div><!--nav-content -->
</nav>


<!-- main-content -->
<div class="container main-content">
<div class="row">


<?php

//選択がニュースの時
if($_GET['select'] == 'ニュース'){
	//１０個のループ
	for($i=0; $i<10; $i++){
		//リンク先とタイトルを引っ張る
		$json_d = json($_GET['select'],$_GET['search']);

		//リンク先とタイトルを引っ張る
		$get_url = $json_d["items"][$i]["link"];
		$get_title = $json_d["items"][$i]["title"];


		//画像リンクのapi
		$url = IMAGE.$get_url;

		//metaタグ調査&metaタグのキーワード抽出
		$meta = meta($get_url);

		//メタタグのキーワードの欄にニュースがあるか
		if(strpos($meta['0'],"ニュース")!== false){
?>
<table class="table table-striped table-bordered">
<tr>
<?php
echo "<th>"."<a href=\"".$get_url."\">". $get_title."</a>"."</th><th><a href='".$get_url."'><img src='".$url."' alt='".$get_url."' width='200' /></a>"."<br></th>";
?>
</tr>
</table>
<?php
		}
	}
}else if($_GET['select'] == '2chまとめ'){//カテゴリーが2chまとめを選択された時
     for($i=0; $i<10; $i++){
     	//リンク先とタイトルを引っ張る
     	$json_d = json($_GET['select'],$_GET['search']);

     	//リンク先とタイトルを引っ張る
     	$get_url = $json_d["items"][$i]["link"];
     	$get_title = $json_d["items"][$i]["title"];

     	//画像リンクのapi
     	$url = IMAGE.$get_url;

     	if(match($get_url)){
     		?><table class="table table-striped table-bordered">
     				<tr>
     	          <?php
     				echo "<th>"."<a href=\"".$get_url."\">". $get_title."</a>"."</th><th><a href='".$get_url."'><img src='".$url."' alt='".$get_url."' width='200' /></a>"."<br></th>";
     	           ?>
     				</tr>
              </table>
     				<?php
     			}
     }

}else if($_GET['select'] == 'ブログ'){//カテゴリーがブログの時の処理

	for($i=0; $i<10; $i++){

	//リンク先とタイトルを引っ張る
	$json_d = json($_GET['select'],$_GET['search']);

	//画像リンクのapi
	$url = IMAGE.$json_d['0'];

	//metaタグ調査&metaタグ抽出
	$meta = meta($json_d['0']);

	//2chまとめは媒体がブログなのでの可能性を外す
	if(!match($json_d['0'])){

		//点数をつける
		$i=0;

		if(strpos($meta['1'],"width=device-width")!== false){
			$i += 1;
		}
		if(strpos($meta['2'],'ブログ')!== false){
			$i += 1;
		}
		if(strpos($meta['0'],'ブログ')!== false){
			$i += 1;
		}
		if(strpos($meta['3'],'summary')!== false){
			$i += 1;
		}
		if(isset($tags['google-site-verification'])){
			$i += 1;
		}

		//点数が0のものは除外する
        if($i>0){
        	//点数に応じて格納
        	$data[$i][] = $json_d['0'];

        }
	}

  }

  ?>
  <table class="table table-striped table-bordered">
  <tr>
  <?php
  //降順に表示
  rsort($data);

  foreach($data as $key){
  	foreach($key as $link){
  		echo "<th>"."<a href=\"".$link."\">". $json_d['1']."</a>"."</th><th><a href='".$link."'><img src='".$url."' alt='".$link."' width='200' /></a>"."<br></th>";
  	}

  }
  ?>
  </tr>
  </table>
  <?php
}
?>


</div><!-- row -->
</div><!-- main-content -->

<!-- フッター -->
<footer class="container-fluid">
<small><a href="/">Copyright (c) 2016 squize All Rights Reserved.</a></small>
</footer>


</body>
</html>


