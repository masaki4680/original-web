<!DOCTYPE html>
<html lang="ja">
<head>
<!-- bootstap manual-->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- script一覧 -->
<script src="//code.jquery.com/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<meta charset="UTF-8">
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
//タイトル、URL、記事上段取得
for($i=0; $i<10; $i++){
	$get_title = $json_d["items"][$i]["title"];
	$get_url = $json_d["items"][$i]["link"];
	$get_snippet = $json_d["items"][$i]["snippet"];
	?>
	・<a href="<?= "$get_url";?>"><?= "$get_title"."<br>"?></a>
	<?php
	echo "$get_snippet"."<br><br>";
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


