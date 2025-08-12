<?php
// samples context: Suppose that you went out and asked 4 couples (2 married and 2 divorced) to respond to 3 features - 
// their partner's communication skills (between 1 and 5), attractiveness (between 1 and 5), and time spent together per week 
// (hours per week). You would structure the data in PHP like in the example below. You'll notice that the samples are represented 
// in a 2-d array (or matrix) and the labels are represented as a 1-d array.
$samples = [
    [3, 4, 50.5],
    [1, 5, 24.7],
    [4, 4, 62.0],
    [3, 2, 31.1],
];

$labels = ['married', 'divorced', 'married', 'divorced'];

use Rubix\ML\Datasets\Labeled;

$dataset = new Labeled($samples, $labels);

use Rubix\ML\Classifiers\KNearestNeighbors;

$estimator = new KNearestNeighbors(3);
$estimator->train($dataset);
var_dump($estimator->trained()); // Output: Boolean: true

// nodig voor een CSV dataset extractie process:
// use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Extractors\CSV;
use Rubix\ML\Transformers\NumericStringConverter;

$datasetCSV = Labeled::fromIterator(new CSV('example.csv', true))
    ->apply(new NumericStringConverter());

var_dump($datasetCSV->samples()); // Output: Array of samples from the CSV file
echo $datasetCSV->numSamples(); // Output: Number of samples in the dataset

// NDJSON voorbeeld:
use Rubix\ML\Extractors\NDJSON;
use Rubix\ML\Datasets\Unlabeled;
use LimitIterator;

$extractor = new NDJSON('example.ndjson');

$iterator = new LimitIterator($extractor->getIterator(), 0, 1000);

$datasetNDJSON = Unlabeled::fromIterator($iterator)
    ->apply(new NumericStringConverter());

// inhoud voorbeeld example.ndjson:
// {"attitude":"nice","texture":"furry","sociability":"friendly","rating":4,"class":"not monster"}
// {"attitude":"mean","texture":"furry","sociability":"loner","rating":-1.5,"class":"monster"}
// {"attitude":"nice","texture":"rough","sociability":"friendly","rating":2.6,"class":"not monster"}

var_dump($datasetNDJSON->samples()); // Output: Array of samples from the NDJSON file
echo $datasetNDJSON->numSamples(); // Output: Number of samples in the dataset
