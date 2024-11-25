<?php

class BanglaDate
{

    private $timestamp;
    private $dt_change;
    private $months = array('পৌষ', 'মাঘ', 'ফাল্গুন', 'চৈত্র', 'বৈশাখ', 'জ্যৈষ্ঠ', 'আষাঢ়', 'শ্রাবণ', 'ভাদ্র', 'আশ্বিন', 'কার্তিক', 'অগ্রহায়ণ');
    private $days = array('রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার', 'শনিবার');

    public function __construct($timestamp, $dt_change = 0)
    {
        $this->timestamp = $timestamp;
        $this->dt_change = $dt_change;
    }

    // Convert Gregorian date to Bangla Date
    public function get_day()
    {
        $date = gmdate("l, j F Y", $this->timestamp + $this->dt_change * 3600); // Adjust for timezone
        return explode(", ", $date); // Split day, date, month and year
    }

    // Get Bangla month and year
    public function get_month_year()
    {
        $date = gmdate("n", $this->timestamp + $this->dt_change * 3600); // Get month number
        $year = gmdate("Y", $this->timestamp + $this->dt_change * 3600); // Get year

        // Convert the Gregorian month to Bangla
        $month = $this->months[$date - 1];

        return array($month, $year);
    }

    // Get Bangla month
    public function get_month()
    {
        $month_num = gmdate("n", $this->timestamp + $this->dt_change * 3600); // Get month number
        return array($this->months[$month_num - 1]);
    }

    // Get the Bangla day of the week
    public function get_day_name()
    {
        $day_num = gmdate("w", $this->timestamp + $this->dt_change * 3600); // Get day of the week
        return $this->days[$day_num];
    }
}
