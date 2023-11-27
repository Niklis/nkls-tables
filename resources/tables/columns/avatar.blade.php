@props(['value', 'column'])

<td class="">
    <div class="{{ $column['tdClass'] }}">
        <img src="{{ asset('/avatars/' . $value) }}" loading="lazy" style="width: 24px;height: 24px;"/>
    </div>
</td>
