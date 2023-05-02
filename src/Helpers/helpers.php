<?php

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