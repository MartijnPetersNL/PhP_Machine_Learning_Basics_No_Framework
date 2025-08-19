<?php
// this scripts loads in php files from the src folder and displays them in the browser
// Onderdeel van cursus: http://wccoding.wordpress.com/2024/12/06/the-complete-guide-to-building-a-machine-learning-pipeline-in-php-from-code-to-deployment/
declare(strict_types=1); // declareer strict types om typefouten te voorkomen
require_once __DIR__ . '/vendor/autoload.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
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
    <div class="intro-div">
        <img src="images/welcome-text.gif" alt="welcome animated text" class="animation">
        <h1>Welcome to the php_ML Project</h1>
        <p>The php_ML project is a machine learning library for PHP. It aims to provide a simple and efficient way to implement machine learning algorithms in PHP applications.</p>
        <p>Explore the project by navigating through the links above.</p>
    </div>
    <div class="content-div">
        <h2>Project Features</h2>
        <ul>
            <li>Support for various machine learning algorithms</li>
            <li>Easy integration with existing PHP applications</li>
            <li>Comprehensive documentation and examples</li>
            <li>Copyleft licence: This work is licensed under the Creative Commons Attribution-ShareAlike 4.0 International License.</li>
        </ul>
        <p>Whether you are a beginner or an experienced developer, the php_ML project provides the tools you need to get started with machine learning in PHP.</p>
    </div>
    <h2> Hoe NASA machine learning gebruikt </h2>
        <p>Machine learning helpt NASA om grote hoeveelheden data te verwerken en patronen te herkennen die anders moeilijk te detecteren zouden zijn.</p>
        <br/>
    <p>Nasa gebruikt machine learning voor verschillende toepassingen, zoals het analyseren van satellietbeelden, 
        het optimaliseren van vluchtplannen en het verbeteren van de communicatie tussen ruimtevaartuigen.</p>
    <p> Bronnen:</p>
        <p>Hieronder staan enkele bronnen waar je meer kunt leren over hoe NASA machine learning
        <ul>
            <li><a href="https://ml.jpl.nasa.gov/">NASA Machine Learning index pagina</a></li>
            <li><a href="https://www.nasa.gov/mission_pages/tdm/tdm.html">NASA TDM</a></li>
            <li><a href="https://www.nasa.gov/feature/nasa-s-machine-learning-journey">NASA's Machine Learning Journey</a></li>
            <li><a href="https://www.thespreadsheetguru.com/sample-data/">Voorbeeld datasets in CSV formaat</a></li>
        </ul>
    <p> PHP-ML demo 1: leastsquare regression toegepast op een dataset van verzekeringsclaims.</p>
    <p> de dataset is een json bestand met 2 kolommen van X en Y waarden zoals: 108,392.5</p>
    <p> de r2score is een maat voor de nauwkeurigheid van de regressie, hoe dichter bij 1 hoe beter.</p>
    <img src="images/php-ml-meme.png" alt="php machine learning meme" class="main-image">
    <?php
    require "vendor/autoload.php";
// Hierdoor een php functie die geinstalleerde composer packages op hun naam weergeeft in een lijst
function getComposerPackages() {
    $composerFile = __DIR__ . '/composer.json';
    if (file_exists($composerFile)) {
        $composerData = json_decode(file_get_contents($composerFile), true);
        return array_keys($composerData['require']);
    }
    return [];
}
getComposerPackages();
use Phpml\Dataset\CsvDataset;
// loading data
$inputdata = new CsvDataset(
    // parameter filepath moet een string zijn, de rest kan een integer zijn
    filepath: "./data/insurance.csv",
    features: 1,
    headingRow: true
);
//loading data for super vector regressor

 $inputdatawine = new CsvDataset('./data/insurance.csv', 1, true);

// preprocessing data
$dataset = new \Phpml\CrossValidation\RandomSplit($inputdata, seed: 156);
$datasetwine = new \Phpml\CrossValidation\StratifiedRandomSplit($inputdatawine, seed:156);
// $dataset->getTrainSamples();
// $dataset->getTrainLabels();
// $dataset->getTestSamples();
// $dataset->getTestLabels();
// Training and evaluatng machione learning models
// Algorithm: linear regression
// $regression = new \Phpml\Regression\LeastSquares();
//Training voor Super vector regressor
$regression = new \Phpml\Regression\LeastSquares();
$regressionwine = new \Phpml\Regression\LeastSquares();
$regression->train($dataset->getTrainSamples(),$dataset->getTrainLabels());
$predict = $regression->predict($dataset->getTestSamples());
// Evaluation maching learning model
$score = \Phpml\Metric\Regression::r2Score($dataset->getTestLabels(),$predict);
echo "r2score is :" . $score . PHP_EOL;

foreach ($predict as &$target) {
    $target = round($target, precision:0);
}
$accyracyscore = \Phpml\Metric\Accuracy::score($dataset->getTestLabels(), $predict);
echo "<p class='score'>r2score is :" . $accyracyscore . "</p>";
var_dump($regression->predict([80])); // 80 not part of dataset
// run program with php index.php
// Making predictions with trained models

// pHP 8 Heeft de nieuwe funcrtie genoemde argumenten, dit maakt het makkelijker om functies te schrijven met veel parameters.
// hieronder een voorbeeld van een functie met named arguments
echo "<p>De functie is aangeroepen met named arguments: exampleFunction: ";
// dit maakt het makkelijker om functies te schrijven met veel parameters, omdat je dan niet meer hoeft to onthouden welke parameter welke waarde heeft.
// je kunt de parameters in willekeurige volgorde doorgeven, zolang je maar de naam van de parameter opgeeft.
function exampleFunction(string $name, int $age, string $city) {
    echo "Name: $name, Age: $age, City: $city";
}
exampleFunction(
    name: "John Doe",
    age: 30,
    city: "New York"
);

// dit heeft ook voordelen wanneer je in een team werkt, omdat je dan niet meer hoeft te onthouden welke parameter welke waarde heeft.
// dit maakt de code leesbaarder en makkelijker te onderhouden.
    ?>
<div class="shortcuttiles-container">
<button class="shortcuttiles" onclick="location.href='animations_infographics.php'">
    <p>Getting started with PHP visual tutorials intermediate</p>
</button>
<button class="shortcuttiles" onclick="location.href='getting_started.php'">
    <p>Getting started with PHP-ML<a href="getting_started.php">learn the basics</a></p>
</button>
<button class="shortcuttiles" onclick="location.href='economy_of_scale.php'">
    <p>PHP-ML & economy of scale <a href="economy_of_scale.php">learn the basics EOS</a></p>
</button>
</div>
</main>
    <footer>
        <nav class="navbar-bottom">
            <ul>
                <li><a href="privacy.html">Privacy Policy</a></li>
                <li><a href="terms.html">Terms of Service</a></li>
                <li><a href="help.html">Help</a></li>
                <li><a href="ml_explained.php">Machine Learning Explained</a></li>
                <li><a href="Classification_Tree_Demo.php">Classification Tree Demo</a></li>
            </ul>
        </nav>
        <p>&copy; 2025 Your Website</p>
    </footer>
</body>
</html>
<?php
// Hieronder een voorbeeld van genoemde parameters toegepast op een php ml least squares regressie model.
// PHP-ML is een machine learning library voor PHP, die verschillende algoritmen en tools biedt voor het trainen en evalueren van machine learning modellen.
// Het is een open source project dat kan worden gebruikt voor verschillende toepassingen, zoals classificatie,

// PHP-ML accepteert de volgende soorten datasets:
// - ArrayDataset: een dataset die is opgebouwd uit arrays van samples en labels.
// - CsvDataset: een dataset die is opgebouwd uit een CSV-bestand met samples en labels
// CSV = komma-onderscheiden waarden, een veelgebruikt formaat voor het opslaan van tabulaire gegevens.
// - JsonDataset: een dataset die is opgebouwd uit een JSON-bestand met samples en labels.
// - LibsvmDataset: een dataset die is opgebouwd uit een LIBSVM-bestand met samples en labels.
// - FilesystemDataset: een dataset die is opgebouwd uit een bestandssysteem met samples en labels.
// - SVMDataset: een dataset die is opgebouwd uit een SVM-bestand met samples en labels.
// - TextDataset: een dataset die is opgebouwd uit een tekstbestand met samples en labels.
// hierboven staan de meest voorkomende soorten datasets die PHP-ML accepteert, maar en zijn en nog meer.

//om een PHP bestand in visualstudio code te openen, klik je op het bestand en druk je op F1
// of type in in powershell terminal: php -f bestandnaam.php

// Hieronder toepassingen van ander php 8 functionaliteiten:

// 1. Constructor property promotion: dit is een nieuwe syntaxis in PHP 8 waarmee je eigenschappen van een klasse kunt declareren en initialiseren in de constructor.
// Dit maakt de code korter en leesbaarder, omdat je niet meer expliciet de eigenschappen hoeft te declareren en initialiseren.
// Hieronder een voorbeeld van constructor property promotion:
class MyDataset
{
    public function __construct(
        public string $filepath = 'data.csv',
        public int $features = 4,
        public bool $headingRow = true
    ) {}
}

// 2. Match expression: dit is een nieuwe syntaxis in PHP 8 waarmee je een waarde kunt vergelijken met verschillende patronen en acties kunt uitvoeren op basis van de overeenkomsten.
// Dit maakt de code korter en leesbaarder, omdat je niet meer expliciet een switch statement hoeft te gebruiken.
// Hieronder een voorbeeld van een match expression:

echo match (true) {
    $score > 0.8 => "🔝 Excellent model",
    $score > 0.5 => "👍 Acceptabel model",
    default      => "⚠️ Needs improvement",
};

// 3. Nullsafe operator: dit is een nieuwe operator in PHP 8 waarmee je een methode of eigenschap kunt aanroepen op een object dat mogelijk null is, zonder een foutmelding te krijgen.
$trainData = $dataset?->getTrainSamples();
// Dit maakt de code korter en leesbaarder, omdat je niet meer expliciet hoeft te controleren of het object null is voordat je de methode of eigenschap aanroept.
// Hieronder een voorbeeld van de nullsafe operator:
$dataset = new \Phpml\CrossValidation\RandomSplit($inputdata, seed: 156);
$trainSamples = $dataset->getTrainSamples(); // Dit werkt

$csv = new CsvDataset('data.csv', 1, true);
// $csv->getTrainSamples(); // Dit geeft een fout!
//4. union types: dit is een nieuwe syntaxis in PHP 8 waarmee je meerdere typen kunt specificeren voor een parameter of een returnwaarde.
// Dit maakt de code flexibeler en leesbaarder, omdat je niet meer expliciet
// verschillende functies hoeft te schrijven voor verschillende typen.
function clean(array|object $input): array {
    // logic
}
