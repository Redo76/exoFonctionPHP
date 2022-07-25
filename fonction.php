<?php
include_once("tableau_datas.php");

$csvDepartement = array_map("str_getcsv", file("departement.csv"));
$departNum = "76";

$csvVilles = array_map("str_getcsv", file("villes_france.csv"));



// $csvParking =  array_map("str_getcsv", file("occupation-parkings-temps-reel.csv"));
$csvParking =  array_map(function($data) { return str_getcsv($data,";");}, file("occupation-parkings-temps-reel.csv"));

print(departName($departNum, $csvDepartement));
echo "<br>";


$date = "2022-12-25";
$num = 123126789012345;
$parkingName = "Parking Baggersee";
$ville = "New York";

echo "<br>";
print $date;
echo "<br>";

var_dump(isFerie($date)); 
echo "<br>";
var_dump(isNum($num)); 

echo "<br>";
print(weekDay($date));
echo "<br>";


print(parkingState($parkingName, $csvParking));
echo "<br>";
print(parkingPlaces($parkingName, $csvParking));
echo "<br>";

print(employesVilles($ville, $tableau));
echo "<br>";

print(mostEmploye());
echo "<br>";

// echo "<pre>";
// print_r($csvDepartement);
// echo "<pre>";

// echo "<pre>";
// print_r(villesDepart($departNum, $csvVilles));
// echo "<pre>";

function tableauFerie(){
    $joursFeriesTab = array_map("str_getcsv", file("jours_feries_metropole.csv"));
    $jours = array();
    foreach ($joursFeriesTab as $key => $joursFeries) {
        array_push($jours, $joursFeries[0]);
    }
    return $jours;
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

function weekDay($date){
    $weekDay = date("l", strtotime($date));
    $day = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
    $dayFrench = array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
    $frenchWeekDay = str_replace($day, $dayFrench, $weekDay);
    return $frenchWeekDay;
}

function parkingState($parkingName, $array){
    foreach ($array as $key => $parking) {
        if ($parkingName == $parking[0]) {
            return $parking[4];
        }
    }
    $noPark = "Parking introuvable";
    return $noPark;
}

function parkingPlaces($parkingName, $array){
    foreach ($array as $key => $parking) {
        if ($parkingName == $parking[0]) {
            return $parking[6];
        }
    }
    $noPark = "Parking introuvable";
    return $noPark;
}

function employesVilles($villeName, $array){
    $employes = array();
    foreach ($array as $key => $employe) {
        if ($villeName == $employe[2]) {
            array_push($employes, $employe[0]);
        }
    }
    if (count($employes) == 0) {
        return "Ville introuvable";
    }
    else {
        return count($employes);
    }
}

function mostEmploye(){
    include('tableau_datas.php');
    $value = 0;
    foreach ($tableau as $key => $employe) {
        if ($value < $employe[3]) {
            $value = $employe[3];
            $name = $employe[0];
        }
    }
    return $name;
}