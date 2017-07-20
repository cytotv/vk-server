<?php
include "db.php";
include "config.php";
$login = $_GET["username"];
$password = $_GET["password"];
$profile = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE login='$login'"));
if(!empty($profile["id"])){
	if(md5($password)==$profile["password"]){
		$token = md5($login.$pass.time());
		$user_id = $profile["id"];
		mysql_query("UPDATE users SET token='$token' WHERE login='$login'");
		echo '{"access_token":"'.$token.'","expires_in":0,"user_id":'.$user_id.',"secret":"1f7b11982ad9145edf"}';
	}
	else{
		echo '{"error":"invalid_client","error_description":"[VK-Private] Неверный пароль. Попробуй еще раз"}';
	}
}
else{
	echo '{"error":"invalid_client","error_description":"[VK-Private] Ты еще не зарегистрировался."}';
}
?>