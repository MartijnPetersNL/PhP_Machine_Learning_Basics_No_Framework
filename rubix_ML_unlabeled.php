<?php
use Rubix\ML\Datasets\Unlabeled;

$samples = [
    [4, 3, 44.2],
    [2, 2, 16.7],
    [2, 4, 19.5],
    [3, 3, 55.0],
];

$dataset = new Unlabeled($samples);

$predictions = $estimator->predict($dataset);

print_r($predictions); // Output: Array ( [0] => married [1] => divorced [2] => divorced [3] => married )

use Rubix\ML\CrossValidation\HoldOut;

$validator = new HoldOut(0.2); // 20% of the data will be used for testing, 80% for training
$results = $validator->evaluate($estimator, $dataset);

use Rubix\ML\Datasets\Labeled;
use Rubix\ML\CrossValidation\Metrics\Accuracy;

$dataset = new Labeled($samples, $labels);

$score = $validator->test($estimator, $dataset, new Accuracy());

echo $score;