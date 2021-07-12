<?php
    function roundUp($n,$x) {
        return (round($n)%$x === 0) ? round($n) : round(($n+$x/2)/$x)*$x;
    }
    
    $defaultYear = date('Y');
    $currentYear = $defaultYear;
    $defaultMonth = date('m');
    $oldestYear = 1800;
    $months = array('Janvier', 'Fevrier', 'Mars', 'Avril', 'May', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Decembre');
    $days = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
    if(!empty($_POST)){
        $defaultYear = $_POST['year'];
        $defaultMonth = $_POST['month'];
    }

    $firstday = new DateTime("$defaultYear-$defaultMonth-1");
    $firstDayId = $firstday->format('N'); //premier jour
    $nbrDays = $firstday->format('t'); //nbr de jours dans le mois
    $toShow = [];
    $count = 1;
    for ($i=0; $i < roundUp($firstDayId + $nbrDays - 1, 7) + 1; $i++) { 
        if($i < $firstDayId || $i > $firstDayId + $nbrDays - 1)
            $toShow[$i] = "";
        else
            $toShow[$i] = $count++;
    }
    $max = roundUp($firstDayId + $nbrDays - 1, 7) / 7;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <form action="?" method="post">

        <!-- Drop down menu month -->
        <select name="month" id="month">
            <?php
                foreach ($months as $key => $month) {
                    ?><option value="<?= sprintf("%02d", $key+1) ?>"<?php if($key+1 == $defaultMonth) { ?> selected<?php } ?>><?= $month ?></option><?php
                }
            ?>
        </select>

        <!-- drop down menu year -->
        <select name="year" id="year">
            <?php
                //if($oldestYear < 1940) $oldestYear = 1940;
                for ($i=$currentYear; $i >= $oldestYear; $i--) { 
                    ?> <option value="<?= $i ?>" <?php if($i == $defaultYear) { ?> selected<?php } ?>><?= $i ?></option><?php
                }
            ?>
        </select>
        <button type="submit">Update</button>
    </form>

    <!-- Presentation -->
    <h1>Calendrier :</h1>
    <h2><?php echo $months[number_format($defaultMonth-1)].' '.$defaultYear ?></h2>
    <table>
        <thead>
            <tr>
                <!-- Jours de la semaine -->
                <?php
                    foreach ($days as $value) {
                        ?><td><?= $value ?> </td> <?php
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <!-- numbero dans les cases toussa toussa -->
            <?php
                for ($i=0; $i < $max; $i++) { 
                    ?><tr><?php
                        for ($j=1; $j < 8; $j++) {
                            if($toShow[$i * 7 + $j] == ""){
                                ?><td class="empty"><?php echo $toShow[$i * 7 + $j]?></td><?php
                            } else {
                                ?><td class="full"><?php echo $toShow[$i * 7 + $j]?></td><?php
                            }
                        }
                    ?></tr><?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>