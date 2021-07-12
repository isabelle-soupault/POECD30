<?php
//Création du tableau permettant de contruire la liste déroulante des choix de civilités
$civilityList = ['M' => 'Monsieur', 'Mme' => 'Madame'];
//On vérifie que le formulaire a bien été soumis
if (isset($_POST['register'])) {
    $regexName = '/^[a-zA-Z]([ À-ǿa-zA-Z\'\-])*$/';
    $regexAge = '/^[1-9][0-9]?$/';
    //Création du tableau d'erreur
    $formErrorList = [];
    //On vérifie la civilité
    if (isset($_POST['civility'])) {
        if (array_key_exists($_POST['civility'], $civilityList)) {
            $civility = htmlspecialchars($_POST['civility']);
        } else {
            $formErrorList['civility'] = 'Veuillez choisir une civilité valide';
        }
    } else {
        $formErrorList['civility'] = 'Veuillez choisir votre civilité';
    }
    //On vérifie que le champ lastname n'est pas vide
    if (!empty($_POST['lastname'])) {
        //Qu'il correspond bien à un format valide
        if (preg_match($regexName, $_POST['lastname'])) {
            $lastname = htmlspecialchars($_POST['lastname']);
        } else {
            $formErrorList['lastname'] = 'Votre nom de famille ne doit comporter que des lettres, accent et séparateur (\', - ou espace)';
        }
    } else {
        $formErrorList['lastname'] = 'Veuillez renseigner votre nom';
    }
    //On vérifie que le champ firstname n'est pas vide
    if (!empty($_POST['firstname'])) {
        //Qu'il correspond bien à un format valide
        if (preg_match($regexName, $_POST['firstname'])) {
            $firstname = htmlspecialchars($_POST['firstname']);
        } else {
            $formErrorList['firstname'] = 'Votre prénom ne doit comporter que des lettres, accent et séparateur (\', - ou espace)';
        }
    } else {
        $formErrorList['firstname'] = 'Veuillez renseigner votre prénom';
    }
    //On vérifie que le champ age n'est pas vide
    if (!empty($_POST['age'])) {
        //Qu'il est bien compris entre 1 et 99
        if (preg_match($regexAge, $_POST['age'])) {
            $age = htmlspecialchars($_POST['age']);
        } else {
            $formErrorList['age'] = 'Votre age doit être compris entre 1 et 99';
        }
    } else {
        $formErrorList['age'] = 'Veuillez renseigner votre age';
    }
    //On vérifie que le champ society n'est pas vide
    if (!empty($_POST['society'])) {
        $society = htmlspecialchars($_POST['society']);
    } else {
        $formErrorList['society'] = 'Veuillez renseigner votre societé';
    }
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>TP 1</title>
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-4 offset-1" id="leftSide">
                <img class="img-fluid" src="assets/img/leftSide.jpg" />
            </div>
            <div class="col-6 card">
                <div class="card-body">
                    <h1 class="card-title h2 mb-5 ">Formulaire d'inscription</h1>
                    <form action="index.php" method="POST">
                        <select class="form-select mb-3 <?= !isset($_POST['register']) ?: (isset($formErrorList['civility']) ? 'is-invalid' : 'is-valid') ?>" name="civility">
                            <option selected disabled>Choix de la civilité</option>
                            <?php
                            foreach ($civilityList as $value => $text) { ?>
                                <option <?= (isset($civility) && $civility == $value) ? 'selected': null ?> value="<?= $value ?>"><?= $text ?></option>
                            <?php } ?>
                        </select>
                        <div class="mb-3">
                            <label for="lastname" class="form-label">Nom : </label>
                            <!-- 
                                Pour cette condition : !isset($_POST['register']) ? null : (isset($formErrorList['lastname']) ? 'is-invalid' : 'is-valid')
                                - On vérifie que le formulaire n'a pas été validé !isset($_POST['register'])
                                - Si ce n'est pas le cas, On vérifie si le champ est valide. 
                                - On le met en rouge si il y a une erreur et en vert si il est bien renseigné
                            -->
                            <input type="text" class="form-control <?= !isset($_POST['register']) ? null : (isset($formErrorList['lastname']) ? 'is-invalid' : 'is-valid') ?>" id="lastname" name="lastname" value="<?= !isset($lastname) ? null : $lastname ?>" />
                            <?php if (isset($formErrorList['lastname'])) { ?>
                                <p><small class="badge bg-danger"><?= $formErrorList['lastname'] ?></small></p>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label for="firstname" class="form-label">Prénom : </label>
                            <input type="text" class="form-control <?= !isset($_POST['register']) ? null : (isset($formErrorList['firstname']) ? 'is-invalid' : 'is-valid') ?>" id="firstname" name="firstname" value="<?= !isset($firstname) ? null : $firstname ?>" />
                            <?php if (isset($formErrorList['firstname'])) { ?>
                                <p><small class="badge bg-danger"><?= $formErrorList['firstname'] ?></small></p>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Age : </label>
                            <input type="number" class="form-control <?= !isset($_POST['register']) ? null : (isset($formErrorList['age']) ? 'is-invalid' : 'is-valid') ?>" id="age" name="age" value="<?= !isset($age) ? null : $age ?>" />
                            <?php if (isset($formErrorList['age'])) { ?>
                                <p><small class="badge bg-danger"><?= $formErrorList['age'] ?></small></p>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <label for="society" class="form-label">Prénom : </label>
                            <input type="text" class="form-control <?= !isset($_POST['register']) ? null : (isset($formErrorList['society']) ? 'is-invalid' : 'is-valid') ?>" id="society" name="society" value="<?= !isset($society) ? null : $society ?>" />
                            <?php if (isset($formErrorList['society'])) { ?>
                                <p><small class="badge bg-danger"><?= $formErrorList['society'] ?></small></p>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-secondary" type="submit" name="register">S'enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>