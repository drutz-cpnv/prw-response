<?php
/** @var array $context */
/** @var array $people */
require 'people.php';

$person = $people[$context['id']];

if(one_or_more_in_array(['image/jpg', 'image/jpeg', 'image/*'], $context['headers']['accept'])) {
	$filename = "./images/{$person['image']}";
	$fp = fopen($filename, 'rb');
	header("Content-Type: image/jpg");
	header("Content-Length: " . filesize($filename));
	fpassthru($fp);
	exit();
}

?>

<h1><?= $person['name'] ?></h1>
<img src="<?= $_SERVER['REQUEST_URI'] ?>">

