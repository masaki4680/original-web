<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
</head>
<body>
<?php
//以下１０件文のURLを取得する

//初期設定

$api_key = "AIzaSyAYaVanZIKhqPSzWJep48RYPIoPUAsJ3Rk";
$cx = "007435580868526519789:mkzbsdb8plw";

//はてなblogが選択された時の処理
// if($_GET['select']=='はてなblog'){
// 	$search_query = $_GET['search']." site:hatenablog.com OR site:hatenablog.jp OR site:hateblo.jp OR site:hatenadiary.com OR site:hatenadiary.jp"
// 	;}
$search_query = $_GET['search'];

var_dump($search_query);

//検索用URL*SSLを使用
$search_url = "https://www.googleapis.com/customsearch/v1?";

//検索パラメーター発行
//key.apikey,cx.検索エンジンID,q.検索ワード,alt.結果を取得する形式を指定
$params_list = array('key'=>$api_key,'cx'=>$cx,'q'=>$search_query,'alt'=>'json','start'=>'1');

//リクエストパラメータ作成
$req_param = http_build_query($params_list);

//リクエスト本体作成
$request = $search_url.$req_param;

var_dump($request);
//jsonデータを取得
$json = file_get_contents($request,true);
$json_d = json_decode($json,true);

//１番目に表示されるサイトの情報を取得
$result_first = $json_d->items[0];

var_dump($json_d);

//url取得
// for($i=0; $i<10; $i++){
// 	$get_url = $json_d["items"][$i]["link"];
// 	echo "$get_url\n";
// }



?>

</body>
</html>


