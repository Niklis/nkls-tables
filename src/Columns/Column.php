<?php

namespace Nkls\Tables\Columns;

class Column
{
    public $key;

    public $hash;

    public $label;

    public $sortable = false;

    public $sortDir = 'asc';

    //Global search
    public $searchable = false;

    public $theme = '';

    public $thTmpl = 'default';

    public $tdTmpl = 'default';

    public $thClass = '';

    public $tdClass = '';

    public $filter = null;

    public $filterTmpl = 'none';

    public $mobile = [
        'show' => true, //Show column in mobile mode
        'order' => null,
        'cardHeader' => false, //Show column in mobile card header
    ];

    //TODO:
    // public $tablet = [
    //     'show' => true, //Show column in tablet mode
    //     'order' => null,
    //     'cardHeader' => false, //Show column in tablet card header
    // ];

    public function __construct($key, $label)
    {
        $this->key = $key;
        $this->label = $label;
        $this->theme = $this->getTheme();
        $this->setTheme();
    }

    public function mobile($show = true, $order = null, $cardHeader = false)
    {
        $this->mobile['show'] = $show;
        $this->mobile['order'] = $order;
        $this->mobile['cardHeader'] = $cardHeader;
        return $this;
    }

    //$direction only for multisort
    //for single sort use config properties 'sortBy' and 'sortDirection'
    //to make column sortable just add '->sortable()'
    public function sortable($sort = true, $direction = 'asc') 
    {
        $this->sortable = $sort;
        $this->sortDir = $direction;
        return $this;
    }

    public function searchable($search = true)
    {
        $this->searchable = $search;
        return $this;
    }

    public function addFilter($filter = 'text')
    {
        $this->filter = $filter;
        $this->filterTmpl = 'tables.filters.' . $filter;
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
        $this->tdTmpl = 'tables.columns.' . $tmpl;
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
        return $this->theme == '' ? config('nkls-panel.theme') : $this->theme;
    }

    public function setTheme()
    {
        $this->thTmpl = 'tables.headings.' . $this->thTmpl;
        $this->tdTmpl = 'tables.columns.' . $this->tdTmpl;
        $this->filterTmpl = 'tables.filters.' . $this->filterTmpl;
    }
}
