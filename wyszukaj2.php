<section class="przyciuski">
<form method='POST' action='index.php'>
    <button type='submit' class='index'  name='wypozycz'>Lista Filmów</button>
</form>
<form method='POST' action='dodaj.php'>
    <button type='submit' class='dodaj'  name='dodaj'>Klienci</button>
</form>
</section>
<?php
if (isset($_POST['submit2'])) {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $idf = $_POST['idf'];
    $tytul = $_POST['tytul'];
    $data = $_POST['data'];


    if (!empty($imie)) {
        $filter = ['imie' => $imie];
        $options = [
        ];
    }   if(!empty($nazwisko)) {
    $filter = ['nazwisko' => $nazwisko];
    $options = [
    ];

}if(!empty($idf)) {
    $filter = ['idf' => $idf];
    $options = [
    ];

}if(!empty($tytul)) {
    $filter = ['tytul' => $tytul];
    $options = [
    ];

}if(!empty($data)) {
    $filter = ['datawypozyczenia' => $data];
    $options = [
    ];

}if(empty($data)&&empty($tytul)&&empty($idf)&&empty($nazwisko)&&empty($imie)) {
        $filter = [];
        $options = [
        ];
    }




    try {

        $db2 = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $zapytanie2 = new MongoDB\Driver\Query($filter,$options);
        $wiersze2 = $db2->executeQuery("rent.rents",$zapytanie2);

        echo "      <table style='border:1px solid red border-collapse:collapse' border='1px'>
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
    </tr>
    </thead>
    <tbody>";
        foreach($wiersze2 as $wiersz2){
            echo "<tr>";
            echo  nl2br("<td>$wiersz2->id_klient</td> <td>$wiersz2->imie</td> <td>$wiersz2->nazwisko </td><td>$wiersz2->adres </td><td>$wiersz2->datarejestracji </td><td>$wiersz2->tytul </td><td>$wiersz2->datawypozyczenia </td><td>$wiersz2->zwrotplanowany </td><td>$wiersz2->zwrot </td> \n");
            echo "</tr>";
        }

    }
    catch(Exception $e) {
        print($e->getMessage());
    }
}
?>
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
