<?php
echo "<div style='border: 1px solid black; color: darkblue; margin-bottom: 30px; padding:5px'><h3>debug info</h3>";
// visualiser le contenu du $_GET
var_dump($_GET);

echo "<br>";

// visualisation du contenu de $_GET
foreach ($_GET as $key => $value) {
    echo "$key : $value<br>";
}

echo "<br>";

// mais $_GET est dangereux
// parce qu'il contient des informations du monde externe
// rien n'empêche un acker de mettre des donnés bizarres par
// http://localhost/demos/isValid.php?hack=<h1>Hacké</h1>
// => nécessiter de valider les inputs
// 2 techniques
//      (1) validation => refuser ce qui n'est pas valide <===
//      (2) nettoyage (Sanitize) => éliminer, encoder ce qui n'est pas bon
// valide le contenu $_GET[isValid]
// et le sauve dans la variable $valid
$valid = filter_input(INPUT_GET, "isValid", FILTER_SANITIZE_NUMBER_INT);
//                    |            |         |
//                    |            |        règle de filtre, voir http://php.net/manual/fr/filter.filters.sanitize.php
//                    |          cléf ($_GET['isValid']
//                    prend la variable $_GET

echo $_GET['isValid'] . " ==filter_input==> " . $valid . "<br>";
echo "test d'addition : 2+valid =? " . (2 + $valid) . "<br>";
echo "</div>";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Error</title>
        <style>
            .error {
                color: red;
            }
            .error-star {
                font-size: 2em;
                font-weight: bold;
            }
            .error-text {
                font-size: 0.85em;
            }
        </style>
    </head>
    <body>
        <!-- montrer comment afficher un message d'erreur -->
<?php if (!$valid) { ?>
            <p>Ceci est un message d'erreur</p>
        <?php } ?>
        <form action="isValid.php" method="GET"> 
            <!--                |                 |
                                |         normalement on utilise la method POST, ici c'est GET pour faciliter les test
                             le formulaire est envoyé au script isValid.php, qui est formulaire-->
            <input type="text" name="isValid" min=0 max=1 
                   value="<?php echo $valid ?>" 
<?php if (!$valid) { ?>style='border: 3px solid red'<?php } ?>
                   />
            <span class="error error-star">*</span>
            <span class="error error-text">Veuillez introduire un nombre entier différent de 0</span>
            <!--                                                    |
                                                      injection du contenu de la variable $valid dans l'input-->
            <input type="submit" value="envoyer"/>
        </form>
    </body>
</html>
