<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Super Vector Regressor</h1>
    <p>De Super Vector Regressor is een krachtige regressiemethode die gebruik maakt van Support Vector Machines (SVM).</p>
</body>


</html>
<?php
// Super vector constructor parameters voor php-ml


/**
 * SuperVectorRegressor constructor parameters
 * @param int $kernel (default Kernel::RBF)
 * @param float $cost (default 1.0)
 * @param int $degree (default 3)
 * @param float $gamma (default 1/features)
 * @param float $coef0 (default 0.0)
 * @param float $tolerance (default 0.001)
 * @param int $cacheSize (default 100)
 * @param bool $shrinking (default true)
 * @param bool $probabilityEstimates (default false)
 */

 // Trainen met Super Vector Regressor
 use Phpml\Classification\SVC;
use Phpml\SupportVectorMachine\Kernel;

$samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
$labels = ['a', 'a', 'a', 'b', 'b', 'b'];

$classifier = new SVC(Kernel::LINEAR, $cost = 1000);
$classifier->train($samples, $labels);

// Hoe meer data, hoe beter de voorspelling

//Voorspelen met Super Vector Regressor
$classifier->predict([3, 2]);
// return 'b'

$classifier->predict([[3, 2], [1, 5]]);
// return ['b', 'a']

// Waarschijnlijkheidsschatting:

// use Phpml\Classification\SVC;
// use Phpml\SupportVectorMachine\Kernel;

$samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
$labels = ['a', 'a', 'a', 'b', 'b', 'b'];

$classifier = new SVC(
    Kernel::LINEAR, // $kernel
    1.0,            // $cost
    3,              // $degree
    null,           // $gamma
    0.0,            // $coef0
    0.001,          // $tolerance
    100,            // $cacheSize
    true,           // $shrinking
    true            // $probabilityEstimates, set to true
);

$classifier->train($samples, $labels);
// Then use predictProbability method instead of predict:

$classifier->predictProbability([3, 2]);
// return ['a' => 0.349833, 'b' => 0.650167]

$classifier->predictProbability([[3, 2], [1, 5]]);
// return [
//   ['a' => 0.349833, 'b' => 0.650167],
//   ['a' => 0.922664, 'b' => 0.0773364],
// ]