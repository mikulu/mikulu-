<?php
$valid = filter_input(INPUT_GET, "isValid", FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Error</title>
    </head>
    <body>
        <?php if (!$valid) { ?>
            <p>Ceci est un message d'erreur</p>
        <?php } ?>
        <form action="isValid.php" method="GET">
            <input type="number" name="isValid" min=0 max=1 value="<?php echo $valid ?>" />
            <input type="submit" value="envoyer"/>
        </form>
    </body>
</html>
