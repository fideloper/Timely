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
	 * A DateTime object in UTC Timezone
	 *
	 * @access protected
	 */
	protected $utc;

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
			$this->time($time);
		}
	}

	/**
	 * Get or Set a current time
	 * Creates a UTC version
	 *
	 * @param DateTime
	 * @return Timely\Tools|DateTime
	 */
	public function time(DateTime $time=null)
	{
		if( is_null($time) )
		{
			return $this->time;
		}

		$this->time = $time;

		$cloned = clone $this->time;
		$this->utc = $this->toUtc($cloned);

		return $this;
	}

	/**
	 * Convert time to UTC
	 *
	 * @param DateTime
	 * @return DateTime
	 */
	public function toUtc(DateTime $time=null)
	{
		if( is_null($time) && ! is_null($this->time) )
		{
			return $this->utc;
		}

		$time->setTimezone( new DateTimeZone('UTC') );

		return $time;
	}

	/**
	 * Convert from one timezone to another
	 *
	 * @param String 	String representation of a timezone
	 * @param DateTime 	Optional DateTime
	 * @return DateTime
	 */
	public function toTimezone($timezone, DateTime $time=null)
	{
		if( is_null($time) && ! is_null($this->time) )
		{
			$time = $this->time;
		}

		$time->setTimezone( new DateTimeZone($timezone) );

		return $time;
	}

	// Get offset from UTC
	public function utcOffset() {}

	// Get offset from GMT
	public function gmtOffset() {}
}