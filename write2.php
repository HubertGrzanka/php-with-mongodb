<?php

$db4 = new MongoDB\Driver\Manager("mongodb://localhost:27017");
$filter = [];
$options = ['sort' => array('_id' => -1), 'limit' => 1];

$zapytanie4 = new MongoDB\Driver\Query($filter, $options);
$wiersze4 = $db4->executeQuery("rent.filmy", $zapytanie4);
$id_lowest2 = 0;
foreach ($wiersze4 as $document) :

    $id_lowest2=$document->_id;
endforeach;
echo "<br>";
$idf = $_POST['idf'];
$tyt = $_POST['tytul'];
$gatunek = $_POST['gatunek'];
$rezyser = $_POST['rezyser'];
$czast = $_POST['czastrwania'];
$fabula= $_POST['fabula'];
$ocena= $_POST['ocena'];
$aktor1= $_POST['aktor1'];
$aktor2= $_POST['aktor2'];
$datadodania = date("Y/m/d");





if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['Dodajj'])) {
        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => true]);
        $bulk->insert(['_id'=> $id_lowest2+1,'tytul' => $tyt, 'rezyser' => $rezyser, 'gatunek' => $gatunek, 'czastrwania' => $czast, 'datadodania' => $datadodania, 'ocena' => $ocena, 'aktor1' => $aktor1, 'aktor2' => $aktor2]);

    } if (isset($_POST['Edytujj'])) {

        // wybrać id -> zmatchować dane z id i ustawic po #option ...



        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => false]);
        $bulk->update(
            ['_id' =>$idf],
            ['$set' => ['tytul' => $tyt, 'rezyser' => $rezyser, 'gatunek' => $gatunek, 'czastrwania' => $czast, 'datadodania' => $datadodania, 'ocena' => $ocena, 'aktor1' => $aktor1, 'aktor2' => $aktor2]]);

    }if (isset($_POST['Usunn'])) {
        $option='delete';

        $bulk = new MongoDB\Driver\BulkWrite(['ordered' => true]);
        $bulk->delete(['tytul' =>$tyt]);
    }
}
//echo '<br>';
//echo $option;
//echo '<br>';

$manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');
$writeConcern = new MongoDB\Driver\WriteConcern(MongoDB\Driver\WriteConcern::MAJORITY, 1000);

try {
    $result = $manager->executeBulkWrite('rent.filmy',$bulk, $writeConcern);
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
<form method='POST' action='szczegoly.php'>
    <button type='submit' class='login'  name='loginSubmit'>powrot</button>
</form>";

?>