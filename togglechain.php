<?php
//***********************************************************************************************************************
// V1.0 : Script qui permet la bascule successive entre les valeurs d'un p�riph�rique : influman
//
//*************************************** API eedomus ******************************************************************

// recuperation des infos depuis la requete

$periphId = getArg("periph", true);
$valeurs  = getArg("valeurs", false, "0,100");

$tabvaleurs   = explode(",", $valeurs); //$tabvaleurs[0] = 0, $tabvaleurs[1] = 50, $tabvaleurs[2] = 100,
$firstValue   = $tabvaleurs[0];
$pickNext     = false;
$periphvalue  = getValue($periphId);
$currentValue = $periphvalue["value"];

// on parcourt les valeurs possibles
foreach ($tabvaleurs as $possibleValue) {
    if ($pickNext) {                            // on a dit que la prochaine valeur était la bonne
        setValue($periphId, $possibleValue);
        die;                                    // on a trouvé la valeur, c'est fini.
    }

    if ($currentValue == $possibleValue) {       // on test si on est sur la valeur courante
        $pickNext = true;                       // on va prendre la prochaine de la liste
    }
}

// on a pas réussi à attribuer la suivante
// on était en fin de liste (ou sur un état imprévu)
// donc on repart sur le premier de la liste
setValue($periphId, $firstValue);
