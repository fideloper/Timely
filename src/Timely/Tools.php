<?php namespace Timely;

use DateTime;
use DateTimeZone;

class Tools {

	/**
	 * A DateTime object
	 *
	 * @access protected
	 */
	protected $time;

	/**
	 * Optionally set a time on creation
	 *
	 * @param DateTime
	 * @return void
	 */
	public function __construct(DateTime $time=null)
	{
		if( !is_null($time) )
		{
			$this->set($time);
		}
	}

	/**
	 * Set a current time
	 * Optionally set its timezone
	 *
	 * @param DateTime
	 * @param Mixed 	TimeZone object or String
	 * @return Timely\Tools
	 */
	public function set(DateTime $time, $timezone=null)
	{
		$this->time = $time;

		if( ! is_null($timezone) )
		{
			$this->time->setTimezone( $this->timezone($timezone) );
		}

		return $this;
	}

	/**
	 * Convert set time to different timezone
	 *
	 * @param Mixed 	Valid timezone string or DateTimeZone object
	 * @return DateTime
	 */
	public function get($timezone=null)
	{
		// Need a DateTime set to continue
		if( $this->time instanceof DateTime === false) {
			throw new \RuntimeException('No DateTime object set.');
		}

		// If null, return set DateTime
		if( is_null($timezone) )
		{
			return $this->time;
		}

		// Else, change timezone and return
		$newtime = clone $this->time;

		$newtime->setTimezone( $this->timezone($timezone) );

		return $newtime;
	}

	/**
	 * Convert time to any TimeZone
	 *
	 * @return DateTime
	 */
	public function getUtc()
	{
		return $this->get( new DateTimeZone('UTC') );
	}

	/**
	 * For any DateTimeZone setting, accept a valid
	 * TimeZone string or DateTimeZone object
	 *
	 * @param Mixed 	String of TimeZone or TimeZone object
	 * @return DateTimeZone
	 */
	protected function timezone($timezone)
	{
		if( is_string($timezone) )
		{
			return new DateTimeZone($timezone);
		}

		if( $timezone instanceof DateTimeZone )
		{
			return $timezone;
		}

		throw new \InvalidArgumentException('Must pass a valid timezone string or DateTimeZone object.');
	}
}