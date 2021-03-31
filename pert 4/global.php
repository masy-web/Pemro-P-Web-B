
<?php
    require 'Tabung.php';

    $tabung = new Tabung;

    if (isset($_POST['button'])) {
        $tabung->setDiameter($_POST['diameter']);
        $tabung->setTinggi($_POST['tinggi']);

    }
    // $luas = 0;
    // $volume = 0;
    // if (isset($_POST['button'])) {
    //     $diameter = $_POST['diameter'];
    //     $tinggi = $_POST['tinggi'];
    //     $r = $diameter / 2;

    //     $luas = 3.14 * $diameter * $tinggi;
    //     $volume = 3.14 * $r * $r * $tinggi;
        
    //     #echo "Diameter $diameter <br/>";
    //     #echo "Tinggi $dtinggi <br/>";
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <label for="">Diameter Alas</label>
        <input type="text" name="diameter"> <br>
        <label for="">Tinggi Tabung</label>
        <input type="text" name="tinggi"> <br><br>
        <button name=button>Hitung</button>
    </form>
    <br>
    <ul>
        <li>Luas Selimut : <?= $tabung->getLuasSelimutTab(); ?></li>
        <li>Volume : <?= $volume; ?></li>
    </ul>
</body>
