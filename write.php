<?php

$db3 = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$filter = [];
$options = ['sort' => array('_id' => -1), 'limit' => 1];

$zapytanie3 = new MongoDB\Driver\Query($filter, $options);
$wiersze3 = $db3->executeQuery("rent.klienci", $zapytanie3);
$id_lowest = 0;
foreach ($wiersze3 as $document) :

    $id_lowest=$document->_id;
endforeach;
echo "<br>";
$ajdi = $_POST['idklienta'];
$imie = $_POST['imie'];
$nazwisko = $_POST['nazwisko'];
$adres = $_POST['adres'];
$telefon = $_POST['telefon'];
$datarejestracji = date("Y/m/d");

//echo "ID =  ";
//echo $ajdi;
//echo "<br><br>";



$option='xd';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Dodaj'])) {
        $option='insert';
        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => true]);
        $bulk->$option(['_id'=> $id_lowest+1,'imie' => $imie, 'nazwisko' => $nazwisko, 'adres' => $adres, 'telefon' => $telefon, 'datarejestracji' => $datarejestracji]);

    } if (isset($_POST['Edytuj'])) {
        $option='update';
        // wybrać id -> zmatchować dane z id i ustawic po #option ...

        echo "ID w ifie =  ";
        echo $ajdi;
        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => false]);
        $bulk->$option(
            ['imie' =>$imie, 'nazwisko'=>$nazwisko],
            ['$set' => ['imie' => $imie]]);

    }if (isset($_POST['Usun'])) {
        $option='delete';

        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => true]);
        $bulk->$option(['imie' => $imie, 'nazwisko' => $nazwisko, 'adres' => $adres, 'telefon' => $telefon,]);
    }
}
//echo '<br>';
//echo $option;
//echo '<br>';

$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

try {
    $result = $manager->executeBulkWrite('rent.klienci', $bulk, $writeConcern);
} catch (MongoDB\Driver\Exception\BulkWriteException $e) {
    $result = $e->getWriteResult();

    // Check if the write concern could not be fulfilled
    if ($writeConcernError = $result->getWriteConcernError()) {
        printf("%s (%d): %s\n",
            $writeConcernError->getMessage(),
            $writeConcernError->getCode(),
            var_export($writeConcernError->getInfo(), true)
        );
    }

    // Check if any write operations did not complete at all
    foreach ($result->getWriteErrors() as $writeError) {
        printf("Operation#%d: %s (%d)\n",
            $writeError->getIndex(),
            $writeError->getMessage(),
            $writeError->getCode()
        );
    }
} catch (MongoDB\Driver\Exception\Exception $e) {
    printf("Other error: %s\n", $e->getMessage());
    exit;
}
printf("Inserted %d document(s)\n", $result->getInsertedCount());
printf("Updated  %d document(s)\n", $result->getModifiedCount());

echo "
<form method='POST' action='dodaj.php'>
    <button type='submit' class='login'  name='loginSubmit'>powrot</button>
</form>";

?>