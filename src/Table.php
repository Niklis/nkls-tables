<?php

namespace Nkls\Tables;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $theme = 'bootstrap';

    public $perPage = 5;

    public $page = 1;

    public $sortBy = '';

    public $sortDirection = 'asc';

    public string $class = '';

    public function __construct()
    {
        $this->theme = $this->getTheme();
    }

    public abstract function query(): \Illuminate\Database\Eloquent\Builder;

    public abstract function columns(): array;

    public function data()
    {
        return $this
            ->query()
            ->when(pluralSortBy($this->sortBy) !== '', function ($query) {
                $query->orderBy(pluralSortBy($this->sortBy), $this->sortDirection);
            })
            ->paginate($this->perPage);
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

    public function getTheme(): string
    {
        return config('nkls-tables.theme', 'bootstrap');
    }

    public function paginationView(): string
    {
        return 'nkls::components.' . $this->theme . '.pagination';
    }
}
