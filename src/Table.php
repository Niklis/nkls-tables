<?php

namespace Nkls\Tables;

use Livewire\Component;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $theme = 'bootstrap';

    public $perPage = 10;

    public $page = 1;

    public string $class = '';

    public function __construct()
    {
        $this->theme = $this->getTheme();
    }

    public abstract function query(): \Illuminate\Database\Eloquent\Builder;

    public abstract function columns(): array;

    public function getTheme() : string
    {
        return config('nkls-tables.theme', 'bootstrap');
    }

    public function data()
    {
        return $this->query()->paginate($this->perPage);
    }

    public function render()
    {
        return view('nkls::components.' . $this->theme . '.table');
    }

    public function paginationView() : string
    {
        return 'nkls::components.' . $this->theme . '.pagination';
    }
}
