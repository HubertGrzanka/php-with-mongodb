<?php

$db = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$zapytanie = new MongoDB\Driver\Query([]);
$wiersze = $db->executeQuery("rent.filmy",$zapytanie);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>ES</title>
</head>

<section class="listaw">
    <form method='POST' action='wypozycz.php'>
        <button type='submit' class='wypozycz'  name='wypozycz'>Lista Wypozyczen</button>
    </form>
    <form method='POST' action='dodaj.php'>
        <button type='submit' class='dodaj'  name='dodaj'>Klienci</button>
    </form>
</section>
    <!--                                         WYSWIETLANIE ALL                                          -->
<section class="standard">
    <div id="st1">
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
    ?>
    </div>
</section>
<?php






echo "<section class='zwykla'>";


    echo "
<form method='POST' action='szczegoly.php'>
    <button type='submit' class='login'  name='loginSubmit'>Szczegoły</button>
</form><br><br>

";

echo "</section>";

echo "<section class='sortgatunek'>";



    if (isset($_POST['select1'])) {
        $select1 = $_POST['select1'];
        switch ($select1) {
            case 'value1':
              header("Location:gatunek.php");
              //  header("Location:http://localhost:63342/index.php/gatunek.php");
                break;
            case 'value2':
          header("Location:tytul.php");
             //   header("Location:http://localhost:63342/index.php/tytul.php");
                break;
        }
    }
?>
</section>
    <!--                                            SORTOWANIE                                             -->
    <form action="" method="post">
       Sortuj wg. <select name="select1">
            <option value="value1">Gatunek</option>
            <option value="value2">Tytul</option>
        </select>
        <input type="submit" name="submit" value="Sortuj"/>
    </form><br><br>




    <!--                                            WYSZUKIWANIE                                             -->


    <section class="comment">
            <form method='POST' action='wyszukaj.php'>
                Tytul: <input type="text" name="name">

                Gatunek: <input type="text" name="mail">
                <button class="xd" type="submit" name="submit">Wyszukaj</button>
            </form><br><br>
    </section>

<!--                                       JAKAS FUMKCJA                                       -->

<?php
/*
function essa(){
    if (isset($_POST['submit'])){
        $tytul = $_POST['name'];
        $gatunek = $_POST['mail'];

        echo $tytul;
        try {



        }
        catch(Exception $e) {
            print($e->getMessage());
        }

    }
}
*/
?>







</html>



