<?php

namespace Nkls\Tables;

use Livewire\Component;
use Livewire\WithPagination;
use Nkls\Tables\Traits\ConfigTableTrait;
use Nkls\Tables\Traits\SearchTableTrait;
use Nkls\Tables\Traits\FilterTableTrait;
use Nkls\Tables\Traits\SortTableTrait;
use Nkls\Tables\Traits\CrudTrait;

abstract class Table extends Component
{
    use WithPagination,
        ConfigTableTrait,
        SearchTableTrait,
        FilterTableTrait,
        SortTableTrait,
        CrudTrait;

    public $tableId;

    public $modalId;

    public $theme = '';

    public $columns;

    public $searchableColumns = [];

    public $countItems;

    public $searchTmpl;

    public $perPageTmpl;

    public $screenSize;

    public $layout;

    public abstract function getEntityName($plural = false): string;

    public abstract function config(): array;

    public abstract function query(): \Illuminate\Database\Eloquent\Builder;

    public abstract function columns(): array;

    public function mount()
    {
        $this->tableId = $this->getFingerPrint();

        $this->modalId = 'm_' . $this->getFingerPrint();

        $this->config = $this->initConfig();

        //Sync config with session
        if (!session($this->getFingerPrint())) {
            session()->put($this->getFingerPrint(), $this->config);
        } else {
            $this->config = session($this->getFingerPrint());
        }

        $this->layout = $this->getLayout();
    }

    public function updated($property, $value)
    {
        $arr = explode('.', $property);

        //Check if configuration has changes then set changed variable to session.
        //This is for binding WIRE:MODEL.LIVE from the frontend to global session.
        //Without this, the fields in the form and table options are cleared after reload page.
        if ($arr[0] == 'config') {
            $this->setConfig($property, $value);
            //after applayng changes in config go to first page
            $this->setPage(1);
        }
    }

    public function render()
    {
        $this->layout = $this->getLayout();
        return view('nkls::tables.table');
    }

    private function getLayout()
    {
        $viewPrefix = $this->getConfig('tableViewPrefix'); //'nkls::tables.layouts.';

        if ($this->screenSize == null || $this->screenSize > $this->getConfig('mobileWidth'))
            return $this->layout = $viewPrefix . $this->getConfig('desktopView.layout');

        return $this->layout = $viewPrefix . $this->getConfig('mobileView.layout');
    }

    public function getFingerPrint()
    {
        return 'tbl_' . crc32(static::class);
    }

    public function data()
    {
        $query = $this->query();

        //Global search
        $query = $this->applySearch($query);

        //Filters
        $query = $this->applyFilters($query);

        //Sorting
        if (isset($this->multiSortEnabled) && $this->multiSortEnabled) {
            $query = $this->applyMultiSorting($query);
        } else {
            if ($this->config['sortBy'] != '')
                $query = $query->orderBy($this->config['sortBy'], $this->config['sortDirection']);
        }

        return $query->paginate($this->getConfig('perPageValue'));
    }

    public function getSearchTmpl() //TODO: move this to trait
    {
        return 'tables.search';
    }

    public function getPerPageTmpl() //TODO: move this to trait
    {
        return 'tables.per-page';
    }

    public function getTheme(): string //TODO: move this to trait
    {
        return config('nkls-tables.theme');
    }
}
