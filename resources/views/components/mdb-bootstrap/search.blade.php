@props(['class'])

@props(['class'])

<div class="{{ $class }}">
    <div class="input-group">
        <div class="form-outline">
            <input type="search" id="nkls_table_search" class="form-control" aria-label="Search" 
                aria-describedby="nkls_table_search-button" wire:keydown.enter="search(nkls_table_search.value)"
                wire:loading.attr="disabled">
            <label class="form-label" for="nkls_table_search">Search</label>
        </div>
        <button wire:click="search(nkls_table_search.value)" class="btn btn-primary" type="button"
            id="nkls_table_search-button" wire:loading.attr="disabled">
            <span wire:loading wire:loading.delay wire:target="search" class="spinner-border spinner-border-sm"
                role="status" aria-hidden="true"></span>
            <i class="bi bi-search" wire:target="search" wire:loading.class="d-none"></i>
        </button>
    </div>
</div>
