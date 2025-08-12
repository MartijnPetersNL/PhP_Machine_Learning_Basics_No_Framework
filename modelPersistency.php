<?php
// de term Model Persistency betekent dat je een model kunt opslaan en later weer kunt laden om het te gebruiken zonder dat je het opnieuw hoeft te trainen.
// Dit is handig als je een model hebt getraind en je wilt het later opnieuw gebruiken
declare(strict_types=1); // declareer strict types om typefouten te voorkomen

require_once __DIR__ . '/vendor/autoload.php';

// Loading the data
$data = new \Phpml\Dataset\CsvDataset(
    filepath: './data/iris.csv',
    features: 4,
    headingRow: true
);
$dataset = new \Phpml\CrossValidation\RandomSplit($data, seed: 42);
// Training 
$classifier = new \Phpml\Classification\KNearestNeighbors(k: 3);
$classifier->train($dataset->getTrainSamples(), $dataset->getTrainLabels());

$modelManager = new \Phpml\ModelManager();
// $modelManager->saveToFile($classifier, 'models/iris_classifier.model');
$modelManager->restoreFromFile('models/iris_classifier.model');
$predicted = $classifier->predict($dataset->getTestSamples());

$accuracy = \Phpml\Metric\Accuracy::score($dataset->getTestLabels(), $predicted);
echo "Accuracy based on dataset : " . $accuracy . PHP_EOL;