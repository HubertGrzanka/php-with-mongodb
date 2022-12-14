<?php
session_start();

$filter = ['id_klient' => ['$gt' => 0]];
$options = [
    'sort' => ['id_klient' => 1],
];


$db2 = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$zapytanie2 = new MongoDB\Driver\Query($filter,$options);
$wiersze2 = $db2->executeQuery("rent.rents",$zapytanie2);



?>

<!DOCTYPE html>
<html lang="en">
<head>
</head>



<form method='POST' action='index.php'>
    <button type='submit' class='index'  name='wypozycz'>Lista Filmów</button>
</form>
<form method='POST' action='dodaj.php'>
    <button type='submit' class='dodaj'  name='dodaj'>Klienci</button>
</form>
<!--_______________________________________________________________________________________________________-->
<!--                                                                                                       -->
<!--                                                                                                       -->
<!--                                            LIST WYPOZYCZEN                                            -->
<!--                                                                                                       -->
<!--                                                                                                       -->
<!--                                                                                                       -->

<div id="st1">
    <table style='border:1px solid red border-collapse:collapse' border='1px'>
        <thead>
        <tr>
            <th>id_klienta</th>
            <th>imie</th>
            <th>nazwisko</th>
            <th>adres</th>
            <th>datarejestracji</th>
            <th>tytul</th>
            <th>datawypozyczenia</th>
            <th>zwrotplanowany</th>
            <th>zwrot</th>
            <th>id_filmu</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach($wiersze2 as $wiersz2){

            echo "<tr>";
            echo  nl2br("<td>$wiersz2->id_klient</td> <td>$wiersz2->imie</td> <td>$wiersz2->nazwisko </td><td>$wiersz2->adres </td><td>$wiersz2->datarejestracji </td><td>$wiersz2->tytul </td><td>$wiersz2->datawypozyczenia </td><td>$wiersz2->zwrotplanowany </td><td>$wiersz2->zwrot </td><td>$wiersz2->idf</td> \n");
            echo "</tr>";
        }
        ?>
        </tbody>
</div>
<br>
<br>
<!--                                            SORTOWANIE  2                                           -->
<section class="sort2">
    <form action="sort2.php" method="post">
        Sortuj wg. <select name="sortuj">
            <option value="v1">Imie</option>
            <option value="v2">Nazwisko</option>
            <option value="v3">Data Wypożyczenia</option>
        </select>
        <input type="submit" name="submit" value="Sortuj"/>
    </form>
</section><br><br>
<!--    imie,nazwisko, id filmu, tytul filmu, data wypozyczenia                                        WYSZUKIWANIE2                                         -->
<section class="comment">
    <form method='POST' action='wyszukaj2.php'>
        Imie: <input type="text" name="imie">
        Nazwisko: <input type="text" name="nazwisko">
        Id Filmu: <input type="text" name="idf">
        Tytul: <input type="text" name="tytul">
        Data Wypożyczenia: <input type="text" name="data">
        <button class="xd" type="submit" name="submit2">Wyszukaj</button>
    </form><br><br>
</section>

</html>

