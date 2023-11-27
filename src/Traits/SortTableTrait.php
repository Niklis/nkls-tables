<?php

namespace Nkls\Tables\Traits;

trait SortTableTrait
{
    public $sortEnabled = true;

    public $multiSortEnabled = false;

    public function openSorts(){
        $this->modalBody = 'nkls::tables.includes.modals.sorts-modal';
    }

    public function getSortable()
    {
        $sorts = [];

        foreach ($this->config['columns'] as $col) {
            if ($col['sortable'] === true) {
                //set sort direction
                $sorts[$col['hash']] = ['key' => $col['key'], 'sortDir' => $col['sortDir']];
            }
        }

        return $sorts;
    }

    public function sort($key)
    {
        $this->resetPage();

        if ($this->multiSortEnabled) {
            $direction = ($this->config['sorts'][$key]['sortDir'] == 'asc') ? 'desc' : 'asc';
            $this->setConfig('sorts.' . $key . '.sortDir', $direction);
        } else {

            if ($this->config['sortBy'] === $key) {
                $direction = $this->config['sortDirection'] === 'asc' ? 'desc' : 'asc';
                $this->setConfig('sortDirection', $direction);
                return;
            }

            $this->setConfig('sortBy', $key);
            $this->setConfig('sortDirection', 'asc');
        }
    }

    public function applyMultiSorting($query)
    {
        foreach ($this->config['sorts'] as $col) {
            $query = $query->orderBy($col['key'], $col['sortDir']);
        }

        return $query;
    }
}
