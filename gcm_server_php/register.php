<?php

// response json
$json = array();

/**
 * Registering a user device
 * Store reg id in users table
 */
if (isset($_POST["numprofesor"]) && isset($_POST["dni"]) && isset($_POST["regid"])&& isset($_POST["alta"])) {
   $numprofesor = $_POST["numprofesor"];
    $dni = $_POST["dni"];
    $regid = $_POST["regid"]; // GCM Registration ID
	$alta=$_POST["alta"];
    // Store user details in db
    include_once './db_functions.php';
    include_once './GCM.php';
	$db = new DB_Functions();
    $gcm = new GCM();
	if($alta=="baja") 
	{	
	$res = $db->downUser($dni);
echo $res;

	}else{
    
	
   // $resin = $db->storeUser($numprofesor, $dni, $regid);
    $resup = $db->updateUser($numprofesor, $dni, $regid);
	
   echo $resup;
	

	}


} 
?>