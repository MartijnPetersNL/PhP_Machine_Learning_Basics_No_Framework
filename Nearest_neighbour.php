<?php
// Hieronder een voorbeeld van kmain Nearest Neighbour classificatie in PHP-ML:
declare(strict_types=1);
require_once __DIR__ . '/vendor/autoload.php';
use Phpml\Classification\KNearestNeighbors;
use Phpml\Dataset\ArrayDataset;
use Phpml\CrossValidation\RandomSplit;
// Voorbeeld data
$samples = [
    [1, 2],
    [2, 3],
    [3, 4],
    [5, 6],
    [6, 7],
    [7, 8],
    [8, 9],
    [9, 10],
    [10, 11],
];
$targets = [
    'A',
    'A',
    'A',
    'B',
    'B',
    'B',
    'C',
    'C',
    'C',
];
// Maak een dataset aan
$dataset = new ArrayDataset($samples, $targets);
// Splits de dataset in training en test sets
$split = new RandomSplit($dataset, 0.2, 42);
// Maak een KNearestNeighbors classifier aan
$classifier = new KNearestNeighbors();
// Train de classifier met de training set
$classifier->train($split->getTrainSamples(), $split->getTrainLabels());
// Voorspel de labels voor de test set
$predicted = $classifier->predict($split->getTestSamples());
// Print de voorspelde labels
foreach ($predicted as $index => $label) {
    echo "Sample {$index}: Predicted label is {$label}\n";
}
// Maak een voorspelling voor een nieuwe sample
$newSample = [4, 5];
$predictedLabel = $classifier->predict($newSample);
echo "Predicted label for new sample [4, 5]: {$predictedLabel}\n";
// Output:
// Sample 0: Predicted label is A

// plot de voorspelde labels
// Deze stap is optioneel en vereist een grafiekbibliotheek zoals pChart of Matplotlib