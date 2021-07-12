<?php

// Création du tableau pour les mois

$month = [
    1 =>'Janvier',
    2 =>'Février',
    3 => 'Mars',
    4 => 'Avril',
    5 => 'Mai',
    6 => 'Juin',
    7 => 'Juillet',
    8 =>'Août',
    9 =>'Septembre',
    10 =>'Octobre',
    11 =>'Novembre',
    12 =>'Décembre',
];

if(!empty($_REQUEST['validForm'])){
    if(!empty($_POST['month']) && !empty($_POST['year']) ){
    $year = $_POST['year'];
    // définition du fuseau horaire à appliquer
    setlocale(LC_TIME, 'fr', 'fr_FR');
    //date("l", mktime(0, 0, 0, 7, 1, 2000)) permet de dire quand commence le mois
    $startMonth = strftime('%A', mktime(0, 0, 0, $_POST['month'], 1, $year));

    $number = cal_days_in_month(CAL_GREGORIAN, $_POST['month'], $_POST['year']);
    $endMonth = strftime('%A', mktime(0, 0, 0, $_POST['month'], $number, $year));  
    }
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Partie 8 - TP </title>
</head>
<body>
<div class="container">
    <h1>TP</h1>

    <p text-center> Faire un formulaire avec deux listes déroulantes. La première sert à choisir le mois, et le deuxième permet d'avoir l'année.  
En fonction des choix, afficher un calendrier comme celui-ci : </p>

</div>
<div class="container text-center mt-4">
 
<?php if (!isset($_POST['validForm'])): ?>
<form action="#" method="post">

<div class="fallbackDatePicker">
      <span>
        <label for="month">Mois :</label>
        <select id="month" name="month">

    <option value="" <?= !empty($months) ?'selected' : ''; ?>  disabled selected >Mois</option>
    <?php  foreach ($month as $monthNb => $monthName){ ?>
    <option value="<?= $monthNb ?>"><?= $monthName ?></option>
       <?php  } ?>
        </select>
      </span>
      <span>
      <select id="year" name="year">
      <?php  for($year = (date('Y') - 10) ; $year < (date('Y') + 10) ; $year++ ) { ?>
          <option value="<?= $year ?>"><?= $year ?></option> 
          <?php ;} ?>
  
</div>

<input type="submit" value="Valider!" name="validForm">
</form>

<?php else : ?>
    <p> Pour le mois de <?= $_POST['month'] ?>  de l'année <?= $_POST['year'] ?> il y a <?= $number ?> jours </p>

<!--  ici avec $_POST['month'] j'appelle la value sélectionnée dans le formulaire, soit le $monthNb. 
Je veux maintenant transformer cette value de l'index par sa valeur dans le tableau associatif 
Si je remplace dans mes options monthNb par MonthName cela créé des erreurs au niveau du mkt. Je dois donc a priori rester sur du monthNb pour avoir un int-->

    <p> Son premier jour est un <?= $startMonth ?></p>
    <p> Son dernier jour est un <?= $endMonth ?></p>

<?php endif ?>

<!--Création du tableau.

On veut plusieurs informations

en entête mettre les jours de la semaine en commençant par le lundi - ce sont les TD
ensuite, pour chaque ligne on rempli chaque case en partant par le jour de la semaine du permier jour du mois.

-->

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
<!------------------------------------------------------->
<!--                  Préparation                      -->
<!------------------------------------------------------->

<!--
Ne pas chercher sur le net comment le faire.

Deux questions à se poser pour créer un calendrier

 - sur le mois choisi, il y a cb de jours?
 - quel jour commence le premier jour?



         <option value="" < ?= !isset($months) ?'selected' : ''; ?>  disabled selected >Mois</option>
         < ?php  foreach ($month as $monthSelect){ ?>
            <option value="< ?= $monthSelect ?>">< ?= $monthSelect ?></option>

       < ?php  } ?>

->

<!-- ---------------------------------------------------->
<!--                  Correction                       -->
<!------------------------------------------------------->

<!--

Le cas de mois non sélectionné n'a pas été pris en compte, il ne faut pas coublier de faire cette vérification.

=> 💣 reprendre les exos du formulaire pour si il manque des choses, redemander les corrections avec l'informations nécessaire.


->