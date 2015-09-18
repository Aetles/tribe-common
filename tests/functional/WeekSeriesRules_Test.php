<?php

/**
 * Class WeekSeriesRules_Test
 *
 * @group pro
 * @group recurrence
 */
class WeekSeriesRules_Test extends Tribe__Events__Pro__WP_UnitTestCase
{
	const DATE_FORMAT = "Y-m-d";
	protected $date;

	public function setUp() {
		$this->date = strtotime("2011-04-23"); // a saturday
		parent::setUp();
	}

	public function testNextWeek()
	{
		$rules = new Tribe__Events__Pro__Date_Series_Rules__Week();
		$nextDate = $rules->getNextDate($this->date);
		$this->assertEquals(date(self::DATE_FORMAT, $nextDate), "2011-04-30");
	}

	public function testEveryTwoWeeks()
	{
		$rules = new Tribe__Events__Pro__Date_Series_Rules__Week(2);
		$nextDate = $rules->getNextDate($this->date);
		$this->assertEquals(date(self::DATE_FORMAT, $nextDate), "2011-05-07");
	}

	public function testEveryTwoMondays()
	{
		// find next monday
		$rules = new Tribe__Events__Pro__Date_Series_Rules__Week(2, array(1));
		$nextDate = $rules->getNextDate($this->date);
		$this->assertEquals(date(self::DATE_FORMAT, $nextDate), "2011-05-02");
		$nextDate = $rules->getNextDate($nextDate);
		$this->assertEquals(date(self::DATE_FORMAT, $nextDate), "2011-05-16");
	}

	public function testEveryTwoThursdaysAndTuesdays() {
		$rules = new Tribe__Events__Pro__Date_Series_Rules__Week(2, array(4,2));
		$nextDate = $rules->getNextDate($this->date);
		$this->assertEquals(date(self::DATE_FORMAT, $nextDate), "2011-05-03");
		$nextDate = $rules->getNextDate($nextDate);
		$this->assertEquals(date(self::DATE_FORMAT, $nextDate), "2011-05-05");
		$nextDate = $rules->getNextDate($nextDate);
		$this->assertEquals(date(self::DATE_FORMAT, $nextDate), "2011-05-17");
		$nextDate = $rules->getNextDate($nextDate);
		$this->assertEquals(date(self::DATE_FORMAT, $nextDate), "2011-05-19");
	}
}
?>
