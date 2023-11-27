<?php

namespace Nkls\Tables\Traits;

trait FilterTableTrait
{
    public function openFilters(){
        $this->modalBody = 'nkls::tables.includes.modals.filters-modal';
    }

    protected function getFilters()
    {
        $filters = [];

        foreach ($this->config['columns'] as $col) {
            if ($col['filter'] !== null) {
                $filters[$col['hash']] = ['key' => $col['key'], 'type' => $col['filter'], 'val1' => '', 'val2' => ''];
            }
        }

        return $filters;
    }

    protected function applyFilters($query)
    {
        if ($this->config['filtersEnabled'] && count($this->config['filters'])) {
            foreach ($this->config['filters'] as $col => $filter) {
                if ($filter['val1'] != '' && $filter['val2'] == '') {
                    //text filter
                    $query = $query->where($filter['key'], 'LIKE', "%{$filter['val1']}%");
                } elseif ($filter['val1'] != '' && $filter['val2'] != '') {
                    //range filter
                } else {
                    //empty filter
                    continue;
                }
            }
        }

        return $query;
    }
}
