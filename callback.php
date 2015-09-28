<?php 

require_once "./DataBaseUtil.class.php";
require_once "./Response.class.php";
	
$connect = DataBaseUtil::getInstance()->connect();


/*
* 首页接口 
* http://domain/hotgirl/callback.php?format=xml/json
*/
$page = isset($_REQUEST['page'])?$_REQUEST['page']:1;
$page_number = isset($_REQUEST['page_number'])?$_REQUEST['page_number']:2;
$lim_start = ($page-1) * $page_number;
$sql = "SELECT * FROM user WHERE is_active=1 LIMIT ".$lim_start.",".$page_number;
$result = mysql_query($sql, $connect);
if($result && mysql_num_rows($result)>0) {
	while ($row = mysql_fetch_assoc($result)) {
		$rows[] = $row;
	}
}
if(!empty($rows)){
	return Response::api_response(200, 'Success', $rows);
}
else{
	return Response::api_response(403, 'No result from database');
}
