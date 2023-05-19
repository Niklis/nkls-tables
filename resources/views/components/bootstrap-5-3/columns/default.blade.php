@props(['value', 'column'])

@php
    $valueArr = str_split($value);
    $valueMaskArr = array_fill(0, count($valueArr), ['char' => '', 'inSearch' => false, 'inFilter' => false]);
    
    if ($this->searchValue != '' && in_array($column['key'], $this->searchColumns) && preg_match("/{$this->searchValue}/i", $value)) {
        preg_match_all('/(' . preg_quote($this->searchValue, '/') . ')/i', $value, $searchOut, PREG_OFFSET_CAPTURE);
        foreach ($searchOut[0] as $item) {
            $searchVal = $item[0];
            $searchValLength = strlen($item[0]);
            $startPos = $item[1];
            for ($i = $startPos; $i < $startPos + $searchValLength; $i++) {
                $valueMaskArr[$i]['inSearch'] = true;
                $valueMaskArr[$i]['char'] = $valueArr[$i];
            }
        }
    }
    
    if ($this->filters[$column['hash']]['val1'] != '' && $this->filters[$column['hash']]['type'] == 'text') {
        preg_match_all('/(' . preg_quote($this->filters[$column['hash']]['val1'], '/') . ')/i', $value, $filterOut, PREG_OFFSET_CAPTURE);
        foreach ($filterOut[0] as $item) {
            $filterVal = $item[0];
            $filterValLength = strlen($item[0]);
            $startPos = $item[1];
            for ($i = $startPos; $i < $startPos + $filterValLength; $i++) {
                $valueMaskArr[$i]['inFilter'] = true;
                $valueMaskArr[$i]['char'] = $valueArr[$i];
            }
        }
    }
    
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
    
    $value = implode('', $valueArr);
@endphp

<td>
    <div class="p-3 d-flex align-items-center {{ $column['tdClass'] }}">{!! $value !!}</div>
</td>
