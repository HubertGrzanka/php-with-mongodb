<?php
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









    // niepotrzebne
    $filter = ['ocena' => ['$gt' => 9]];
    $options = [
        'czastrwania' => 120,
    ];
    $query = new MongoDB\Driver\Query($filter, $options);

    $cursor = $db->executeQuery('rent.filmy', $query);
    foreach ($cursor as $document) {
        //  var_dump($document);
    }



    //$friends= $db->rent->filmy;
    //$result = $friends->find(array(), array('projection'=> array('_id'=>false)));
    //$data = iterator_to_array($result);


    //$wiersze = $zapytanie->find(array(), array('projection'=> array('_id'=>false)));

    //$u
    ?>





    <?php
    echo "<section class='zwykla'>";


    echo "
<form method='POST' action='index.php'>
    <button type='submit' class='login'  name='loginSubmit'>powrot</button>
</form>";

    echo "</section>";

    echo "<section class='sortgatunek'>";


    if (isset($_POST['select1'])) {
        $select1 = $_POST['select1'];
        switch ($select1) {
            case 'value1':
                echo 'value1<br/>';
                header("Location:http://localhost:63342/index.php/gatunek.php");
                exit;
                break;
            case 'value2':
                echo 'value2<br/>';
                header("Location:http://localhost:63342/index.php/tytul.php");
                exit;
                break;
            default:
                # code...
                break;
        }

    }
    ?>

    <form action="" method="post">
        Sortuj wg. <select name="select1">
            <option value="value1">Gatunek</option>
            <option value="value2">Tytul</option>
        </select>
        <input type="submit" name="submit" value="Go"/>
    </form>




































