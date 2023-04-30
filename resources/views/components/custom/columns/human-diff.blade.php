@props(['value', 'class'])

<td>
    <div class="py-3 px-3 d-flex align-items-center justify-content-center {{ $class }}">
        {{ \Carbon\Carbon::make($value)->diffForHumans() }}
    </div>
</td>
