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
//E_NOTICEエラー以外出力する
error_reporting(E_ALL ^ E_NOTICE);

//タイトル、URL、記事上段取得

?>
<table class="table table-striped table-bordered">
<?php

for($i=0; $i<10; $i++){
	$get_url = $json_d["items"][$i]["link"];
	$get_title = $json_d["items"][$i]["title"];
	?>


	<?php

	//画像api
	$url ="http://capture.heartrails.com/200x200/cool/shorten?".$get_url;

	//選択がニュースかつmetaタグのdescriptionにニュースがあるかの条件分岐
	if($_GET['select'] == 'ニュース'){

		//metaタグ調査
		$tags = get_meta_tags($get_url);

		if(strpos($tags['keywords'],"ニュース")){

?>
<tr>
<?php
echo "<th>"."<a href=\"".$get_url."\">". $get_title."</a>"."</th><th><a href='".$get_url."'><img src='".$url."' alt='".$get_url."' width='200' /></a>"."<br></th>";
?>
</tr>
<?php
		}


	}elseif($_GET['select'] == '2chまとめ'){//カテゴリーが2chまとめの時の処理

		if(match($get_url)){
			?>
			<tr>
          <?php
			echo "<th>"."<a href=\"".$get_url."\">". $get_title."</a>"."</th><th><a href='".$get_url."'><img src='".$url."' alt='".$get_url."' width='200' /></a>"."<br></th>";
           ?>
			</tr>

			<?php
		}

	}elseif($_GET['select'] == 'ブログ'){//ブログの時の処理

		//metaタグ調査
		$tags = get_meta_tags($get_url);

		//ニュースでない可能性と2chまとめの可能性を外す
		if(!strpos($tags['keywords'],"ニュース") && !match($get_url)){

			//アーカイブがあるか調べる
			if(archive($get_url)){
				?>
				<tr>
				<?php
				echo "<th>"."<a href=\"".$get_url."\">". $get_title."</a>"."</th><th><a href='".$get_url."'><img src='".$url."' alt='".$get_url."' width='200' /></a>"."<br></th>";
				?>
				</tr>
				<?php
			}

		}

	}
}
?>
</table>

</div><!-- row -->
</div><!-- main-content -->

<!-- フッター -->
<footer class="container-fluid">
<small><a href="/">Copyright (c) 2016 squize All Rights Reserved.</a></small>
</footer>


</body>
</html>


