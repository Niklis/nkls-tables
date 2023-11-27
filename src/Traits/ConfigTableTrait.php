<?php

namespace Nkls\Tables\Traits;

use Nkls\Tables\Columns\Column;

trait ConfigTableTrait
{
    private $configDefault = [];

    public $config = [];

    protected function initConfig()
    {
        //Set columns hash and convert to collection
        $this->columns = collect($this->columns())->map(function (Column $column) {
            $column = (array) $column;
            $column['hash'] = str_replace('.', '-', $column['key']) . '_' . crc32(static::class . $column['key']);
            return $column;
        });

        $this->theme = $this->getTheme();
        $this->searchTmpl = $this->getSearchTmpl();
        $this->perPageTmpl = $this->getPerPageTmpl();

        //Set default config values 
        //In order for the changes to take effect, you must clear your cookies
        $this->configDefault = [
            'mobileWidth' => 992,
            'mobileView' => [
                'layout' => 'mobile-table',
            ],
            'desktopView' => [
                'layout' => 'desktop-table',
            ],
            'viewPrefix' => 'nkls::tables.layouts.',
            'searchValue' => '',
            'filtersEnabled' => true,
            'perPageOptions' => [5, 10, 15, 20, 30, 50, 100],
            'perPageValue' => 5,
            'sortEnabled' => true,
            'multiSortEnabled' => false,
            'sortBy' => '',
            'sortDirection' => 'asc', //default direction for table
            'tblClass' => 'table',
            'theadClass' => 'border-dark-subtle',
            'columns' => $this->columns,
            'bulkOperations' => true,
        ];

        //Default config values merging with config from descendant class
        $this->config = [
            ...$this->configDefault,
            ...$this->config()
        ];

        //Set filters with FilterTableTrait
        if ($this->config['filtersEnabled']) {
            $this->config['filters'] = $this->getFilters();
        }

        //Set multi sort columns with SortTableTrait
        if (isset($this->multiSortEnabled) && $this->multiSortEnabled) {
            $this->config['sorts'] = $this->getSortable();
        }

        return $this->config;
    }

    public function getConfig($key = null)
    {
        if ($key)
            return data_get($this->config, $key); //work with dot notation

        return $this->config;
    }

    public function setConfig($key, $val = null)
    {
        data_set($this->config, $key, $val);
        session()->put($this->getFingerPrint(), $this->config);
    }

    public function resetConfig()
    {
        $this->config = $this->initConfig();

        session()->put($this->getFingerPrint(), $this->config);
        $this->resetPage();
    }
}
