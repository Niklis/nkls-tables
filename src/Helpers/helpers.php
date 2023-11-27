<?php

use Illuminate\Support\Str;

if (!function_exists('markSearchAndFilterResults')) {

    function markSearchAndFilterResults($table, array $column, string $value): string
    {
        if (
            !($table->config['searchValue'] != '' &&
                in_array($column['key'], $table->searchableColumns) &&
                preg_match('/(' . preg_quote($table->config['searchValue'], '/') . ')/i', $value)) &&
            !($table->config['filters'][$column['hash']]['val1'] != '' &&
                $table->config['filters'][$column['hash']]['type'] == 'text' &&
                preg_match('/(' . preg_quote($table->config['filters'][$column['hash']]['val1'], '/') . ')/i', $value))
        )
            return $value;

        $valueArr = str_split($value);
        $valueMaskArr = array_fill(0, count($valueArr), ['inSearch' => false, 'inFilter' => false]);

        $searchOrFilter = false;

        if (
            $table->config['searchValue'] != '' &&
            in_array($column['key'], $table->searchableColumns) &&
            preg_match('/(' . preg_quote($table->config['searchValue'], '/') . ')/i', $value)
        ) {
            $searchOrFilter = true;
            preg_match_all('/(' . preg_quote($table->config['searchValue'], '/') . ')/i', $value, $searchOut, PREG_OFFSET_CAPTURE);
            foreach ($searchOut[0] as $item) {
                $searchVal = $item[0];
                $searchValLength = strlen($searchVal);
                $startPos = $item[1];
                for ($i = $startPos; $i < $startPos + $searchValLength; $i++) {
                    $valueMaskArr[$i]['inSearch'] = true;
                }
            }
        }

        if (
            $table->config['filters'][$column['hash']]['val1'] != '' &&
            $table->config['filters'][$column['hash']]['type'] == 'text' &&
            preg_match('/(' . preg_quote($table->config['filters'][$column['hash']]['val1'], '/') . ')/i', $value)
        ) {
            $searchOrFilter = true;
            preg_match_all('/(' . preg_quote($table->config['filters'][$column['hash']]['val1'], '/') . ')/i', $value, $filterOut, PREG_OFFSET_CAPTURE);
            foreach ($filterOut[0] as $item) {
                $filterVal = $item[0];
                $filterValLength = strlen($filterVal);
                $startPos = $item[1];
                for ($i = $startPos; $i < $startPos + $filterValLength; $i++) {
                    $valueMaskArr[$i]['inFilter'] = true;
                }
            }
        }

        if ($searchOrFilter) {
            for ($i = 0; $i < count($valueArr); $i++) {
                if ($valueMaskArr[$i]['inFilter'] == true && $valueMaskArr[$i]['inSearch'] == false) {
                    $valueArr[$i] = '<mark style="padding: 0;color: tomato;background-color: transparent;">' . $valueArr[$i] . '</mark>';
                }

                if ($valueMaskArr[$i]['inFilter'] == false && $valueMaskArr[$i]['inSearch'] == true) {
                    $valueArr[$i] = '<mark style="padding: 0;background-color: yellow;">' . $valueArr[$i] . '</mark>';
                }

                if ($valueMaskArr[$i]['inFilter'] == true && $valueMaskArr[$i]['inSearch'] == true) {
                    $valueArr[$i] = '<mark style="padding: 0;color: tomato;background-color: yellow;">' . $valueArr[$i] . '</mark>';
                }
            }
        }

        $value = implode('', $valueArr);

        return $value;
    }
}

if (!function_exists('getColumnValue')) { //?

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

if (!function_exists('getTableUid')) {

    function getTableUid()
    {
        return bin2hex(random_bytes(5));
    }
}
