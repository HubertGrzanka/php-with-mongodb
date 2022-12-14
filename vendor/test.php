<!DOCTYPE html>
<html lang="en">
<head>
    <title>ES</title>
</head>
<form method='POST' action='wypozycz.php'>
    <button type='submit' class='wypozycz'  name='wypozycz'>Lista Wypozyczen</button>
</form>
<form method='POST' action='index.php'>
    <button type='submit' class='index'  name='wypozycz'>Lista Filmów</button>
</form><br><br>
<section class="dodawanie">
    <form method='POST' action=''>
        Id: <input type="text" name="idklienta" required><br><br><br>
        Imie: <input type="text" name="imie" required><br><br>
        Nazwisko: <input type="text" name="nazwisko" required><br><br>
        adres: <input type="text" name="adres" required><br><br>
        telefon: <input type="text" name="telefon" required><br><br>
        <button class="xd" type="Edytuj" name="Edytuj">Edytuj</button>

    </form><br><br>
</section>


<?php
try {

    $db3 = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    $zapytanie3 = new MongoDB\Driver\Query([]);
    $wiersze3 = $db3->executeQuery("rent.klienci",$zapytanie3);

    echo "      <table style='border:1px solid red border-collapse:collapse' border='1px'>
    <thead>
    <tr>
        <th>id_klienta</th>
        <th>imie</th>
        <th>nazwisko</th>
        <th>adres</th>
        <th>telefon</th>
        <th>datarejstracji</th>
    </tr>
</thead><tbody>";
    foreach($wiersze3 as $wiersz3){
        echo "<tr>";
        echo  nl2br("<td>$wiersz3->_id</td> <td>$wiersz3->imie</td> <td>$wiersz3->nazwisko </td><td>$wiersz3->adres </td><td>$wiersz3->telefon <td>$wiersz3->datarejestracji </td>\n");
        echo "</tr>";
    }

}
catch(Exception $e) {
    print($e->getMessage());
}




if (isset($_POST['Edytuj'])) {


    $ajdi = $_POST['idklienta'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $adres = $_POST['adres'];
    $telefon = $_POST['telefon'];
    $datarejestracji = date("Y/m/d");

    echo $ajdi;
    echo '<br>';
    echo $telefon;
    echo '<br>';
    echo $imie;
    echo '<br>';
    echo $nazwisko;
    echo '<br>';
    echo $datarejestracji;
    echo '<br>';
    echo $adres;
    echo '<br>';

    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->update(['_id' => 2], ['$set' => ['nazwisko' =>$nazwisko]]);
    $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
    $result = $manager->executeBulkWrite('rent.klienci', $bulk);






}


















?>
</html>