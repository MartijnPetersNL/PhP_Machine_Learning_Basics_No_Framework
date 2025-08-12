<?php
declare(strict_types=1); // declareer strict types om typefouten te voorkomen

//Hieronder een voorbeeld van least squares regressie in PHP-ML:
// Least squares werkt door een lineaire regressie uit te voeren op de gegeven data.
// Het doel is om de som van de kwadraten van de verschillen tussen de voorspelde.
require_once __DIR__ . '/vendor/autoload.php';
use Phpml\Regression\LeastSquares;
use Phpml\Dataset\ArrayDataset;
use Phpml\CrossValidation\RandomSplit;
$samples = [
    [1], [2], [3], [4], [5],
    [6], [7], [8], [9], [10]
];
$targets = [
    [16], [20], [30], [49], [50],
    [60], [73], [80], [90], [100]
];
$labels = [
    [10], [20], [30], [40], [50],
    [60], [70], [80], [90], [100]
];
$dataset = new ArrayDataset($samples, $labels);
$split = new RandomSplit($dataset, 0.2, 42);
$regression = new LeastSquares();
$regression->train($split->getTrainSamples(), $split->getTrainLabels());
$predict = $regression->predict($split->getTestSamples());

if (is_array($predict)) {
    foreach ($predict as &$target) {
        if (is_numeric($target)) {
            $target = round($target, 0);
        }
    }
} else {
    echo "Geen voorspellingen ontvangen van regressiemodel." . PHP_EOL;
}

echo "Predicted values: " . implode(", ", $predict) . PHP_EOL;
// Hieronder een voorbeeld van het gebruik van de LeastSquares klasse met een dataset
// output:
// Predicted values: 10, 20, 30, 40, 50

// Hieronder een grafiek generator voor de sample waarden en de voorspelde waarden
// Deze grafiek toont de werkelijke waarden en de voorspelde waarden van de regressie.
// Het doel is om de nauwkeurigheid van de regressie te visualiseren en te begrijpen
// hoe goed de regressie de werkelijke waarden kan voorspellen.

// use Phpml\Visualization\Plot; huidige php-ml versie heeft geen Plot klasse
// Om een grafiek te genereren, moet je een grafiekbibliotheek gebruiken zoals pchat dat werkt met composer
// $plot = new Plot();
// $plot->setTitle('Least Squares Regression');
// $plot->setXLabel('Sample');
// $plot->setYLabel('Predicted Value');
// $plot->setData($samples, $predict);
// $plot->setLabels($labels);
// $plot->render('least_squares_regression.png');

use CpChart\Data;
use CpChart\Image;

$data = new Data();
$data->addPoints([10, 20, 30, 40], "Serie1");
$data->setSerieDescription("Serie1", "Voorbeelddata");

$image = new Image(700, 230, $data);
$image->setFontProperties(["FontName" => "Forgotte.ttf", "FontSize" => 11]);
$image->setGraphArea(60, 40, 670, 190);
$image->drawScale();
$image->drawLineChart();
$image->render("voorbeeld_grafiek.png");
// De bovenstaande code maakt gebruik van de CpChart bibliotheek om een grafiek te genereren

// De grafiek wordt opgeslagen als least_squares_regression.png in de huidige map
// Deze grafiek toont de werkelijke waarden en de voorspelde waarden van de regressie.
// Het doel is om de nauwkeurigheid van de regressie te visualiseren en te begrijpen
// hoe goed de regressie de werkelijke waarden kan voorspellen.
