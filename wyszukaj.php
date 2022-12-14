<?php
if (isset($_POST['submit'])){
    $tytul = $_POST['name'];
    $gatunek = $_POST['mail'];
    echo $tytul;

    if (!empty($tytul)){
        $filter = ['tytul' => $tytul];
        $options = [
        ];
    } elseif (!empty($tytul)&& !empty($gatunek)){
        $filter = ['gatunek' => $gatunek,'tytul' => $tytul];
        $options = [
        ];
    }
    else {
        $filter = [];
        $options = [
        ];

    }
    try {

        $db = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        $zapytanie = new MongoDB\Driver\Query($filter,$options);
        $wiersze = $db->executeQuery("rent.filmy",$zapytanie);

echo "      <table style='border:1px solid red border-collapse:collapse' border='1px'>
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
    <tbody>";
        foreach($wiersze as $wiersz){
            echo "<tr>";
            echo  nl2br("<td>$wiersz->_id</td> <td>$wiersz->tytul</td> <td>$wiersz->gatunek </td><td>$wiersz->rezyser </td><td>$wiersz->czastrwania </td><td>$wiersz->status </td> \n");
            echo "</tr>";
        }

    }
    catch(Exception $e) {
        print($e->getMessage());
    }
}
?>
<form method='POST' action='index.php'>
    <button type='submit' class='login'  name='loginSubmit'>cofnij</button>
</form>






