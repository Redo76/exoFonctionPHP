<?php

$csvDepartement = array_map("str_getcsv", file("departement.csv"));
$departNum = "76";

$csvVilles = array_map("str_getcsv", file("villes_france.csv"));

print(departName($departNum, $csvDepartement));
echo "<br>";


$date = "25/12/22";
$num = 123126789012345;

echo "<br>";
print $date;
echo "<br>";

var_dump(isFerie($date)); 
echo "<br>";
var_dump(isNum($num)); 

// echo "<pre>";
// print_r($csvDepartement);
// echo "<pre>";

echo "<pre>";
print_r(villesDepart($departNum, $csvVilles));
echo "<pre>";

function tableauFerie(){
    $joursFeries = array("01/01/22", "18/04/22", "01/05/22", "08/05/22", "26/05/22", "06/06/22", "14/07/22", "15/08/22", "01/11/22", "11/11/22", "25/12/22");
    return $joursFeries;
}

function isFerie($date){
    $joursFeries = tableauFerie();
    $result = false;
    foreach ($joursFeries as $key => $ferie) {
        if ($date == $ferie) {
            return $result = true;
        }
    }
    return $result;
}

function isNum($num){
    $numLength = strlen((string)$num);
    $genderDigit = substr($num, 0 , 1);
    $birthMonth = substr($num, 3 , 2);
    if ($numLength > 15 || $numLength = 0) {
        var_dump($numLength);
        return false;
    }
    elseif ($genderDigit > 2 || $genderDigit == 0) {
        var_dump($genderDigit);
        return false;
    }
    elseif ($birthMonth > 12 || $birthMonth == 0) {
        var_dump($birthMonth);
        return false;
    }
    return true;
}

function departName($departNum, $array){
    foreach ($array as $key => $depart) {
        if ($departNum == $depart[1]) {
            $departFound = $depart[2];
            return $departFound;
        }
    }
    $departFound = "Département introuvable";
    return $departFound;
}

function villesDepart($departNum, $array){
    $departVilles = array();
    foreach ($array as $key => $ville) {
        if ($departNum == $ville[1]) {
            array_push($departVilles,$ville[5]);
        }
    }
    if (count($departVilles) == 0) {
        return "Département introuvable";
    }
    return $departVilles;
}