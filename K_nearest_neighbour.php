<?php

require_once __DIR__ . '/vendor/autoload.php';

use Phpml\Classification\KNearestNeighbors;
use Phpml\Dataset\Demo\IrisDataset;

// Load the Iris dataset
$dataset = new IrisDataset();

// Create and train the classifier
$classifier = new KNearestNeighbors();
$classifier->train($dataset->getSamples(), $dataset->getTargets());

// Make a prediction
$unknownSample = [5.1, 3.5, 1.4, 0.2];
$predictedLabel = $classifier->predict($unknownSample);

echo "Predicted Iris species: $predictedLabel";

/*
In this example, we:

Load the Iris dataset, which is included in PHP-ML for demonstration purposes.
Create a K-Nearest Neighbors classifier.
Train the classifier using the dataset's samples (features) and targets (labels).
Make a prediction for a new, unknown sample.
Finally, we output the predicted label for the unknown sample.
*/

// Tweede classificatie voorbeeld:
    // require_once __DIR__ . '/vendor/autoload.php';

// use Phpml\Classification\KNearestNeighbors;

function autoload($className) {
    $file = __DIR__ . '/vendor/php-ai/php-ml/src/' . str_replace('\\', '/', $className) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
}
$samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
$labels = ['a', 'a', 'a', 'b', 'b', 'b'];

$classifier = new KNearestNeighbors();
$classifier->train($samples, $labels);

$classifier->predict([3, 2]);
// return 'b'
return $classifier->predict([3, 2]);

echo "Predicted label for [3, 2]: " . $classifier->predict([3, 2]) . PHP_EOL;