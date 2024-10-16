<?php


require_once("../../pdo/connection.php");

include ("../../functions/render.php");

$data = array();


$reqSelect = $conn->query("SELECT * FROM dept");

$data['depts'] = array();

while($dept = $reqSelect->fetchObject()) {

    $data['depts'][] =  array("dname" => $dept->dname, "loc"=> $dept->loc);
}

echo renderTemplate("../../templates/departements/listDepartement.html", $data);