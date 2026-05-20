<?php

declare(strict_types=1);

date_default_timezone_set('Indian/Mauritius');

$envDate = getenv('NEXT_BEER');
$now = time();

$beerTimestamp = $envDate ? strtotime($envDate) : null;
$today = date('Y-m-d', $now);

$day = date('j', $beerTimestamp);
$month = date('F', $beerTimestamp);

if (!in_array($day % 100, [11,12,13])) {
    switch ($day % 10) {
        case 1: $suffix = 'st';
        case 2: $suffix = 'nd';
        case 3: $suffix = 'rd';
        default: $suffix = 'th';
    }
}

if (!$beerTimestamp) {
    $message = "There are no beers planned!";
    $showCountdown = false;
} elseif (date('Y-m-d', $beerTimestamp) === $today) {
    $message = "There is a beer meetup today!";
    $showCountdown = false;
} elseif ($now < $beerTimestamp) {
    $message = "The next beer meetup is scheduled for the {$day}{$suffix} of {$month} ";
    $showCountdown = true;
} else {
    $message = "There are no beers planned!";
    $showCountdown = false;
}

header('Content-Type: text/html; charset=UTF-8');

include 'views/index.html.php';
