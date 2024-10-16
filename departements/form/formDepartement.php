<?php
    include ("../../functions/render.php");

    $data = array();
    include("./traitementFormDepartement.php");

    echo renderTemplate("../../templates/departements/formDepartement.html", $data);

