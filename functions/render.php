<?php
function renderTemplate($templateFile, $data = array()) {
    $content = file_get_contents($templateFile);



        // Gérer chaque variable passée
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                // Si la valeur est un tableau, cela signifie qu'on a une boucle
                // On doit trouver la boucle {{#key}} ... {{/key}}
                $pattern = "/{{#$key}}(.*?){{\/$key}}/s";
                preg_match($pattern, $content, $matches);

                if (!empty($matches)) {
                    $loopTemplate = $matches[1]; // Le contenu à l'intérieur de la boucle
                    $loopContent = '';

                    // Boucle sur chaque élément du tableau
                    foreach ($value as $item) {
                        $itemContent = $loopTemplate; // Commence avec le modèle de la boucle
                        // Remplacer les variables internes de la boucle
                        foreach ($item as $itemKey => $itemValue) {
                            $itemContent = str_replace("{{ $itemKey }}", $itemValue, $itemContent);
                        }
                        $loopContent .= $itemContent; // Ajouter le contenu généré
                    }

                    // Remplacer la boucle entière dans le template avec le contenu généré
                    $content = str_replace($matches[0], $loopContent, $content);
                }
            } else {
                // Sinon, c'est une variable simple à remplacer
                $content = str_replace("{{ $key }}", $value, $content);
            }
        }



    // remplacer les variables qui ne sont pas dans le tableau passé en paramètre
    $pattern = '/(\{\{ .*? \}\})/';
    $replacement = '';
    $content =  preg_replace($pattern, $replacement, $content);

    return $content;
}
?>