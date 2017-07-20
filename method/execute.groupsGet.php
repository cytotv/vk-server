<?php
include "../db.php";
$gg = "";
$groups = mysql_query("SELECT * FROM groups");
while($row = mysql_fetch_array($groups)){
	$gg = $gg.'{"id":'.$row["id"].',"name":"'.$row["name"].'","screen_name":"mgsl_official","is_closed":0,"type":"group","is_admin":1,"admin_level":3,"is_member":1,"members_count":364,"verified":1,"activity":"Открытая группа","photo_50":"https:\/\/pp.vk.me\/c626530\/v626530751\/4b049\/2DcwXdizYRs.jpg","photo_100":"https:\/\/pp.vk.me\/c626530\/v626530751\/4b048\/e_zkPokph9Y.jpg","photo_200":"https:\/\/pp.vk.me\/c626530\/v626530751\/4b046\/iHnEMitmh_c.jpg"},';
}
$gg = substr($gg,0,-1);
echo '{"response":{"count":1,"items":['.$gg.']}}';
?>