<?php

function json($select,$search){
	$api_key = "AIzaSyB3c7TTiLltdK_kSxhP4gSL-dunYDVWSAQ";
	$cx = "007435580868526519789:mkzbsdb8plw";

	//ブログが選択された時の処理
// 	if($select=='ブログ'){
// 		$search_query = $search." site:hatenablog.com OR site:hatenablog.jp OR site:hateblo.jp OR site:hatenadiary.com OR site:hatenadiary.jp"." OR site:ameblo.jp"." OR site:livedoor.jp"." OR site:fc2.com"." OR site:blogs.yahoo.co.jp"." OR site:blog.seesaa.jp"." OR site:blog.goo.ne.jp"
// 				;}
// 	if($select=='質問、回答'){
// 		$search_query = $search." site:chiebukuro.yahoo.co.jp"." OR site:okwave.jp"
// 	            ;}


				//検索用URL*SSLを使用
				$search_url = "https://www.googleapis.com/customsearch/v1?";

				//検索パラメーター発行
				//key.apikey,cx.検索エンジンID,q.検索ワード,alt.結果を取得する形式を指定
				$params_list = array('key'=>$api_key,'cx'=>$cx,'q'=>$search,'alt'=>'json','start'=>'1');

				//リクエストパラメータ作成
				$req_param = http_build_query($params_list);

				//リクエスト本体作成
				$request = $search_url.$req_param;

				//jsonデータを取得
				$json = file_get_contents($request);
				//JSONデータをエンコード:UTF8に変換
				$json = mb_convert_encoding($json,'UTF8','ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
				//JSONデータを連想配列にします：trueがないと連想配列にならない
				$json_d = json_decode($json,true);

				return $json_d;
}

//ID:と日時のあるフォーマットがあるかを確認
function match($url){
$html = file_get_contents($url);
$html = preg_replace('!<script.*?>.*?</script.*?>!is', '', $html);
$html = preg_replace('!<style.*?>.*?</style.*?>!is', '', $html);
$tags = strip_tags($html);
$string = "ID:";


if (mb_substr_count($tags, $string)>=2) {
	//年月日のフォーマット検索
	if(preg_match('/(19|20)[0-9]{2}\/[0-9]{1,2}\/[0-9]{1,2}\((月|火|水|木|金|土|日)\)\s(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9].[0-5][0-9]\sID:/', $tags)){
		return true;
	}else{
          	return false;
          }
	} else {
		return false;

	}
}
?>