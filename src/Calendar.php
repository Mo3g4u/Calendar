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

    /**
     * @var int
     */
    private $year = 0;
    /**
     * @var int
     */
    private $month = 0;
    /**
     * @var int
     */
    private $startDow = 0; // 0 sun -> 6 sat
    /**
     * @var array
     */
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


    /**
     * Calendar constructor.
     * @param int $year
     * @param int $month
     * @param int $startDow
     */
    public function __construct($year = 0, $month = 0, $startDow = 0)
    {
        $this->year = $year;
        $this->month = $month;
        $this->startDow = $startDow;
        $this->defaultSet();
        try {
            $this->dateCheck($this->year, $this->month);
        } catch (\RuntimeException $e) {
            echo "Error:" . $e->getMessage();
            exit();
        }
        $this->create();
    }

    /**
     * @return array
     */
    public function rawDates()
    {
        return $this->days;
    }

    /**
     * @return array
     */
    public function dates()
    {
        return $this->toArray($this->days);
    }

    /**
     * @param int $separate
     * @return array
     */
    public function rawDatesChunk($separate = 7)
    {
        return array_chunk($this->days, $separate);
    }

    /**
     * @param int $separete
     * @return array
     */
    public function datesChunk($separete = 7)
    {
        $dates = $this->dates();
        return array_chunk($dates, $separete);
    }

    /**
     * @param int $n
     * @param int $separate
     * @return array
     */
    public function rawDatesNthWeek($n = 0, $separate = 7)
    {
        $data = array_chunk($this->days, $separate);
        if(!isset($data[$n - 1])){
            return [];
        }
        return $data[$n -1];
    }


    /**
     * @param int $n
     * @param int $separate
     * @return array
     */
    public function datesNthWeek($n = 0, $separate = 7)
    {
        $dateTimes = $this->rawDatesNthWeek($n, $separate);
        return $this->toArray($dateTimes);
    }

    /**
     * @param int $dow
     * @return array
     */
    public function rawSpecifyDow($dow = 0)
    {
        $dates = [];
        foreach ($this->days as $day) {
            if($day->format('w') == $dow){
                $dates[] = $day;
            }
        }
        return $dates;
    }

    /**
     * @param int $dow
     * @return array
     */
    public function specifyDow($dow = 0)
    {
        $dateTimes = $this->rawSpecifyDow($dow);
        return $this->toArray($dateTimes);
    }

    /**
     * @param int $nth
     * @param int $dow
     * @param int $separate
     * @return bool|mixed
     */
    public function rawNthDow($nth = 1, $dow = 0, $separate = 7)
    {
        $array = $this->rawDatesNthWeek($nth, $separate);
        foreach ($array as $day){
            if($day->format('w') == $dow){
                return $day;
            }
        }
        return false;
    }

    /**
     * @param int $nth
     * @param int $dow
     * @param int $separate
     * @return array
     */
    public function nthDow($nth = 1, $dow = 0, $separate = 7)
    {
        $day = $this->rawNthDow($nth, $dow, $separate);
        return [
            'year' => $day->format('Y'),
            'month' => $day->format('m'),
            'day' => $day->format('d'),
            'dow' => $day->format('w')
        ];
    }

    /**
     *
     */
    private function create()
    {
        $firstDay = new \DateTime();
        $firstDay->setDate($this->year, $this->month, 1);
        $days = $firstDay->format('t');
        $this->addLastMonthDate($firstDay); // 1日より前
        $this->addCurrentMonthDate($days); // 当月
        $this->addNextMonthDate($days);
    }

    /**
     * @param $firstDay
     * @return bool
     */
    private function addLastMonthDate($firstDay)
    {
        if($firstDay->format('w') == $this->startDow){
            return true;
        }
        $prevDates = [];
        $count = 1;
        while (1){
            $tmpDate = clone $firstDay;
            $tmpDate->modify('-' . $count . ' day');
            $prevDates[] = $tmpDate;
            if($tmpDate->format('w') == $this->startDow){
                break;
            }
            $count++;
        }
        $this->days = array_reverse($prevDates);
    }

    /**
     * @param $days
     */
    private function addCurrentMonthDate($days)
    {
        for($i = 1; $i <= $days; $i++){
            $dateTime = new \DateTime();
            $dateTime->setDate($this->year, $this->month, $i);
            $this->days[] = $dateTime;
        }
    }

    /**
     * @param $days
     * @return bool
     */
    private function addNextMonthDate($days)
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

    /**
     *
     */
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

    /**
     * @param $year
     * @param $month
     * @throws \RuntimeException
     */
    private function dateCheck($year, $month)
    {
        $day = 1;
        if(!checkdate($month, $day, $year)){
            throw new \RuntimeException("checkdate error");
        }
    }

    /**
     * @param $dateTimes
     * @return array
     */
    private function toArray($dateTimes)
    {
        $dates = [];
        foreach ($dateTimes as $day){
            $tmp = [
                'year' => $day->format('Y'),
                'month' => $day->format('m'),
                'day' => $day->format('d'),
                'dow' => $day->format('w')
            ];
            $dates[] = $tmp;
        }
        return $dates;
    }

}