<?php
declare(strict_types=1);

trait WeekDayTranslator
{
    public static function getDayTranslation(string $dayNameEng, $locale = 'pl'): string
    {
        $translatedDay = '';
        switch (strtoupper($dayNameEng)) {
            case 'MONDAY' : $translatedDay = 'poniedziałek'; break;
            case 'TUESDAY' : $translatedDay = 'wtorek'; break;
            case 'WEDNESDAY' : $translatedDay = 'środa'; break;
            case 'THURSDAY' : $translatedDay = 'czwartek'; break;
            case 'FRIDAY' : $translatedDay = 'piątek'; break;
            case 'SATURDAY' : $translatedDay = 'sobota'; break;
            case 'SUNDAY' : $translatedDay = 'niedziela'; break;
            default: $translatedDay = 'no_translation for: ' . $dayNameEng;
        }
        return $translatedDay;
    }
}