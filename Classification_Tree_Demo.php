<?php
declare(strict_types=1); // declareer strict types om typefouten te voorkomen
require 'vendor/autoload.php';
use Rubix\ML\Classifiers\ClassificationTree;
use Rubix\ML\Datasets\Labeled;
ob_start(); // ob_start() om output buffering te starten
// 2D-samples en bijbehorende labels
$samples = [];
$labels = [];

// Genereer 40 willekeurige datapunten
for ($i = 0; $i < 40; $i++) {
    // lengte tussen 1.50 en 2.00 meter
    $height = mt_rand(150, 200) / 100;

    // gewicht tussen 40 en 120 kg
    $weight = mt_rand(40, 120);

    $samples[] = [$height, $weight];

    // BMI-formule
    $bmi = $weight / ($height * $height);

    // Label op basis van BMI
    $labels[] = $bmi < 18.5 ? 'ondergewicht' : 'overgewicht';
}

// Bouw een gelabelde dataset
$dataset = Labeled::quick($samples, $labels);

// Initialiseer de Decision Tree
// Parameter 0.1 = minimumeuze gain, 3 = maximale boomdiepte
$estimator = new ClassificationTree(0.1, 3);

// Train het model
$estimator->train($dataset);

// Maak voorspellingen op de trainingsset
$predictions = $estimator->predict($dataset);

// Toon enkele resultaten
echo "Voorbeeld voorspellingen (first 10 van 30):\n";
for ($i = 0; $i < 10; $i++) {
    list($h, $w) = $samples[$i];
    $pred = $predictions[$i];
    $true = $labels[$i];
    echo sprintf(
        "Datapunt #%d — Lengte: %.2f m, Gewicht: %d kg → voorspeld: %s (werkelijk: %s)\n",
        $i + 1,
        $h,
        $w,
        $pred,
        $true
    );
}
echo "\n\n";
// Toon de boomstructuur
$tree = $estimator->tree();
echo $tree;

// Toon de accuratie van categorisatie
$accuracy = $estimator->score($dataset);
echo sprintf("Accuratie van het model: %.2f%%\n", $accuracy * 100);
// Stop output buffering en toon de inhoud
$output = ob_get_clean();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Classification Tree Demo</title>
</head>
<body>
    <nav class="navbar-top">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="daTools.php">DA tools</a></li>
            <li><a href="mlClassification.php">ML Classification</a></li>
            <li><a href="unsupervisedLearning.php">Unsupervised Learning</a></li>
            <li><a href="modelPersistency.php">Model Persistency</a></li>
        </ul>
    </nav>
    <main>
           <pre><?= htmlspecialchars($output) ?></pre>
   <h1>Classification Tree Demo with validation</h1>
   <p> When do is a classification tree needed in machine learning?</p>
   <p> A classification tree is used when you need to classify data into distinct categories based on input features. </p>
   <p>It is particularly useful for problems where the output variable is categorical, such as determining whether an email is spam or not, or predicting whether a patient has a certain disease based on medical test results.</p>
    </main> 
    <footer>
       <p> Copyleft license: This work is licensed under the Creative Commons Attribution-ShareAlike 4.0 International License.</p>
</footer>
</body>
</html>

