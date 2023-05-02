<?php

namespace Nkls\Tables;

class Column
{
    public string $theme = 'bootstrap';

    public string $th = 'headings.default';

    public string $td = 'columns.default';

    public string $label;

    public string $sortByKey;

    public string $key;

    public string $class = '';

    public function __construct($key, $label)
    {
        $this->key = $key;
        $this->label = $label;
        $this->theme = $this->getTheme();
        $this->setTheme();
    }

    public static function make($key, $label)
    {
        return new static($key, $label);
    }

    public function th($tmpl)
    {
        $this->th = 'nkls::' . $this->theme . '.' . $tmpl;
        return $this;
    }

    public function td($tmpl)
    {
        $this->td = 'nkls::' . $this->theme . '.' . $tmpl;
        return $this;
    }

    public function class($class)
    {
        $this->class = $class;
        return $this;
    }
    
    //get value from array with dot notation string or without
    public static function getValue($array, $dotNotationString)
    {
        foreach (explode('.', $dotNotationString) as $segment) {
            $array = $array[$segment];
        }
        return $array;
    }

    public function getTheme()
    {
        return config('nkls-tables.theme', 'bootstrap');
    }

    public function setTheme()
    {
        $this->th = 'nkls::' . $this->theme . '.' . $this->th;
        $this->td = 'nkls::' . $this->theme . '.' . $this->td;
    }
}
