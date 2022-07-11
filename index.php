<?php
require_once 'class/TempEau.php';
$tempEau = new TempEau();

$code_stations = $tempEau->getCodeStation();

?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Temperature cours d'eau</title>
    <link rel="stylesheet" href="css/style.css">
    <script type="text/javascript" src="js/script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


</head>

<body>

    <h1>Température des cours d'eau de Gironde </h1>
    <h2> Les cinq derniers relevés de température dans les stations suivantes : </h2>
    <div class=container1>
        <div class="pills2">
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <?php foreach ($code_stations as $code_station) : ?>

                    <?php $temp =  new TempEau();

                    $tempStations = $temp->getMultipleTemp($code_station['code_station'], 5);
                    $nomStations = $temp->getOneTemp($code_station['code_station']);
                    ?>


                    <?php

                    $count += 1;


                    if ($count == 1) {
                        $active = 'class= "nav-link active" ';
                    } else {
                        $active = 'class = "nav-link "';
                    }
                    ?>
                    <?php foreach ($nomStations as $nomStation) : ?>


                        <li class="nav-item" role="presentation">
                            <button <?= $active ?> id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#x<?= $index2 += 1 ?>" type="button" role="tab" aria-controls="pills-home" aria-selected="true"><?= $nomStation['libelle_station'] ?></button>
                        </li>
                    <?php endforeach  ?>

                <?php endforeach  ?>
            </ul>
        </div>

        <div class="tab-content" id="pills-tabContent">
            <?php foreach ($code_stations as $code_station) : ?>

                <?php $temp =  new TempEau();

                $tempStations = $temp->getMultipleTemp($code_station['code_station'], 5);
                $nomStations = $temp->getOneTemp($code_station['code_station']);
                ?>
                <?php

                $count2 += 1;
                if ($count2 == 1) {
                    $active2 = 'class="tab-pane fade show active"';
                } else {
                    $active2 = 'class="tab-pane fade show"';
                }
                ?>

                <div <?= $active2 ?>id="x<?= $index += 1 ?>" role="tabpanel" aria-labelledby="pills-home-tab">

                    <?php foreach ($tempStations as $tempStation) : ?>

                        <p class="temperature">La température de l'eau relevée le <span class="date"> <?= date('d/m/y', strtotime($tempStation['date_mesure_temp'])) ?></span> à <span class="heur"><?= $tempStation['heure_mesure_temp'] ?>
                            </span>est : <span class=" temp"><?= round($tempStation['resultat']) ?> C° </span></p>
                    <?php endforeach  ?>
                </div>

            <?php endforeach  ?>
        </div>


    </div>


</body>

</html>