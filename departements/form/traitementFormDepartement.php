<?php

if(isset($_POST["enregistrer"])) {

    if(isset($_POST["name"])) {
        $data["name"] = $_POST["name"];
    }
    if(isset($_POST["localisation"])) {
        $data["localisation"] = $_POST["localisation"];
    }

    if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {	// $_FILES['photo'] existe on récupère les infos qui nous intéressent

        $fichier 	= $_FILES['photo']['name'];	// nom réel du fichier
        $size 	= $_FILES['photo']['size']; 	// poids du fichier en octets
        $tmp 	= $_FILES['photo']['tmp_name'];	// nom temporaire du fichier (sur le serveur)
        $type 	= $_FILES['photo']['type'];	// type du fichier


        if($type != "image/jpeg" || $type != "image/png"  || $type != "image/webp" ) {
            $data["errorImage"] = "Veuillez sélectionner une image";
        }
        else {
            if (is_uploaded_file($tmp)) {		//permet de vérifier si le fichier a été téléchargé via http

                if (move_uploaded_file($tmp,"./images/$fichier")) // on déplace le fichier dans le répertoire final
                    echo "le fichier a bien été téléchargé sur le serveur <br />";

                echo "<a href='./images/'>lien vers le répertoire qui contient le fichier</a> <br /><br />";
            }
        }

    }


}




