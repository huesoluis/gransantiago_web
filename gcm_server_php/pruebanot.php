<?php

    include_once './db_functions.php';
    include_once './GCM.php';

    $db = new DB_Functions();
    $gcm = new GCM();
	

		$gcm_regid = $db->getUserByRegId(51);
	    $registatoin_ids = array($gcm_regid);

    $message = array("Cubres" => "profesor1","Aula" => "Aula1");

   $result = $gcm->send_notification($registatoin_ids, $message);

   echo print_r($result);
	// Escribe el contenido al fichero

?>