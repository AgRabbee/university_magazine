<?php
function database_connection($setup=false){
	$host='ec2-34-198-103-34.compute-1.amazonaws.com';
	$user='ofcfdskyxeqsvd';
	$password='1aca6300b395f99b613112cf0d0fcb308976864ae2f29035d70cfcb973fe0edc';
	$database='dc6tfu4nropum9';
	$port = '5432';
	
	if($setup == true){
		$connection = new mysqli($host,$user,$password,$port);
	}else{
		$connection = new mysqli($host,$user,$password,$database,$port);
	}

	if($connection->connect_error){
		die("Connection Failed!!".$connection->connect_error);
	}
	return $connection;
}













?>