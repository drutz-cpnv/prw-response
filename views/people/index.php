<?php

/** @var array $people */
require 'people.php';

?>

<ul>
	<?php foreach ($people as $person): ?>
		<li><?= $person['name'] ?></li>
	<?php endforeach; ?>
</ul>
