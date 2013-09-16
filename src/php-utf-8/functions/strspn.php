<?php

namespace utf8;

/**
 * UTF-8 aware alternative to strspn.
 *
 * Find length of initial segment matching mask.
 *
 * @package    php-utf8
 * @subpackage functions
 * @see        http://www.php.net/strspn
 * @uses       utf8_strlen
 * @uses       utf8_substr
 *
 * @param string $str
 * @param string $mask
 * @param int    $start
 * @param int    $length
 *
 * @return int
 */
function span ($str, $mask, $start = NULL, $length = NULL)
{
	$mask = preg_replace('!([\\\\\\-\\]\\[/^])!', '\\\${1}', $mask);

	if ($start !== NULL || $length !== NULL)
	{
		$str = sub($str, $start, $length);
	}

	preg_match('/^[' . $mask . ']+/u', $str, $matches);

	if (isset($matches[0]))
	{
		return len($matches[0]);
	}
	return 0;
}
