<?php
include "../db.php";
$user_id = $_POST["user_id"];
$access_token = $_POST["access_token"];
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$user_id'"));
$auser = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE token='$access_token'"));
if($auser["id"]==$user["id"]){
	$can_post=1;
}
else{
	$can_post=0;
}
echo '{"response":{"id":'.$user["id"].',"first_name":"'.$user["name"].'","last_name":"'.$user["lastname"].'","sex":'.$user["sex"].',"screen_name":"id'.$user["id"].'","bdate":"28.2","city":{"id":0,"title":"Подальше от Воронина"},"country":{"id":1,"title":"Россия"},"photo_rec":"https://multi-gaming.ru/photos/50/'.$user["id"].'_1.jpg","photo_medium_rec":"https://multi-gaming.ru/photos/100/'.$user["id"].'_1.jpg","photo_max":"https://multi-gaming.ru/photos/200/'.$user["id"].'_1.jpg","has_photo":1,"can_call":0,"online":1,"online_app":"3140623","online_mobile":1,"wall_default":"all","can_post":'.$can_post.',"can_see_all_posts":1,"can_write_private_message":1,"can_send_friend_request":1,"activity":"'.$user["status"].'","last_seen":{"time":1487596816,"platform":2},"verified":'.$user["verified"].',"first_name_dat":"","first_name_gen":"","first_name_ins":"","first_name_acc":"","last_name_dat":"","last_name_gen":"","last_name_ins":"","last_name_acc":"","blacklisted":0,"blacklisted_by_me":0,"is_favorite":0,"is_hidden_from_feed":0,"counters":{"albums":0,"videos":0,"audios":0,"notes":0,"photos":0,"groups":0,"gifts":0,"friends":0,"online_friends":0,"mutual_friends":0,"user_photos":0,"followers":0,"subscriptions":0,"pages":0},"is_subscribed":0,"career":[],"home_town":"Рыбинск","relation":6,"personal":{"langs":["Русский","English"]},"interests":"","music":"","activities":"","movies":"","tv":"","books":"","games":"","universities":[],"schools":[],"about":"","relatives":[],"quotes":"","photos":{"count":0,"items":[]},"friend_status":0,"status":{"text":"'.base64_decode($user["status"]).'"},"gifts":{"count":0,"items":[]},"cities":[],"countries":[{"id":1,"title":"Россия"}],"audios":[],"docs":[],"videos":[],"subscriptions":[],"groups":[],"friends":[],"mutual_friends":[],"display_fields":["friends","followers","city","work","education"],"all_photos_are_hidden":true}}';
?>