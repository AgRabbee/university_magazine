<?php
function database_connection($setup=false){
	$host='localhost';
	$user='root';
	$password='';
	$database='ewsd-group-03';
	
	if($setup == true){
		$connection = new mysqli($host,$user,$password);
	}else{
		$connection = new mysqli($host,$user,$password,$database);
	}

	if($connection->connect_error){
		die("Connection Failed!!".$connection->connect_error);
	}
	return $connection;
}













?>