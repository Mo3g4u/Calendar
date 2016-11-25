<?php
/**
 * Created by PhpStorm.
 * User: takeuchi
 * Date: 2016/11/25
 * Time: 14:40
 */

namespace Mo3g4u\Calendar;


class Calendar
{

    private $year = 0;
    private $month = 0;
    private $startDow = 0; // 0 sun -> 6 sat
    private $days = [];

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @return int
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @return int
     */
    public function getStartDow()
    {
        return $this->startDow;
    }

    public function __construct($year = 0, $month = 0, $startDow = 0)
    {
        $this->year = $year;
        $this->month = $month;
        $this->startDow = $startDow;
        $this->defaultSet();
        $this->create();
    }

    public function getRawDates()
    {
        return $this->days;
    }

    public function getTwoDimensionalArray()
    {
        return array_chunk($this->days, 7);
    }



    private function create()
    {
        $firstDay = new \DateTime();
        $firstDay->setDate($this->year, $this->month, 1);
        $days = $firstDay->format('t');
        $this->addBeforeMonthDate($firstDay); // 1日より前
        $this->addCurrentMonthDate($days); // 当月
        $this->addAfterMonthDate($days);
    }

    private function addBeforeMonthDate($firstDay)
    {
        if($firstDay->format('w') == $this->startDow){
            return true;
        }
        $count = 1;
        while (1){
            $tmpDate = clone $firstDay;
            $tmpDate->modify('-' . $count . ' day');
            $this->days[] = $tmpDate;
            if($tmpDate->format('w') == $this->startDow){
                break;
            }
            $count++;
        }
    }

    private function addCurrentMonthDate($days)
    {
        for($i = 1; $i <= $days; $i++){
            $dateTime = new \DateTime();
            $dateTime->setDate($this->year, $this->month, $i);
            $this->days[] = $dateTime;
        }
    }

    private function addAfterMonthDate($days)
    {
        $lastDow = $this->startDow - 1;
        if($lastDow < 0){
            $lastDow = 6;
        }
        $lastDateTime = new \DateTime();
        $lastDateTime->setDate($this->year, $this->month, $days);
        if($lastDateTime->format('w') == $lastDow){
            return true;
        }
        $count = 1;
        while(1){
            $tmpDate = clone $lastDateTime;
            $tmpDate->modify('+' . $count . ' day');
            $this->days[] = $tmpDate;
            if($tmpDate->format('w') == $lastDow){
                break;
            }
            $count++;
        }
    }

    private function defaultSet()
    {
        $date = new \DateTime();
        if($this->year === 0){
            $this->year = $date->format('Y');
        }
        if($this->month === 0){
            $this->month = $date->format('m');
        }
    }

}