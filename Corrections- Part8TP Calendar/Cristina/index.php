<?php
date_default_timezone_set('Europe/Paris');
function monthName($num)
{
    $arrayMonths = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    echo $arrayMonths[--$num];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Partie 5 - Exercice 9</title>
</head>


<body>
    <h1>Partie 8 - TP Calendrier</h1>
    <p>Faire un formulaire avec deux listes déroulantes. La première sert à choisir le mois, et le deuxième permet d'avoir l'année. </p>

    <!-- formulaire -->
    <form class="text-center" action="index.php" method="post" enctype="multipart/form-data">
        <label>Mois : </label>
        <select id="months" name="months">
            <option <?= empty($_POST['months']) ? 'selected' : ''; ?> value=""> </option>
            <?php
            for ($i = 1; $i <= 12; $i++) {
            ?>
                <option <?= (!empty($_POST['months']) && (($_POST['months']) == $i)) ? 'selected' : ''; ?> value="<?= $i  ?>"><?= monthName($i); ?></option>
            <?php
            } // end for
            ?>
        </select>

        <label>Année : </label>
        <select id="years" name="years">

            <option <?= empty($_POST['years']) ? 'selected' : ''; ?> value=""> </option>
            <?php
            for ($i = 2000; $i <= 2022; $i++) {
            ?>
                <option <?= (!empty($_POST['years']) && (($_POST['years']) == $i)) ? 'selected' : ''; ?> value="<?= $i  ?>"><?= $i ?></option>
            <?php
            } // end for
            ?>
        </select>
        <input type="submit" value="Envoyer les informations" name="sendProfile">
    </form>

    <?php
    if (!isset($_REQUEST['sendProfile']) || empty($_POST['months']) || empty($_POST['years'])) {
    ?>
        <p class="show">Sélectionner un mois et une année.</p>
    <?php
    } else {

        $monthNumber = $_POST['months'];
        $yearNumber = $_POST['years'];
        $number = cal_days_in_month(CAL_GREGORIAN, $monthNumber, $yearNumber);

    ?>

        <h2 class="text-center"><?= monthName($monthNumber) . ' ' . $yearNumber; ?></h2>

        <ul>
            <li class="header">
                <p>Lundi</p>
            </li>
            <li class="header">
                <p>Mardi</p>
            </li>
            <li class="header">
                <p>Mercredi</p>
            </li>
            <li class="header">
                <p>Jeudi</p>
            </li>
            <li class="header">
                <p>Vendredi</p>
            </li>
            <li class="header">
                <p>Samedi</p>
            </li>
            <li class="header">
                <p>Dimanche</p>
            </li>
            <?php
            // bucle construction du calendrier du mois choisi           
            $getDayWeek = new DateTime($yearNumber . '-' . $monthNumber . '-01');           
            $firstDayOfTheWeek = $getDayWeek->format('w'); 
            $getDayWeek = new DateTime($yearNumber . '-' . $monthNumber . '-' . $number);           
            $lastDayOfTheWeek = $getDayWeek->format('w');
            
            if ($firstDayOfTheWeek == 0) {
                $firstDayOfTheWeek = 7;
            }
            $lastDayOfTheWeek++;
            for ($i = 1; $i <= $firstDayOfTheWeek; $i++) {
                ?><li></li><?php
            } // end for 
            $day = 1;
            while ($day <= $number) {
                for ($i = 1; $i <= $number; $i++) {
                    ?>
                    <li class="body"><p><?= $day ?></p></li>
                    <?php
                    $day++;
                } // end for 
            }
            for ($i = 6; $i >= $lastDayOfTheWeek; $i--)  {
                ?><li></li><?php
            } // end for 
            
            ?>
        </ul>
        <div class="clear"></div>
    <?php
    } // end if 
    ?>
</body>

</html>