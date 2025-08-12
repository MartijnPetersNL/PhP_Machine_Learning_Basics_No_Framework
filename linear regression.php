<?php

class LinearRegressionTest
{
    public function test_can_regression_simple() {
        $data = [
            ['surface_area' => 1, 'price' => 10],
            ['surface_area' => 2, 'price' => 20],
            ['surface_area' => 3, 'price' => 30],
            ['surface_area' => 4, 'price' => 40],
            ['surface_area' => 5, 'price' => 50],
            ['surface_area' => 6, 'price' => 60],
            ['surface_area' => 7, 'price' => 70],
            ['surface_area' => 8, 'price' => 80],
            ['surface_area' => 9, 'price' => 90],
            ['surface_area' => 10, 'price' => 100],
        ];
    }
}
// Hieronder trainen we een lineaire regressie model met de data
// en maken we een voorspelling voor een oppervlakte van 11.
require_once __DIR__ . '/vendor/autoload.php';
use Phpml\Regression\LinearRegression;
use Phpml\Dataset\ArrayDataset;
use Phpml\CrossValidation\RandomSplit;
$samples = [
    [1], [2], [3], [4], [5],
    [6], [7], [8], [9], [10]
];
$labels = [
    [10], [20], [30], [40], [50],
    [60], [70], [80], [90], [100]
];
$dataset = new ArrayDataset($samples, $labels);
var_dump($dataset->getSamples()); // Output: array of samples
var_dump($dataset->getLabels()); // Output: array of labels
$split = new RandomSplit($dataset, 0.2, 42);
$regression = new LinearRegression();
$regression->train($split->getTrainSamples(), $split->getTrainLabels());
$predicted = $regression->predict($split->getTestSamples());
foreach ($predicted as &$target) {
    $target = round($target[0], 0);
}