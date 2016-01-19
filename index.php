<?php

error_reporting(E_ALL ^ E_NOTICE);


$err = array();
$arrs = array('blog','2chまとめ','記事','はてなblog');

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
// 	session_start();

// 	$_SESSION['search'] = $_POST['search'];
// 	$_SESSION['select'] = $_POST['select'];

	header("Location:./index_result.php?search=".$_POST['search']."&select=".$_POST['select']);

}

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<!-- bootstap manual-->
<link href="css/bootstrap.min.css" rel="stylesheet">

<!-- bootstap select-->
<link rel="stylesheet" href="css/bootstrap-select.css">


<meta charset="UTF-8">
</head>
<body>
<div class="container">
<div class="row">
<div class="col-md-3">
 </div><!--/col-md-3 -->

 <div class="col-md-6">


<div class="text-center text-info">
<h2>squeeze</h2>
</div>




<!-- Google  -->
<form  method="post" class="form-inline">

<div class="form-group">
<select class="form-control selectpicker" name="select">
<option value="">条件絞り込み</option>
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
<input type=submit name=btnG value=Google検索 class="btn btn-primary">
</div>

<div class="form-group">
<span class="text-danger"><?= $err['search'];?></span>
<br>
<span class="text-danger"><?= $err['select'];?></span>
</div>
</form>

<!-- Google -->
 </div><!--/col-md-6 -->

 <div class="col-md-3">
 </div><!--/col-md-3 -->

</div><!--/row -->
</div><!--/container -->

<!-- script一覧 -->
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.js"></script>
<script type="text/javascript">
        $(window).on('load', function () {
            $('.selectpicker').selectpicker({
                'selectedText': 'cat'
            });
        });
</script>

</body>
</html>


