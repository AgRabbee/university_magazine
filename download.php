<?php include_once('template/header.php');?>
<?php include_once('session_checker.php');?>
<?php include_once('connect_db.php');?>
<?php $connect = database_connection();?>


<?php if(isset($_SESSION['userName'])){ 


//articles download in zip
$error = ""; //error holder
if(isset($_POST['ar_download'])){
	$post = $_POST; 
	$file_folder = "articles/"; // folder to load files
	if(extension_loaded('zip')){ 

		// Checking ZIP extension is available

		// Checking files are selected
		$zip = new ZipArchive(); // Load zip library 
		$zip_name = time().".zip"; // Zip name
		if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE)
		{ 
		 // Opening zip file to load files
		$error .= "* Sorry ZIP creation failed at this time";
		}
		
		$sql = "SELECT * FROM `articles` WHERE `status` = '1'";
		$files = $connect->query($sql); 
		foreach($files as $file)
		{ 
		$zip->addFile($file_folder.$file['articles']); // Adding files into zip
		}
		$zip->close();
		if(file_exists($zip_name))
		{
		// push to download the zip
		header('Content-type: application/zip');
		header('Content-Disposition: attachment; filename="'.$zip_name.'"');
		readfile($zip_name);
		// remove zip file is exists in temp path
		unlink($zip_name);
		}
	 
	}else{
		$error .= "* You dont have ZIP extension";
	}
}

//photograph download in zip


if(isset($_POST['ph_download'])){
	$post = $_POST; 
	$file_folder = "photographs/"; // folder to load files
	if(extension_loaded('zip')){ 

		// Checking ZIP extension is available

		// Checking files are selected
		$zip = new ZipArchive(); // Load zip library 
		$zip_name = time().".zip"; // Zip name
		if($zip->open($zip_name, ZIPARCHIVE::CREATE)!==TRUE)
		{ 
		 // Opening zip file to load files
		$error .= "* Sorry ZIP creation failed at this time";
		}
		
		$sql = "SELECT * FROM `photographs` WHERE `status` = '1'";
		$files = $connect->query($sql); 
		foreach($files as $file)
		{ 
		$zip->addFile($file_folder.$file['photograph']); // Adding files into zip
		}
		$zip->close();
		if(file_exists($zip_name))
		{
		// push to download the zip
		header('Content-type: application/zip');
		header('Content-Disposition: attachment; filename="'.$zip_name.'"');
		readfile($zip_name);
		// remove zip file is exists in temp path
		unlink($zip_name);
		}
	 
	}else{
		$error .= "* You dont have ZIP extension";
	}
}




}?>