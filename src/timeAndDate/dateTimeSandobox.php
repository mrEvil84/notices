<?php

namespace timeAndDate;

use DateTime;
use DateTimeZone;

require_once 'WeekDayTranslator.php';


// time () - zwraca liczę sekund które upłyneły od począktu ery Unixu -> 1.1.1970 ( Epoch)
// microtime () - zwraca czas z mikrosekuntami microsecond[space]seconds
// date ('Y-m-d') - zwraca sformatowana date godzine itd.
// mktime(parametry_liczbowe_daty) - zwraca timestamp
// strtotime() - zwraca timestamp ze stringa


// time ()

//$actualTime = time();
//$minutesFromBeginning = $actualTime/60;
//$hoursFromBeginning = $minutesFromBeginning / 60;
//$daysFromBeginning = $hoursFromBeginning/24;
//$weeksFromBeginning = $daysFromBeginning/7;
//$yearsFromBeginning = $daysFromBeginning/365;

//echo 'Years from beginning : ' . $yearsFromBeginning . PHP_EOL;

//$hourInSeconds = 60 * 60;
//$dayInSeconds = 60 * 60 * 24;
//
//$actualDateTime = date('l Y-m-d H:i:s ');
//echo 'Actual date and time : ' . $actualDateTime . PHP_EOL;
//print_r('Yesterday date and time : ' . date('Y-m-d D H:i:s', time() - $dayInSeconds));


// microtime ()

//list($utime, $secs) = explode(' ', microtime());
//echo 'Microtime : utime= ' . (float)$utime . ' secs = ' . (float)$secs . PHP_EOL;

// checkdate()

// check_date(month,day,year) , sprawdzanie poprawności daty
//var_dump(checkdate(1,1,2021));

// mktime () - konwersje do timestamp

//$timestamp = mktime(10,5,2,12,13,2021);
//echo 'Yestrday timestamps: ' . $timestamp . PHP_EOL;
//echo 'Yesteday date: ' . date('Y-m-d H:i:s l', $timestamp) . PHP_EOL;
//


//// strtotime () - konwersja stringa na timestamp
//$dateTimeSting = '2021-12-10 14:01:21';
//$fromStringDateTime = strtotime($dateTimeSting);
//
//echo 'From string: ' . $dateTimeSting . ' date time = ' . $fromStringDateTime . PHP_EOL;
//echo 'Converted again = ' .date('Y-m-d l') . PHP_EOL;


// strftime () - deprecated from 8.1
//setlocale(LC_TIME, "pl_PL");
//echo strftime("%A") . PHP_EOL;


// getdate () // return's array with actual date

//$today = getdate();
//var_dump($today);


// various

//echo "Data powiększona o tydzień to ".date("d.m.y", strtotime('+7 days', time()));
//
//echo strtotime("now"), "\n";
//echo strtotime("10 September 2000"), "\n";
//echo strtotime("+1 day"), "\n";
//echo strtotime("+1 week"), "\n";
//echo strtotime("+1 week 2 days 4 hours 2 seconds"), "\n";
//echo strtotime("next Thursday"), "\n";
//echo strtotime("last Monday"), "\n";

// TimeZones

//$date = new DateTime('now', new DateTimeZone('Europe/Warsaw'));
//echo 'Warsaw : ' . $date->format('Y-m-d H:i:sP') . PHP_EOL;
//
//$date->setTimezone(new DateTimeZone('Pacific/Chatham'));
//echo 'Pacific : ' . $date->format('Y-m-d H:i:sP') . PHP_EOL;
//
//// Exercises: born date
//
//$bornDate = date('Y-m-d l', mktime(14, 15, 0, 10, 17, 1984));
//$bornDay = date('l', mktime(14, 15, 0, 10, 17, 1984));
//
//class BornDayPlTranslator
//{
//    use WeekDayTranslator;
//
//    public static function getDay(string $dayName): string
//    {
//        return WeekDayTranslator::getDayTranslation($dayName);
//    }
//
//}

//echo 'Born day: ' . BornDayPlTranslator::getDay($bornDay) . PHP_EOL;

//
//$bornDateDetails = getdate(mktime(14, 15, 0, 10, 17, 1984));
//echo 'Born date: ' . $bornDate . PHP_EOL;
//print_r($bornDateDetails);

// Ex: Actual date formatted
//$actualDateAndTime = date('d-m-Y H:i:s', time());
//list($actualDate, $actualTime) = explode(' ', $actualDateAndTime);
//echo 'Dzisiaj jest ' . $actualDate . ' godzina ' . $actualTime . PHP_EOL;

// check if year is leap year, rok przestępny

//function isLeapYear(int $checkedYear): bool
//{
//    $isLeapYear = date('L', mktime(0, 0, 0, 1, 1, $checkedYear));
//
//    return $isLeapYear === '1';
//}

//$yearsToCheck = [
//    '2000' => 2000,
//    '2001' => 2001,
//    '2002' => 2002,
//    '2003' => 2003,
//    '2004' => 2004,
//    '2005' => 2005,
//    '2006' => 2006,
//    '2007' => 2007,
//    '2008' => 2008,
//    '2009' => 2009,
//    '2010' => 2010,
//];
//
//foreach ($yearsToCheck as $year => $value) {
//    $isLeap = isLeapYear($value) ? 'yes' : 'no';
//    echo $year . '->' . $isLeap . PHP_EOL;
//    //echo 'Year ' . $year . ' ' . isLeapYear($value) ? 'is leap ' : 'not leap year' . PHP_EOL;
//}

//echo date('L', strtotime('last year')) . PHP_EOL;