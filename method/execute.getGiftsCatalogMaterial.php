<?php
include '../db.php';
include '../config.php';
$access_token = $_POST["access_token"];
$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE token='$access_token'"));
if(!empty($user["id"])){
	$gg = mysql_query("SELECT * FROM gifts");
	while($row = mysql_fetch_array($gg)){
	$gifts = $gifts.'{"gift": {"id": '.$row["id"].',"thumb_256": "'.$row["x256"].'","thumb_96": "'.$row["x96"].'","thumb_48": "'.$row["x48"].'"},"payment_type": "'.$row["payment"].'","price": '.$row["price"].',"price_str": "'.$row["name"].'"},';
	}
	$gifts = substr($gifts,0,-1);
	echo '{"response":{"balance":'.$user["balance"].',"gifts":[{"name":"birthday","title":"'.$config["server_name"].'","items":['.$gifts.']}]}}';
}
?>