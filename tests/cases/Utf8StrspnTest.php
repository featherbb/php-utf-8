<?php

require_once dirname(__FILE__).'/../bootstrap.php';
require_once UTF8.'/functions/strspn.php';


class Utf8StrspnTest extends PHPUnit_Framework_TestCase
{
	public function test_match()
	{
		$str = 'iñtërnâtiônàlizætiøn';
		$this->assertEquals(11, utf8_strspn($str, 'âëiônñrt'));
	}

	public function test_match_two()
	{
		$str = 'iñtërnâtiônàlizætiøn';
		$this->assertEquals(4, utf8_strspn($str, 'iñtë'));
	}

	public function test_compare_strspn()
	{
		$str = 'aeioustr';
		$this->assertEquals(strspn($str, 'saeiou'), utf8_strspn($str, 'saeiou'));
	}

	public function test_match_ascii()
	{
		$str = 'internationalization';
		$this->assertEquals(strspn($str, 'aeionrt'), utf8_strspn($str, 'aeionrt'));
	}

	public function test_linefeed()
	{
		$str = "iñtërnât\niônàlizætiøn";
		$this->assertEquals(8, utf8_strspn($str, 'âëiônñrt'));
	}

	public function test_linefeed_mask()
	{
		$str = "iñtërnât\niônàlizætiøn";
		$this->assertEquals(12, utf8_strspn($str, "âëiônñrt\n"));
	}
}
