<?php

/** @var array $context */
/** @var array $cities */
require 'cities.php';

function getGoogleMapsUrl($long, $lat): string
{
	return "https://www.google.com/maps/@{$long},$lat?entry=ttu";
}

$city = $cities[$context['zip']];

if(in_array('application/geo-point', $context['headers']['accept'])) {
	header("Location: ".getGoogleMapsUrl($city['geo'][0], $city['geo'][1]));
	exit();
}

?>

<h1><?= $city['name'] ?></h1>
