<?php

use Mo3g4u\Calendar\Calendar;

/**
 * Created by PhpStorm.
 * User: takeuchi
 * Date: 2016/11/25
 * Time: 14:40
 */
class CalendarTest extends PHPUnit_Framework_TestCase
{

    public function testRawDates201611()
    {
        $calendar = new Calendar(2016, 11);
        $raw = $calendar->rawDates();
        $this->assertEquals(35, count($raw));
    }

    public function testGetTwoDimensionalArray201611()
    {
        $calendar = new Calendar(2016, 11);
        $array = $calendar->rawDatesChunk();
        $this->assertEquals(5, count($array));
    }


}
