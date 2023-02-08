<?php

$username = 'root';
$password = '';
$host = 'localhost';
$data = 'test';

$file = file_get_contents('./SQL/user.sql');

try {
    $db = new PDO('mysql:host=' . $host . ';dbname=' . $data . ';charset=utf8', $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $db->lastInsertId();

    $stmt = $db->prepare('SELECT MIN(age) as age_minimum FROM user');
    $stmt2 = $db->prepare('SELECT MAX(age) as age_maximum FROM user');
    $stmt3 = $db->prepare('SELECT count(*) as number FROM user');
    $stmt4 = $db->prepare('SELECT * from user WHERE numero >= 5');
    $stmt5 = $db->prepare('SELECT AVG(age) as age_moyen FROM user');
    $stmt6 = $db->prepare('SELECT SUM(numero) as somme_numero_maison FROM user');

    $state = $stmt->execute();
    $state2 = $stmt2->execute();
    $state3 = $stmt3->execute();
    $state4 = $stmt4->execute();
    $state5 = $stmt5->execute();
    $state6 = $stmt6->execute();


    if ($state) {
        $min = $stmt->fetch();
        echo "<pre>";
        print_r($min);
        echo "<pre>";
    }
    else {
        echo "requête invalide !";
    }

    echo "<br>";

    if ($state2) {
        $max = $stmt2->fetch();
        echo "<pre>";
        print_r($max);
        echo "<pre>";
    }
    else {
        echo "requête invalide !";
    }
    if ($state3) {
        $count = $stmt3->fetch();
        echo "<br>";
        echo "Il existe " . $count["number"] . " utilisateurs";
        echo "<br>";
    }
    else {
        echo "requête invalide !";
    }

    echo "<br>";

    if ($state4) {
        foreach ($stmt4->fetchAll() as $user){
            echo "Utilisateurs ayant 5 ou plus en numéro de rue " . $user['nom'] . " " . $user['prenom'] . '<br><br>';
        }
    }
    else {
        echo "requête invalide !";
    }
    if ($state5) {
        $moy = $stmt5->fetch();
        echo "<pre>";
        print_r($moy);
        echo "<pre>";
    }
    else {
        echo "requête invalide !";
    }

    echo "<br>";

    if ($state6) {
        $sum = $stmt6->fetch();
        echo "<pre>";
        print_r($sum);
        echo "<pre>";
    }
    else {
        echo "requête invalide !";
    }
}


catch (PDOException $exception) {
    echo $exception->getMessage();
}