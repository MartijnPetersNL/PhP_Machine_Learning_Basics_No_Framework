<?php
// Classificatie is voor het voorspellen van categorieën, zoals spam of niet-spam, terwijl regressie voor het voorspellen van continue waarden is, zoals prijzen of temperaturen.
// In deze demo wordt een K-Nearest Neighbors (KNN) classificatie gebruikt om te voorspellen of een e-mail spam is of niet.
declare(strict_types=1); // declareer strict types om typefouten te voorkomen
require_once __DIR__ . '/vendor/autoload.php';

$data = new \Phpml\Dataset\CsvDataset(filepath: './data/iris.csv', features: 4, headingRow: true);
$dataset = new \Phpml\CrossValidation\StratifiedRandomSplit($data, testSize: 0.2);

// Training
$classifcication = new \Phpml\Classification\KNearestNeighbors(k: 3); // let op k moet kleine letter zijn
$classifcication->train($dataset->getTrainSamples(), $dataset->getTrainLabels());

$predicted = $classifcication->predict($dataset->getTestSamples());

// Accuracy
$accuracy = \Phpml\Metric\Accuracy::score($dataset->getTestLabels(), $predicted);
echo "Accuracy based on dataset : " . $accuracy . PHP_EOL;
