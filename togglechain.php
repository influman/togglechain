<?php
   //***********************************************************************************************************************
   // V1.0 : Script qui permet la bascule successive entre les valeurs d'un périphérique : influman
   // 
   //*************************************** API eedomus ******************************************************************
   
   // recuperation des infos depuis la requete
  
    $periphId=getArg("periph");
    $valeurs = getArg("valeurs");
    
    if ($valeurs == '') {
        $valeurs = "0,100";
    }
    $tabvaleurs = explode(",", $valeurs); //$tabvaleurs[0] = 0, $tabvaleurs[1] = 50, $tabvaleurs[2] = 100,
    $nbvaleurs = count($tabvaleurs); // 3
	$lastindex = $nbvaleurs - 1; // 2
	

    if ($periphId != '' and $periphId != 'plugin.parameters.device_id') {
        $periphvalue = getValue($periphId); 
		for($i = 0; $i < $nbvaleurs; $i++) {
			if ($tabvaleurs[$i] == $periphvalue["value"]) {
				if ($i == $lastindex) {
					$valnext = $tabvaleurs[0];
				} else {
					$valnext = $tabvaleurs[$i + 1];
				}
				setValue($periphId, $valnext, $verify_value_list = false, $update_only = false);
				break;
			}
		}
		
    } 
	die();
?>