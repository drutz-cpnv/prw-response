<?php

/** @var array $cities */
require 'cities.php';

?>

<ul>
	<?php foreach ($cities as $city): ?>
		<li><?= $city['name'] ?></li>
	<?php endforeach; ?>
</ul>
