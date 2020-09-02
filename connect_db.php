<?php
function database_connection($setup=false){
	$host='ec2-3-81-240-17.compute-1.amazonaws.com';
	$user='anodynuytkbili';
	$password='27b822e5f66dc85cb5af0334f92386433f7e005b091dcd4e160255ca8365aae6';
	$database='de8etmmpigihbv';
	$port='5432';
	
	if($setup == true){
		$connection = new mysqli($host,$user,$password,$port);
	}else{
		$connection = new mysqli($host,$user,$password,$database,$port);
	}

	if($connection->connect_error){
		die("Connection Failed!!".$connection->connect_error);
	}
	if($connection){
	    echo "successfull";
    }
//	return $connection;
}













?>