<div class="modal-header">
    <h5 class="modal-title">Filters</h5>
    <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="container">
        <div class="row row-cols-2 gy-2 align-items-center">
            @foreach ($this->config['columns'] as $column)
                @if ($column['filterTmpl'] != 'tables.filters.none')
                    <div class="col">
                        <strong>{{ $column['label'] }}</strong>
                    </div>
                    <div class="col">
                        <x-dynamic-component :component="$column['filterTmpl']" :column="$column" />
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <div class="container my-4">
        <strong>{{ $this->data()->total() }}</strong> @lang('items from') {{ $this->countItems }}
    </div>
</div>
