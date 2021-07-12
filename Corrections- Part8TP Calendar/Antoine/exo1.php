<?php
    $date = getdate();
    $date2 = date_create();
    $mardDeuxAout = '2016-08-02 15:00:00';
    $seizeMai = '2016-05-16';
    $seizeMai_date = new DateTime($seizeMai);
    $mardDeuxAout_date = new DateTime($mardDeuxAout);
    $seizeMai_ts = date_timestamp_get($seizeMai_date);
    $mardDeuxAout_ts = date_timestamp_get($mardDeuxAout_date);
    $custom = "$date[weekday] $date[mday] $date[month] $date[year]";

    function translate(string $dt){
        $day_in_english = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
        $day_in_french = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
        $month_in_english = array('january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'spetember', 'october', 'november', 'december');
        $month_in_french = array('janvier', 'février', 'mars', 'avril', 'may', 'juin', 'juillet', 'aôut', 'septembre', 'octobre', 'novembre', 'décember') ;
        return str_ireplace($day_in_english, $day_in_french, str_ireplace($month_in_english, $month_in_french, $dt));       
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>
        Current timestamp : <?= date_timestamp_get($date2) ?> <br>
        Today : <?php print_r($date2); ?> <br>
    </p>
    <p> Date du jour exo 1 :
        <?= date('d/m/Y') ?>
    </p>
    <p> Date du jour exo 2 :
        <?= date('d-m-y') ?>
    </p>
    <p>
        Exo 3 + bonus : <br>
        full date : <?= $custom ?> <br>
        date complete : <?= translate($custom) ?>
    </p>
    <p>
        Exo 4 - old school timestamp : <?= $mardDeuxAout_ts ?>
    </p>
    <p>
        Exo 5 - days since 16th May 2016 : 
        <?php
            echo floor((date_timestamp_get($date2) - $seizeMai_ts)/(3600*24));
        ?>
    </p>
    <p>
        Exo 6 - nombre de jours dans le mois de février 2016 :
        <?=
            cal_days_in_month(CAL_GREGORIAN, 2, 2016);
        ?>
    </p>
    <p>
        Exo 7/8 : <br>
        today : <?= date_format($date2, 'd/m/Y') ?> <br>
        today + 20 days : <?php 
                            $date2->modify('+20 days');
                            echo date_format($date2, 'd/m/Y');
                          ?> <br>
        today - 22 days : <?php 
                            $date2->modify('-42 days');
                            echo date_format($date2, 'd/m/Y');
                          ?> <br>
    </p>
</body>
</html>