<?php


function defaulte()
{


$db = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$zapytanie = new MongoDB\Driver\Query([]);
$wiersze = $db->executeQuery("rent.filmy",$zapytanie);

$filter = ['ocena' => ['$gt' => 0]];
$options = [
    'sort' => ['gatunek' => -1],

];
?>
    <table style='border:1px solid red border-collapse:collapse' border='1px'>
    <thead>
    <tr>
        <th>lp</th>
        <th>tytul</th>
        <th>gatunek</th>
        <th>rezyser</th>
        <th>czas trwania</th>
        <th>status</th>
    </tr>
    </thead>
    <tbody>
    <?php
foreach($wiersze as $wiersz){
    echo "<tr>";
    echo  nl2br("<td>$wiersz->_id</td> <td>$wiersz->tytul</td> <td>$wiersz->gatunek </td><td>$wiersz->rezyser </td><td>$wiersz->czastrwania </td><td>$wiersz->status </td> \n");
    echo "</tr>";
}
}


echo "<section class='zwykla'>";


echo "
<form method='POST' action='szczegoly.php'>
    <button type='submit' class='login'  name='loginSubmit'>Szczegoły</button>
</form>";

echo "</section>";






















function option1()
{


$db = new MongoDB\Driver\Manager("mongodb://localhost:27017");


$filter = ['ocena' => ['$gt' => 0]];
$options = [
    'sort' => ['gatunek' => -1],

];


$zapytanie = new MongoDB\Driver\Query($filter, $options);
$wiersze = $db->executeQuery("rent.filmy",$zapytanie);
?>
    <table style='border:1px solid red border-collapse:collapse' border='1px'>
        <thead>
        <tr>
            <th>lp</th>
            <th>tytul</th>
            <th>gatunek</th>
            <th>rezyser</th>
            <th>czas trwania</th>
        </tr>
        </thead>
        <tbody>
    <?php
    foreach($wiersze as $wiersz){
        echo "<tr>";
        echo  nl2br("<td>$wiersz->_id</td> <td>$wiersz->tytul</td> <td>$wiersz->gatunek </td><td>$wiersz->rezyser </td><td>$wiersz->czastrwania </td> \n");
        echo "</tr>";
    }

}
?>