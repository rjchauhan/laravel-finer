<?php

use Carbon\Carbon;
use Illuminate\Support\Str;

if (!function_exists('uuid')) {
    /**
     * Returns UUID of 32 characters
     *
     * @return string
     */
    function uuid()
    {
        $currentTime = (string)microtime(true);

        $randNumber = (string)rand(10000, 1000000);

        $shuffledString = str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789");

        return md5($currentTime . $randNumber . $shuffledString);
    }
}

if (!function_exists('uuid_alphanumeric')) {
    /**
     * Generate alphanumeric UUID
     *
     * @param int $length
     * @return string
     */
    function uuid_alphanumeric($length = 6)
    {
        $chars = array_merge(range('A', 'Z'), range('0', '9'));

        $password = '';

        while ($length--) {
            $key = array_rand($chars);
            $password .= $chars[$key];
        }

        return $password;
    }
}

if (!function_exists('otp')) {
    /**
     * Returns 4 digit One time password
     *
     * @return int
     */
    function otp()
    {
        return mt_rand(1000, 9999);
    }
}

if (!function_exists('age')) {
    /**
     * Get age (in years) from birth date
     *
     * @param $date
     * @return int
     */
    function age($date)
    {
        return Carbon::today()->diffInYears(Carbon::parse($date));
    }
}

if (!function_exists('month_ending_today')) {
    /**
     * Determine if month is ending today or not.
     *
     * @return bool
     */
    function month_ending_today()
    {
        return gmdate('t') === gmdate('d');
    }
}

if (!function_exists('is_between')) {
    /**
     * Check if give value is in between 2 values.
     *
     * @param $value
     * @param $from
     * @param $to
     * @return bool
     */
    function is_between($value, $from, $to)
    {
        return ($value >= $from && $value <= $to) || ($value >= $to && $value <= $from);
    }
}

if (!function_exists('euro_format')) {
    /**
     * Euro format numbers.
     *
     * @param $value
     * @param int $friction
     * @return string
     */
    function euro_format($value, $friction = 2)
    {
        return sprintf('%s €', number_format($value, $friction, ',', '.'));
    }
}

if (!function_exists('word_anonymize')) {
    /**
     * Anonymize given word.
     *
     * @param $word
     * @return string
     */
    function word_anonymize($word)
    {
        return substr($word, 0, -2) . '**';
    }
}

if (!function_exists('str_contains_words')) {
    /**
     * Determine if string contains given words.
     *
     * @param $string
     * @param array $words
     * @return bool
     */
    function str_contains_words($string, array $words)
    {
        $explodedString = explode(' ', strtolower($string));

        return collect($words)->filter(function ($word) use ($explodedString) {
                return in_array($word, $explodedString);
            })->count() > 0;
    }
}

if (!function_exists('random_color')) {
    /**
     * Get random hex color code.
     *
     * @return string
     */
    function random_color()
    {
        return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
    }
}

if (!function_exists('str_beautify')) {
    /**
     * Beautify string.
     *
     * @param $string
     * @param string $search
     * @param string $replace
     * @return string
     */
    function str_beautify($string, $search = '_', $replace = ' ')
    {
        return ucwords(str_replace($search, $replace, $string));
    }
}

if (!function_exists('time_from_seconds')) {
    /**
     * Get time from seconds.
     *
     * @param $seconds
     * @return string
     */
    function time_from_seconds($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        $seconds = $seconds % 60;

        return "$hours:$minutes:$seconds";
    }
}

if (!function_exists('array_diff_assoc_recursive')) {
    /**
     * Array difference from associative recursive arrays.
     *
     * @param $array1
     * @param $array2
     * @return array
     */
    function array_diff_assoc_recursive($array1, $array2)
    {
        $difference = [];
        foreach ($array1 as $key => $value) {
            if (is_array($value)) {
                if (!isset($array2[$key]) || !is_array($array2[$key])) {
                    $difference[$key] = $value;
                } else {
                    $new_diff = array_diff_assoc_recursive($value, $array2[$key]);
                    if (!empty($new_diff))
                        $difference[$key] = $new_diff;
                }
            } else if (!array_key_exists($key, $array2) || $array2[$key] !== $value) {
                $difference[$key] = $value;
            }
        }

        return $difference;
    }
}

if (!function_exists('str_replacer')) {
    /**
     * Replace keywords from string.
     *
     * @param $string
     * @param array $replace
     * @return string|string[]
     */
    function str_replacer($string, array $replace)
    {
        foreach ($replace as $key => $value) {
            $string = str_replace(
                [':' . $key, ':' . Str::upper($key), ':' . Str::ucfirst($key)],
                [$value, Str::upper($value), Str::ucfirst($value)],
                $string
            );
        }

        return $string;
    }
}
