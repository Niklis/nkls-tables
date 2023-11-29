@props(['class' => '', 'id' => '', 'theme', 'config'])

<div class="d-flex flex-column gap-3" @if ($tableId) id="{{ $tableId }}" @endif>
    
    <div x-data="{}" x-init="$wire.$set('screenSize', window.innerWidth)">
        <div x-on:resize.window.debounce="$wire.$set('screenSize', window.innerWidth)"></div>
    </div>

    @isset($layout)
        @include($this->layout)
    @else
        <h1 style="color: black;background: white;text-align: center;">NO LAYOUT</h1>
    @endisset

    {{-- <div wire:loading> 
        <div style="display: grid;position: fixed;left: 0;top: 0;right: 0;bottom: 0;background: rgba(0,0,0,0.65);z-index: 10000;">
            <h1 style="place-self: center;color: white;">Loading...</h1>
        </div>
    </div> --}}
</div>
@once
    {{-- @push('footerScript') --}}
        <script>
            window.addEventListener('closeModal', (event) => {
                //modalId passed from component
                const modalId = event.detail.modalId
                console.log('modalId: ', modalId)
                var modalEl = document.getElementById(modalId);
                var modal = bootstrap.Modal.getInstance(modalEl)
                modal.hide();
            })
        </script>
    {{-- @endpush --}}
@endonce
