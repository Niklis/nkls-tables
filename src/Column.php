<?php

namespace Nkls\Tables;

class Column
{
    public string $key;

    public string $hash;

    public string $label;

    public string $sortByKey;

    public $sortable = false;

    public string $theme = '';

    public string $thTmpl = 'default';

    public string $tdTmpl = 'default';

    public string $thClass = '';

    public string $tdClass = '';

    public $filter = null;

    public string $filterTmpl = 'none';

    public function __construct($key, $label)
    {
        $this->key = $key;
        $this->hash = getUid();
        $this->label = $label;
        $this->theme = $this->getTheme();
        $this->setTheme();
    }

    public function sortable($sort = true)
    {
        $this->sortable = $sort;
        return $this;
    }

    public function addFilter($filter = 'text')
    {
        $this->filter = $filter;
        $this->filterTmpl = 'nkls::' . $this->theme . '.filters.' . $filter;
        return $this;
    }

    public static function make($key, $label)
    {
        return new static($key, $label);
    }

    public function thTmpl($tmpl)
    {
        $this->thTmpl = 'nkls::' . $this->theme . '.headings.' . $tmpl;
        return $this;
    }

    public function tdTmpl($tmpl)
    {
        $this->tdTmpl = 'nkls::' . $this->theme . '.columns.' . $tmpl;
        return $this;
    }

    public function thClass($class)
    {
        $this->thClass = $class;
        return $this;
    }

    public function tdClass($class)
    {
        $this->tdClass = $class;
        return $this;
    }

    public function getTheme()
    {
        return $this->theme == '' ? config('nkls-tables.theme') : $this->theme;
    }

    public function setTheme()
    {
        $this->thTmpl = 'nkls::' . $this->theme . '.headings.' . $this->thTmpl;
        $this->tdTmpl = 'nkls::' . $this->theme . '.columns.' . $this->tdTmpl;
        $this->filterTmpl = 'nkls::' . $this->theme . '.filters.' . $this->filterTmpl;
    }
}
