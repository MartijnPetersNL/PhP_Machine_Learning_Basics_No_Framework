<?php
declare(strict_types=1); // declareer strict types om typefouten te voorkomen
// een van de meest voorkomende unsupervised learning doeleinden is clusteren
// Clustering is een unsupervised learning techniek die wordt gebruikt om gegevens te groeperen op basis van overeenkomsten.
// Het doel is om groepen te identificeren in de gegevens zonder vooraf gedefinieerde labels

// het model k-means clustering is een populaire unsupervised learning techniek
// die wordt gebruikt om gegevens te groeperen in k clusters op basis van de afstand tussen de gegevenspunten.

require_once __DIR__ . '/vendor/autoload.php';

$data = new \Phpml\Dataset\CsvDataset(filepath: './data/iris.csv', features: 4, headingRow: true);
$clustering = new \Phpml\Clustering\KMeans(3); // let op k moet kleine letter zijn
$clusters = $clustering->cluster($data->getSamples());

$file = fopen('./data/clusters.csv', 'w');
foreach ($clusters as $key =>$cluster) {
    foreach ($cluster as $data) {
        
        $dataToWrite = [...$data,$key];
        fputcsv($file,$dataToWrite);
    }
}

fclose($file);

var_dump($clusters); // dit geeft de clusters weer die zijn gevonden in de gegevens


