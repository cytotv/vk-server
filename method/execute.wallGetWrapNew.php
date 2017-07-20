<?php
include "../db.php";
$owner_id = $_POST["owner_id"];
$access_token = $_POST["access_token"];
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$owner_id'"));
$auser = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE token='$access_token'"));
if(!empty($user["id"])){
	$posts_count = 0;
	if($user["id"]==$auser["id"]){
		$c = 1;
	}
	else{
		$c = 0;
	}
	$posts = mysql_query("SELECT * FROM users_posts WHERE owner_id='$owner_id' ORDER BY time DESC");
	while($row = mysql_fetch_array($posts)){
		$posts_count = $posts_count + 1;
		$posts_str = $posts_str.'{"id":'.$row["post_id"].',"from_id":'.$row["from_id"].',"owner_id":'.$row["owner_id"].',"date":'.$row["time"].',"post_type":"post","text":"'.$row["message"].'","can_edit":'.$c.',"can_delete":'.$c.',"can_pin":'.$c.',"post_source":{"type":"api","platform":"android"},"comments":{"count":0,"can_post":1},"likes":{"count":0,"user_likes":0,"can_like":1,"can_publish":0},"reposts":{"count":0,"user_reposted":0}},';
	}
	$posts_str = substr($posts_str,0,-1);
	echo '{"response":{"count":'.$posts_count.',"profiles":[{"id":'.$user["id"].',"first_name":"'.$user["name"].'","last_name":"'.$user["lastname"].'","sex":'.$user["sex"].',"photo_50":"https:\/\/pp.vk.me\/c638428\/v638428786\/1a50b\/UggBIoR6040.jpg","photo_100":"https:\/\/pp.vk.me\/c638428\/v638428786\/1a50a\/3Iv7wkEW74k.jpg","first_name_dat":"Степану","last_name_dat":"Новожилову"}],"groups":[],"postponed_count":0,"items":['.$posts_str.']}}';
}else{
	echo '{"response":{"count":0,"profiles":[],"groups":[],"postponed_count":0,"items":[]}}';
}
?>