<?php

namespace Nkls\Tables;

use Livewire\Component;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination;

    public $uid; //?

    public $theme = '';

    public $columns = [];

    public $perPageValue = 5;

    public $perPageOptions = [5, 10, 15, 20, 30, 50, 100];

    public $page = 1;

    public $sortBy;

    public $sortDirection = 'asc';

    public $searchValue;

    public $searchColumns = [];

    public $filters = [];

    public string $class;

    public string $searchTmpl;

    public string $perPageTmpl;

    public $test = 'red';

    // protected $listeners = [
    //     'ft' => 'ft',
    // ];

    public function ft()
    {
        $this->test = $this->test == 'red' ? 'green' : 'red';
    }

    public function __construct()
    {
        $this->columns = collect($this->columns())->map(function (Column $column) {return (array) $column;});
        $this->theme = $this->getTheme();
        $this->searchTmpl = $this->getSearchTmpl();
        $this->perPageTmpl = $this->getPerPageTmpl();
        $this->uid = getUid();

        // foreach ($this->columns as $col) {
        //     if ($col->filter !== null) {
        //         $this->filters[$col->hash] = ['key' => $col->key, 'type' => $col->filter, 'val1' => '', 'val2' => ''];
        //     }
        // }
        foreach ($this->columns as $col) {
            if ($col['filter'] !== null) {
                $this->filters[$col['hash']] = ['key' => $col['key'], 'type' => $col['filter'], 'val1' => '', 'val2' => ''];
            }
        }
        // dd($this->filters);
    }

    public abstract function query(): \Illuminate\Database\Eloquent\Builder;

    public abstract function columns(): array;

    // public function filter($column, $val1, $val2 = '')
    // {
    //     if (isset($this->filters[$column])) {
    //         $this->filters[$column]['val1'] = $val1;
    //         $this->filters[$column]['val2'] = $val2;
    //     }
    // }

    public function search($value)
    {
        $this->searchValue = $value;
    }

    public function data()
    {
        $query = $this->query();

        //global search
        if ($this->searchValue != '') {
            $query = $query->where(function ($query) {
                foreach ($this->searchColumns as $column) {
                    $query->orWhere($column, 'LIKE', "%{$this->searchValue}%");
                }
            });
        }
        //filters
        if (count($this->filters)) {
            // dd($this->filters);
            foreach ($this->filters as $col => $filter) {
                if ($filter['val1'] != '' && $filter['val2'] == '') {
                    //single filter
                    $query = $query->where($filter['key'], 'LIKE', "%{$filter['val1']}%");
                } elseif ($filter['val1'] != '' && $filter['val2'] != '') {
                    //range filter
                } else {
                    //empty filter
                    continue;
                }
            }
        }
        //sorting
        if ($this->sortBy != '')
            $query = $query->orderBy($this->sortBy, $this->sortDirection);
        
        return $query->paginate($this->perPageValue);
    }

    public function sort($key)
    {
        $this->resetPage();

        if ($this->sortBy === $key) {
            $direction = $this->sortDirection === 'asc' ? 'desc' : 'asc';
            $this->sortDirection = $direction;
            return;
        }

        $this->sortBy = $key;
        $this->sortDirection = 'asc';
    }

    public function render()
    {
        return view('nkls::components.' . $this->theme . '.table');
    }

    public function getSearchTmpl()
    {
        $tmpl = config('nkls-tables.search');
        return $tmpl ? 'nkls::' . $this->theme .  $tmpl : 'nkls::' . $this->theme . '.search';
    }

    public function getPerPageTmpl()
    {
        $tmpl = config('nkls-tables.per-page');
        return $tmpl ? 'nkls::' . $this->theme .  $tmpl : 'nkls::' . $this->theme . '.per-page';
    }

    public function getTheme(): string
    {
        return $this->theme == '' ? config('nkls-tables.theme') : $this->theme;
    }

    public function paginationView(): string
    {
        return 'nkls::components.' . $this->theme . '.pagination';
    }
}
