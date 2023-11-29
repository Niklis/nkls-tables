@props(['class' => ''])

<div class="{{ $class }}">
    <input type="search" id="{{ 's_' . crc32(static::class) }}" class="form-control" placeholder="Search"
        aria-label="Search" 
        wire:model.live="config.searchValue"
        value="{{ $this->config['searchValue'] }}">
</div>
