<?php

use Timely\Tools as Timely;

class ToolsTest extends PHPUnit_Framework_TestCase {

	public function testConstructorSetsTime()
	{
		$datetime = new DateTime('1984-11-12 23:59:00');
		$timely = new Timely( $datetime );

		$expected = $timely->time();

		$this->assertInstanceOf('DateTime', $expected);
		$this->assertEquals('1984-11-12 23:59:00', $expected->format('Y-m-d H:i:s'));
	}

	public function testGetSet()
	{
		$datetime = new DateTime('1984-11-12 23:59:00');
		$timely = new Timely;

		$timely->time($datetime);

		$expected = $timely->time();

		$this->assertInstanceOf('DateTime', $expected);
		$this->assertEquals('1984-11-12 23:59:00', $expected->format('Y-m-d H:i:s'));
	}

	// public function testToUtc()
	// {

	// }

	// public function testToTimezone()
	// {

	// }

	// public function testUtcOffset()
	// {

	// }

	// public function testGmtOffset()
	// {

	// }

}