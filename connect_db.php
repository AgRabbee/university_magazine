<?php
function database_connection($setup=false){
	$host='ec2-54-144-177-189.compute-1.amazonaws.com';
	$user='dcodtoohxorubg';
	$password='87fc80a49bb0df19bf4f2d425d8573d8f2b2171a33f41127af85b23bb4d13a54';
	$database='d5e210eje2u12n';
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