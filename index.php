<?php

$loader = require_once __DIR__ . '/vendor/autoload.php';

//1. Load App
$app = new \App\App();

//2. receive parameters
$boardingCardsNumbers = isset($argv[1]) ? $argv[1] : null;

//3. pass parameters to App
$results = $app->printTrip($boardingCardsNumbers);

//4. print results
echo $results;
