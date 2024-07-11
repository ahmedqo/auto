<?php

namespace App\Functions;

use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class Core
{
    public static $CURRENCY = 'MAD';
    public static $UNIT = 'MAD';
    public static function formatNumber($num)
    {
        $formattedNumber = number_format($num);
        if (strpos($formattedNumber, '.') === false) {
            $formattedNumber .= '.000';
        } else {
            list($integerPart, $decimalPart) = explode('.', $formattedNumber);
            switch (strlen($decimalPart)) {
                case 1:
                    $formattedNumber .= '00';
                    break;
                case 2:
                    $formattedNumber .= '0';
                    break;
            }
        }
        return $formattedNumber;
    }

    public static function matchRoute($str)
    {
        return Str::contains(request()->path(), $str);
    }

    public static function subString($str, $max = 157)
    {
        if (strlen($str) > $max) {
            $output = substr($str, 0, $max);
            return $output . '...';
        } else {
            return $str;
        }
    }

    public static function lang($lang = null)
    {
        return $lang ? app()->getLocale() == $lang : app()->getLocale();
    }

    public static function genderList()
    {
        return ['male', 'female'];
    }

    public static function statusList()
    {
        return ['available', 'not available'];
    }

    public static function periodList()
    {
        return ['week', 'month', 'year'];
    }

    public static function identityList()
    {
        return ['passport', 'national id', 'residence permit', 'visa'];
    }

    public static function orderList()
    {
        return  ['canceled', 'pendding', 'confirmed', 'completed'];
    }

    public static function rateList()
    {
        return  ['pendding', 'approved'];
    }

    public static function transmissionList()
    {
        return ['manual', 'automatic'];
    }

    public static function fuelList()
    {
        return ['gasoline', 'diesel'];
    }

    public static function promoteList()
    {
        return [[1, 'yes'], [0, 'no']];
    }

    public static function rate()
    {
        try {
            Core::$CURRENCY = Core::lang('en') ? '$' : '€';
            return (float)(Core::lang('en') ? Core::getSetting('usd_rate') : Core::getSetting('eur_rate'));
        } catch (\Exception $e) {
            Core::$CURRENCY = 'MAD';
            return 1;
        }
    }

    public static function getSetting($name, $type = 'type')
    {
        return Setting::filterBy($name, $type);
    }

    public static function getDates($period = 'week')
    {
        switch (Core::getSetting('period')) {
            case "week":
                return [
                    Carbon::now()->startOfWeek(Carbon::SUNDAY),
                    Carbon::now()->endOfWeek(Carbon::SATURDAY),
                    [
                        __('Sunday') => 0,
                        __('Monday') => 0,
                        __('Tuesday') => 0,
                        __('Wednesday') => 0,
                        __('Thursday') => 0,
                        __('Friday') => 0,
                        __('Saturday') => 0
                    ]
                ];
            case "month":
                $month = Carbon::now()->format('m');
                $year = Carbon::now()->format('Y');
                $firstDay = mktime(0, 0, 0, $month, 1, $year);
                $daysInMonth = (int) date('t', $firstDay);
                $dayOfWeek = (int) date('w', $firstDay);
                $weekOffset = ($dayOfWeek === 0) ? 6 : $dayOfWeek - 1;
                $count = (int) ceil(($daysInMonth + $weekOffset) / 7);
                $weeks = [];
                for ($i = 1; $i <= $count; $i++) {
                    $weeks[__('Week') . ' ' . $i] = 0;
                }
                return [
                    Carbon::now()->startOfMonth(),
                    Carbon::now()->endOfMonth(),
                    $weeks
                ];
            case "year":
                return [
                    Carbon::now()->startOfYear(),
                    Carbon::now()->endOfYear(),
                    [
                        __('January') => 0,
                        __('February') => 0,
                        __('March') => 0,
                        __('April') => 0,
                        __('May') => 0,
                        __('June') => 0,
                        __('July') => 0,
                        __('August') => 0,
                        __('September') => 0,
                        __('October') => 0,
                        __('November') => 0,
                        __('December') => 0
                    ]
                ];
        }
    }

    public static function groupKey($model, $period = 'week')
    {
        switch (Core::getSetting('period')) {
            case 'week':
                return __($model->updated_at->format('l'));
            case 'month':
                return __('Week') . ' ' . Core::formatWeek($model->updated_at->format('Y-m-d'));
            case 'year':
                return __($model->updated_at->format('F'));
        }
    }

    public static function formatWeek($datestr)
    {
        $date = new \DateTime($datestr);
        $dayOfWeek = $date->format('N');
        $dayOfMonth = $date->format('j');
        $startDayOfWeek = (new \DateTime($date->format('Y-m-01')))->format('N');
        return (int) ceil(($dayOfMonth + $startDayOfWeek - $dayOfWeek) / 7);
    }
}
