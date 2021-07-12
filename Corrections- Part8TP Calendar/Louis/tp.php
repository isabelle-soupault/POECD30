<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>TP partie 8</title>
</head>
<body>
    <h1>TP8</h2>
    
    <form action="" method="get">
        <label for="month">Mois</label>
        <select name="month" id="">
            <option value="1">Janvier</option>
            <option value="2">Février</option>
            <option value="3">Mars</option>
            <option value="4">Avril</option>
            <option value="5">Mai</option>
            <option value="6">Juin</option>
            <option value="7">Juillet</option>
            <option value="8">Août</option>
            <option value="9">Septembre</option>
            <option value="10">Octobre</option>
            <option value="11">Novembre</option>
            <option value="12">Décembre</option>
        </select>
        <label for="year">Années</label>
        <select name="year" id="">
    <?php
        for($year = 1950; $year <= date('Y'); $year++): ?>
            <option value="<?= $year ?>"><?= $year ?></option>
        <?php endfor;?>
    </select>
        <input class="" type="submit" value="Afficher le calendrier">
    </form>

    <?php 
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $monthChoosen = 1;
    if (!empty($_GET['month'])) {
       $monthChoosen = $_GET['month'];
    }
    $chosenYear = 1950;
    if (!empty($_GET['year'])) {
        $chosenYear = $_GET['year'];
    }
    $dateObj = DateTime::createFromFormat('!m', $monthChoosen);
        $monthName = $dateObj->format('F');
        ?>
        <h2><?= $monthName . ' '  . $chosenYear ?></h2>
        <table class="table table-bordered" style="max-width: 30rem">
            <tr>
                <th scope="col">Monday</th>
                <th scope="col">Tuesday</th>
                <th scope="col">Wednesday</th>
                <th scope="col">Thursday</th>
                <th scope="col">Friday</th>
                <th scope="col">Saturday</th>
                <th scope="col">Sunday</th>
            </tr>
        <?php 
        $month = $monthChoosen;
        $year = $chosenYear;
        $number = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $firstDay = new DateTime($year-$month-1);
        $dayOfTheWeek = $firstDay->format('w');

        if ($dayOfTheWeek == 0) {
            $dayOfTheWeek = 7;
        }
        for ($i=1; $i < $dayOfTheWeek ; $i++) { ?>
            <td style="background: #A0A0A0;"></td>
        <?php } 
        $day = 1;
        while ($day <= $number) {
            $currDay = new DateTime();
            $currDay->setDate($year, $month, $day); 
            if($currDay->format('l') == 'Monday'): ?>
                </tr><tr>
            <?php endif; ?>
            <td> <?= $day ?></td> 
            <?php $day++;
        }
        $lastDay = new DateTime($year-$month-$number);
        $dayOfTheWeek = $lastDay->format('w');
        for ($i=$dayOfTheWeek; $i <= 6 ; $i++) { ?>
            <td style="background: #A0A0A0;"></td>
        <?php } ?> 
        </table>
<?php } ?>
        

</body>
<style>
    td {
        min-width: 100px;
    }
    th {
        text-align: center;
    }
</style>
</html>