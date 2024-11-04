<?php

namespace App\Helpers;

use App\Models\Birthday;
use Carbon\Carbon;

class BirthdayHelper
{
    public static function formatBirthday(Birthday $birthday)
    {
        if (!$birthday) {
            return [
                'day' => 'N/A',
                'month' => 'N/A',
                'year' => 'N/A',
                'day_name' => null,
            ];
        }

        $day = $birthday->day ?? 'N/A';
        $month = $birthday->month ? Carbon::create()->month($birthday->month)->monthName : 'N/A';
        $year = $birthday->year ?? 'N/A';

        $dayName = null;
        if ($day && $birthday->month) {
            $dayName = Carbon::create(date('Y'), $birthday->month, $day)->format('l');
        }

        return [
            'day' => $day,
            'month' => $month,
            'year' => $year,
            'day_name' => $dayName,
        ];
    }
}
