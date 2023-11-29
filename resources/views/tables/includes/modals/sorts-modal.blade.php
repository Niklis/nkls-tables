<div class="modal-header">
    <h5 class="modal-title">Sorts</h5>
    <button type="button" wire:click="closeModal" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="container">
        <div class="row row-cols-2 gy-2 align-items-center">
            @foreach ($this->config['columns'] as $column)
                @if ($column['sortable'] == true)
                    @if ($this->config['sortBy'] == $column['key'])
                        <div class="col" wire:click="sort('{{ $column['key'] }}')" style="cursor: pointer;">
                            @lang($column['label'])
                            <span wire:loading wire:loading.delay wire:target="sort('{{ $column['key'] }}')"
                                class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
                            @if ($this->config['sortDirection'] == 'asc')
                                <i class="bi bi-arrow-down ms-2" wire:target="sort('{{ $column['key'] }}')"
                                    wire:loading.class="d-none"></i>
                            @else
                                <i class="bi bi-arrow-up ms-2" wire:target="sort('{{ $column['key'] }}')"
                                    wire:loading.class="d-none"></i>
                            @endif
                        </div>
                    @else
                        <div class="col" wire:click="sort('{{ $column['key'] }}')" style="cursor: pointer;">
                            @lang($column['label'])
                            <span wire:loading wire:loading.delay wire:target="sort('{{ $column['key'] }}')"
                                class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true"></span>
                            <i class="bi bi-arrow-down-up ms-2" wire:target="sort('{{ $column['key'] }}')"
                                wire:loading.class="d-none"></i>
                        </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>
    <div class="container my-4">
        <strong>{{ $this->data()->total() }}</strong> @lang('items from') {{ $this->countItems }}
    </div>
</div>
