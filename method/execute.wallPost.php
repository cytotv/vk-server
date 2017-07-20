<?php
date_default_timezone_set("Europe/Moscow");
include "../db.php";
$owner_id = $_POST["owner_id"];
$access_token = $_POST['access_token'];
$message = $_POST["message"];
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE token='$access_token'"));
if(!empty($user["id"])){
	$owner = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$owner_id'"));
	$from_id = $user["id"];
	if(!empty($owner["id"])){
		$post_id = $owner["posts_num"]+1;
		$time = time() + (60 * 60);
		mysql_query("UPDATE users SET posts_num='$post_id' WHERE id='$owner_id'");
		mysql_query("INSERT INTO users_posts (owner_id,post_id,from_id,message,time) VALUES ('$owner_id','$post_id','$from_id','$message','$time')");
		echo '{"response":[{"id":'.$post_id.',"from_id":'.$from_id.',"owner_id":'.$owner_id.',"date":'.$time.',"post_type":"post","text":"'.$message.'","can_edit":0,"can_delete":0,"can_pin":0,"post_source":{"type":"api","platform":"android"},"comments":{"count":0,"can_post":1},"likes":{"count":0,"user_likes":0,"can_like":1,"can_publish":0},"reposts":{"count":0,"user_reposted":0}}]}';
	}else{
		echo $owner_id;
	}
}
else{
	
}
?>