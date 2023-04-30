@props(['value', 'class'])

<td class="d-flex align-items-center justify-content-center {{ $class }}">
    <div class="avatar py-1">
        <img src="{{ asset('/avatars/' . $value) }}" class="img-thumbnail" />
    </div>
</td>
