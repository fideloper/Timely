<?php

use Timely\Tools as Timely;

class ToolsTest extends PHPUnit_Framework_TestCase {

	public function testConstructorSetsTime()
	{
		$datetime = new DateTime('1984-11-12 23:59:00');
		$timely = new Timely( $datetime );

		$expected = $timely->get();

		$this->assertInstanceOf('DateTime', $expected);
		$this->assertEquals('1984-11-12 23:59:00', $expected->format('Y-m-d H:i:s'));
	}

	public function testGetSet()
	{
		$datetime = new DateTime('1984-11-12 23:59:00');
		$timely = new Timely;

		$timely->set($datetime);

		$expected = $timely->get();

		$this->assertInstanceOf('DateTime', $expected);
		$this->assertEquals('1984-11-12 23:59:00', $expected->format('Y-m-d H:i:s'));
	}

	public function testGetTimezone()
	{
		$datetime = new DateTime('1984-11-12 23:59:00', new DateTimeZone('America/New_York'));
		
		$timely = new Timely;

		// Expected
		$expected = new DateTime('1984-11-12 23:59:00', new DateTimeZone('America/New_York'));
		$expected->setTimezone( new DateTimeZone('America/Los_Angeles') );

		// Minus three hours, Eastern to Pacific time
		$tested = $timely->set($datetime)->get('America/Los_Angeles');

		$this->assertInstanceOf('DateTime', $tested);
		$this->assertEquals($expected->format('Y-m-d H:i:s'), $tested->format('Y-m-d H:i:s'));
	}

	public function testGetUtc()
	{
		$datetime = new DateTime('1984-11-12 23:59:00', new DateTimeZone('America/New_York'));
		
		$timely = new Timely;

		// Expected
		$expected = new DateTime('1984-11-12 23:59:00', new DateTimeZone('America/New_York'));
		$expected->setTimezone( new DateTimeZone('UTC') );

		// Plus five hours, Eastern to UTC
		$tested = $timely->set($datetime)->getUtc();

		$this->assertInstanceOf('DateTime', $expected);
		$this->assertEquals($expected->format('Y-m-d H:i:s'), $tested->format('Y-m-d H:i:s'));
	}

	/**
     * @expectedException RuntimeException
     */
	public function testNotSettingFirstThrowsException()
	{
		$timely = new Timely;

		$timely->get('America/New_York');
	}

	/**
     * @expectedException InvalidArgumentException
     */
	public function testNotPassingTimezoneThrowsException()
	{
		$timely = new Timely;

		$timely->set( new DateTime )->get(1234);
	}

	/**
     * @expectedException Exception
     */
	public function testPassingInvalidTimezoneThrowsException()
	{
		$timely = new Timely;

		$timely->set( new DateTime )->get('Nonexistent');
	}

}