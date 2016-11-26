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

    public function testRawDatesChunk201611()
    {
        $calendar = new Calendar(2016, 11);
        $array = $calendar->rawDatesChunk();
        $this->assertEquals(5, count($array));
        $this->assertEquals('2016-10-30', $array[0][0]->format('Y-m-d'));
        $this->assertEquals('2016-10-31', $array[0][1]->format('Y-m-d'));
        $this->assertEquals('2016-11-01', $array[0][2]->format('Y-m-d'));
        $this->assertEquals('2016-11-30', $array[4][3]->format('Y-m-d'));
        $this->assertEquals('2016-12-01', $array[4][4]->format('Y-m-d'));
        $this->assertEquals('2016-12-02', $array[4][5]->format('Y-m-d'));
        $this->assertEquals('2016-12-03', $array[4][6]->format('Y-m-d'));
    }

    public function testRawNthWeek201611()
    {
        $calendar = new Calendar(2016, 11);
        $array = $calendar->rawDatesNthWeek(2);
        $this->assertEquals(7, count($array));
        $this->assertEquals('2016-11-09', $array[3]->format('Y-m-d'));
    }

    public function testRawSpecifyDow201611()
    {
        $calendar = new Calendar(2016, 11);
        $array = $calendar->rawSpecifyDow(4); // 0 sun - 6 sat
        $this->assertEquals(5, count($array));
        $this->assertEquals('2016-11-03', $array[0]->format('Y-m-d'));
        $this->assertEquals('2016-12-01', $array[4]->format('Y-m-d'));
    }

    public function testRawNthDow201611()
    {
        $calendar = new Calendar(2016, 11);
        $date = $calendar->rawNthDow(2, 3); // second week & wed
        $this->assertEquals('2016-11-09', $date->format('Y-m-d'));
    }


}
