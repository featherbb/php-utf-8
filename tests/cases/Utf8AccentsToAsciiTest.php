<?php

require_once dirname(__FILE__).'/../bootstrap.php';
require_once UTF8.'/utils/ascii.php';


class Utf8AccentsToAsciiTest extends PHPUnit_Framework_TestCase
{
	public function test_empty_str()
	{
		$this->assertEquals('', utf8_accents_to_ascii(''));
	}

	public function test_lowercase()
	{
		$str = 'ô';
		$this->assertEquals('o', utf8_accents_to_ascii($str, 'lower'));
	}

	public function test_uppercase()
	{
		$str = 'Ô';
		$this->assertEquals('O', utf8_accents_to_ascii($str, 'upper'));
	}

	public function test_both()
	{
		$str = 'ôÔ';
		$this->assertEquals('oO', utf8_accents_to_ascii($str, 'both'));
	}
}
