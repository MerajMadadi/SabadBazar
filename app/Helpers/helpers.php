<?php

if (!function_exists('toPersianNumber')) {
    function toPersianNumber($number)
    {
        $persianNumbers = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        $englishNumbers = ['0','1','2','3','4','5','6','7','8','9'];
        return str_replace($englishNumbers, $persianNumbers, $number);
    }
}
