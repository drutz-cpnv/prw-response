<?php

/**
 * in_array function for multiple searched values
 * @param array $needles
 * @param array $haystack
 * @return bool
 */
function one_or_more_in_array(array $needles, array $haystack): bool
{
	return count(array_intersect($haystack, $needles)) > 0;
}