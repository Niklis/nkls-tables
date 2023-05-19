@props(['value', 'column'])

<td class="">
    <div class="m-auto p-1 avatar {{ $column->tdClass }}">
        <img src="{{ asset('/avatars/' . $value) }}" class="img-thumbnail" />
    </div>
</td>
