<?php
use Illuminate\Support\Str;

if (! function_exists('getColumnValue')) {

    //get value from array with dot notation string or without
    function getColumnValue($array, $dotNotationString)
    {
        if (Str::contains($dotNotationString, '.')) {
            foreach (explode('.', $dotNotationString) as $segment) {
                if (isset($array[Str::singular($segment)])) {
                    $array =  $array[Str::singular($segment)];
                } else {
                    continue;
                }
            }
            return $array;
        }
        return $array[$dotNotationString];
    }
}
if (! function_exists('getUid')) {
    
    function getUid()
    {
        return bin2hex(random_bytes(15));
    }
}

if (! function_exists('pluralSortBy')) {
    
    function pluralSortBy($key)
    {
        //if dot notation
        $temp_arr = explode('.', $key);
        if (count($temp_arr) > 1) {
            $key = Illuminate\Support\Str::plural($temp_arr[0]) . '.' . $temp_arr[1];
        }
        return $key;
    }
}