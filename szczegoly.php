<?php
$db = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$zapytanie = new MongoDB\Driver\Query([]);
$wiersze = $db->executeQuery("rent.filmy",$zapytanie);

?>





    <section class="listaw">
        <form method='POST' action='wypozycz.php'>
            <button type='submit' class='wypozycz'  name='wypozycz'>Lista Wypozyczen</button>
        </form>
        <form method='POST' action='dodaj.php'>
            <button type='submit' class='dodaj'  name='dodaj'>Klienci</button>
        </form>
    <form method='POST' action='write2.php'>
         <!--Id: <input type="text" name="idf"><br><br><br>  -->
        Tytul: <input type="text" name="tytul" ><br><br>
        Gatunek: <input type="text" name="gatunek" ><br><br>
        Rezyser: <input type="text" name="rezyser" ><br><br>
        Czas Trwania: <input type="text" name="czastrwania"><br><br>
        Fabula: <input type="text" name="fabula"><br><br>
        Ocena: <input type="text" name="ocena"><br><br>
        Aktor1: <input type="text" name="aktor1"><br><br>
        Aktor2: <input type="text" name="aktor2"><br><br><br>


        <button class="xd" type="Dodajj" name="Dodajj">Dodaj</button>
        <button class="xd" type="Edytujj" name="Edytujj">Edytuj</button>
        <button class="xd" type="Usunn" name="Usunn">Usuń</button>


    </form>
    </section>
    <table style='border:1px solid red border-collapse:collapse' border='1px'>
        <thead>
        <tr>
            <th>lp</th>
            <th>tytul</th>
            <th>gatunek</th>
            <th>rezyser</th>
            <th>czastrwania</th>
            <th>datadodania</th>
            <th>fabula</th>
            <th>ocena</th>
            <th>aktor1</th>
            <th>aktor2</th>
            <th>status</th>
        </tr>
        </thead>
        <tbody>




<?php
foreach($wiersze as $wiersz){
    echo "<tr>";
    echo  nl2br("<td>$wiersz->_id</td><td>$wiersz->tytul </td> <td>$wiersz->gatunek </td><td>$wiersz->rezyser </td><td>$wiersz->czastrwania </td><td>$wiersz->datadodania</td><td>$wiersz->fabula </td><td>$wiersz->ocena</td><td>$wiersz->aktor1</td><td>$wiersz->aktor2</td><td>$wiersz->status </td>   \n");
    echo "</tr>";
}

echo "<section class='extend'>";
echo "
<form method='POST' action='index.php'>
    <button type='submit' class='login'  name='loginSubmit'>Lista Zwykla</button>
</form>";

echo "</section>";
