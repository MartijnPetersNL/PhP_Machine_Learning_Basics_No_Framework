<?php
use Phpml\Preprocessing\Normalizer;
// Een normalizer is een klasse die wordt gebruikt om gegevens te normaliseren,
//  zodat ze binnen een bepaald bereik vallen, meestal tussen 0 en 1 of -1 en 1.
//  Normalisatie is een veelgebruikte techniek in machine learning om ervoor te zorgen dat verschillende kenmerken vergelijkbare schalen hebben,
//  wat de prestaties van sommige algoritmen kan verbeteren.

// Hieronder een voorbeeld van het gebruik van de Normalizer klasse met L-2 norm in PHP-ML:
$samples = [
    [1, -1, 2],
    [2, 0, 0],
    [0, 1, -1],
];

$normalizer = new Normalizer();
$normalizer->preprocess($samples);
foreach ($samples as $sample) {
    echo implode(', ', $sample) . PHP_EOL;
}

// Hieronder een voorbeeld van het gebruik van de Normalizer klasse met L-1 norm in PHP-ML:

// use Phpml\Preprocessing\Normalizer;

$samples = [
    [1, -1, 2],
    [2, 0, 0],
    [0, 1, -1],
];

$normalizer = new Normalizer(Normalizer::NORM_L1);
$normalizer->preprocess($samples);
