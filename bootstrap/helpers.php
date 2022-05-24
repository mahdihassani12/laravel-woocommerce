<?php


	 // Convert date(Y-m-d) from miladi to shamsi
    function convertDateToJalali($gdate){
    	$gdate = explode('-', $gdate);
        $year = $gdate[0];
        $month = $gdate[1];
        $day = $gdate[2];
        $gdate = \Morilog\Jalali\CalendarUtils::toJalali($year, $month, $day);
        $year = $gdate[0];
        $month = $gdate[1];
        $day = $gdate[2];
        $jdate = $year.'-'.$month.'-'.$day;
        return $jdate;
    }

    // Convert date(Y-m-d) from shamsi to Miladi
    function convertDateToGregorian($jdate){
    	$jdate = explode('-', $jdate);
        $year = $jdate[0];
        $month = $jdate[1];
        $day = $jdate[2];
        $jdate = \Morilog\Jalali\CalendarUtils::toGregorian($year, $month, $day);
        $year = $jdate[0];
        $month = $jdate[1];
        $day = $jdate[2];
        $gdate = $year.'-'.$month.'-'.$day;
        return $gdate;
    }

    



?>