Timely
======

Tools for handling time and timezones. Handy for storing converting times in UTC to user local times.

It's recommended that you store all times in UTC and let your users choose their timezone. You can then convert time to their local timezone for display as needed.

Master: [![Build Status](https://travis-ci.org/fideloper/Timely.png?branch=master)](https://travis-ci.org/fideloper/Timely)

Develop: [![Build Status](https://travis-ci.org/fideloper/Timely.png?branch=develop)](https://travis-ci.org/fideloper/Timely)

---

## Usage

```php
$timely = new Timely;

// Get DateTime in new Timezone
$time = new DateTime(); // Let's say it's in Mountain Time
$est = $timely->set($time)->get('America/New_York');

// No need to reset original time
$pdt = $timely->get('America/Los_Angeles');

// Get DateTime in UTC
$time = new DateTime();
$utc = $timely->set($time)->getUtc();
```

## To Do

```php
$timely = new Timely;

$time = new DateTime;
$offset = $timely->set($time)->offset('America/New_York');
$offsetUtc = $timely->set($time)->offsetUtc();
```