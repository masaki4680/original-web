<?php

error_reporting(E_ALL ^ E_NOTICE);


$err = array();
$arrs = array('ブログ','2chまとめ','ニュース','質問、回答');

//初回入力
if($_SERVER['REQUEST_METHOD'] != 'POST'){

}else{

//検索条件を選択されてない時の処理
if(!$_POST['select']){
	$err['select'] = "・検索対象の媒体を選択してください";
}

//入力欄に何も入ってない時
if(!$_POST['search']){
	$err['search']= "・検索ワードを入力して下さい";
}

if(empty($err)){


	header("Location:./index_result.php?search=".$_POST['search']."&select=".$_POST['select']);

}

}


?>
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

@font-face {
  font-family: ero;
  src: url(fonts/RaconteurNF.ttf);
}


h1{
  font-family: ero;

}

p{
  font-family: 'HG行書体',monospace;
}

footer {
 text-align: center;
 background: #101010;
 margin-top:10%;
 padding-top: 3%;
}
header {
 background: url("img/original.jpg");
 background-position: center center;
 background-size: cover;
}
header .container{
  margin-top: 5%;
  margin-bottom: 2%
}
.excription{
margin-top: 5%;
}

</style>

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
<div class="navbar-header">

<!-- ブランド名 ロゴ名の表示 -->
<a class="navbar-brand" href="./index.php"><span class="glyphicon glyphicon-home"></span> squeeze</a>

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

<!-- ヘッダー -->
<header class="jumbotron">
<div class="container">
<div class="text-center text-info">
<h1>squeeze</h1>
</div><!-- text-center text-info -->

<div class="excription text-center text-info">
<p>あらかじめ検索対象の媒体を選択して検索することができます</p>
<p>大量な情報の中から、あなたが求める情報を素早く見つけます</p>

</div><!-- excription -->

</div><!-- container -->
</header><!-- jumbotron-->

<div class="container main-content text-center">
<div class="row">

<!-- <div class="input-group-btn" id="select_place"><button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown"><small><span class="glyphicon glyphicon-chevron-down"></span></small></button><ul class="dropdown-menu" role="menu"><li><a href="#" value=""><span class="glyphicon glyphicon-ok"></span>まとめて</a></li><li><a href="#" value="2chnet"><span class="glyphicon glyphicon-ok"></span>2ちゃんねる (net)</a></li><li><a href="#" value="open2chnet"><span class="glyphicon glyphicon-ok"></span>おーぷん2ちゃんねる</a></li><li><a href="#" value="shitaraba"><span class="glyphicon glyphicon-ok"></span>したらば掲示板</a></li><li><a href="#" value="vip2chcom"><span class="glyphicon glyphicon-ok"></span>VIPサービス</a></li><li><a href="#" value="next2chnet"><span class="glyphicon glyphicon-ok"></span>Next2ch</a></li><li><a href="#" value="machito"><span class="glyphicon glyphicon-ok"></span>まちBBS</a></li><li><a href="#" value="jikkyoorg"><span class="glyphicon glyphicon-ok"></span>jikkyo.org</a></li></ul></div> -->
<!-- Google  -->
<form  method="post" class="form-inline">

<div class="form-group">
<select class="form-control" name="select">
<option value="">select...</option>
<?php foreach($arrs as $arr){
?>
<option value="<?= $arr;?>" <?php if($_POST['select'] == $arr){echo "selected";} ?>><?= $arr;?></option>
 <?php
}?>
</select>
</div><!--/form-group -->

<div class="form-group">
<input class="form-control" type=text name=search size=31 maxlength=255 placeholder=検索します value="<?= $_POST['search'];?>">
</div><!--/form-group -->

<div class="form-group">
<button type="submit" class="btn btn-primary">
  <span class="glyphicon glyphicon-search"></span> 検索
</button>
</div>
<br>

<div class="form-group text-left">
<span class="text-danger"><?= $err['search'];?></span>
<br>
<span class="text-danger"><?= $err['select'];?></span>
</div>
</form>

<!-- Google -->

</div><!--/row -->
</div><!--/container main-content-->

<!-- フッター -->
<footer class="container-fluid">
<small><a href="/">Copyright (c) 2016 squize All Rights Reserved.</a></small>
</footer>

</body>
</html>


