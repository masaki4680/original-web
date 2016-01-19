<?php

error_reporting(E_ALL ^ E_NOTICE);


$err = array();
$arrs = array('blog','2chまとめ','記事','はてなblog');

//初回入力
if($_SERVER['REQUEST_METHOD'] != 'POST'){

}else{

//検索条件を選択されてない時の処理
if(!$_POST['select']){
	$err['select'] = "検索対象の媒体を選択してください";
}

//入力欄に何も入ってない時
if(!$_POST['search']){
	$err['search']= "何も入力されていません";
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
<meta charset="UTF-8">
</head>
<body>
<h2>スクイズ</h2>
<br>
<!-- Google  -->

<form  method="post">
<select name="select">
<option value="">条件絞り込み</option>
<?php foreach($arrs as $arr){
?>
<option value="<?= $arr;?>" <?php if($_POST['select'] == $arr){echo "selected";} ?>><?= $arr;?></option>
 <?php
}?>
</select>
<input type=text name=search size=31 maxlength=255 placeholder=検索します value="<?= $_POST['search'];?>">
<input type=submit name=btnG value=Google検索><br>
<span style="color:red;"><?= $err['search'];?></span><br>
<span style="color:red;"><?= $err['select'];?></span>
</form>

<!-- Google -->
</body>
</html>


