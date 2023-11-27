<?php

namespace Nkls\Tables\Traits;

trait SearchTableTrait
{
    protected $searchEnabled = true;

    protected $pregMatchSearch; //TODO

    protected function applySearch($query)
    {
        $this->searchableColumns = $this->getSearchableColumns();

        if (count($this->searchableColumns) && $this->config['searchValue'] != '') {
            $query->where(function ($query) {
                foreach ($this->searchableColumns as $column) {
                    $query->orWhere($column, 'LIKE', "%{$this->config['searchValue']}%");
                }
            });
        }

        return $query;
    }

    protected function getSearchableColumns()
    {
        return $this->config['columns']
        ->filter(function ($column) {
            return $column['searchable'];
        })->map(function ($column) {
            return $column['key'];
        })->toArray();
    }
}
