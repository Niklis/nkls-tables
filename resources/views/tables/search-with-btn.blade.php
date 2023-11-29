@props(['class' => ''])

@php
    $uid = getTableUid();
@endphp
{{-- 
<div class="{{ $class }}">
    <div class="input-group">
        <input type="search" id="nkls_table_search_{{ $uid }}" class="form-control" placeholder="Search"
            aria-label="Search" aria-describedby="nkls_table_search_button_{{ $uid }}"
            wire:change="search(nkls_table_search_{{ $uid }}.value)" wire:loading.attr="disabled"
            value="{{ $this->searchValue }}">
        <button wire:click="search(nkls_table_search_{{ $uid }}.value)" class="btn btn-primary" type="button"
            id="nkls_table_search_button_{{ $uid }}" wire:loading.attr="disabled">
            <span wire:loading wire:loading.delay wire:target="search" class="spinner-border spinner-border-sm"
                role="status" aria-hidden="true"></span>
            <i class="bi bi-search" wire:target="search" wire:loading.class="d-none"></i>
        </button>
    </div>
</div> 
--}}
