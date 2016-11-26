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

    public function testdates201611()
    {
        $calendar = new Calendar(2016, 11);
        $dates = $calendar->dates();
        $this->assertEquals(35, count($dates));
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

    public function testDatesChunk201611()
    {
        $calendar = new Calendar(2016, 11);
        $array = $calendar->datesChunk();
        $this->assertEquals(5, count($array));
        $this->assertEquals('30', $array[0][0]['day']);
        $this->assertEquals('10', $array[0][1]['month']);
        $this->assertEquals('01', $array[0][2]['day']);
        $this->assertEquals('30', $array[4][3]['day']);
        $this->assertEquals('01', $array[4][4]['day']);
        $this->assertEquals('02', $array[4][5]['day']);
        $this->assertEquals('03', $array[4][6]['day']);
    }

    public function testRawNthWeek201611()
    {
        $calendar = new Calendar(2016, 11);
        $array = $calendar->rawDatesNthWeek(2);
        $this->assertEquals(7, count($array));
        $this->assertEquals('2016-11-09', $array[3]->format('Y-m-d'));
    }

    public function testNthWeek201611()
    {
        $calendar = new Calendar(2016, 11);
        $array = $calendar->datesNthWeek(2);
        $this->assertEquals(7, count($array));
        $this->assertEquals('2016', $array[3]['year']);
        $this->assertEquals('11', $array[3]['month']);
        $this->assertEquals('09', $array[3]['day']);
    }

    public function testRawSpecifyDow201611()
    {
        $calendar = new Calendar(2016, 11);
        $array = $calendar->rawSpecifyDow(4); // 0 sun - 6 sat
        $this->assertEquals(5, count($array));
        $this->assertEquals('2016-11-03', $array[0]->format('Y-m-d'));
        $this->assertEquals('2016-12-01', $array[4]->format('Y-m-d'));
    }

    public function testSpecifyDow201611()
    {
        $calendar = new Calendar(2016, 11);
        $array = $calendar->specifyDow(4); // 0 sun - 6 sat
        $this->assertEquals(5, count($array));
        $this->assertEquals('2016', $array[0]['year']);
        $this->assertEquals('11', $array[0]['month']);
        $this->assertEquals('03', $array[0]['day']);
        $this->assertEquals('2016', $array[4]['year']);
        $this->assertEquals('12', $array[4]['month']);
        $this->assertEquals('01', $array[4]['day']);
    }

    public function testRawNthDow201611()
    {
        $calendar = new Calendar(2016, 11);
        $date = $calendar->rawNthDow(2, 3); // second week & wed
        $this->assertEquals('2016-11-09', $date->format('Y-m-d'));
    }

    public function testNthDow201611()
    {
        $calendar = new Calendar(2016, 11);
        $date = $calendar->nthDow(2, 3); // second week & wed
        $this->assertEquals('2016', $date['year']);
        $this->assertEquals('11', $date['month']);
        $this->assertEquals('09', $date['day']);
    }

}
