@props(['value', 'column'])

<td class="">
    <div class="d-flex align-items-center {{ $column->tdClass }}">
        <img src="{{ asset('/avatars/' . $value) }}" style="width: 45px; height: 45px;" />
    </div>
</td>
