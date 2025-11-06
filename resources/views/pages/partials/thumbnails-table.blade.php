<table class="links-table">
    <thead>
    <tr>
        <td>{{ __('views.index.resolution') }}</td>
        <td>{{ __('views.index.link') }}</td>
    </tr>
    </thead>
    <tbody>
    @foreach($thumbnails as $item)
        <tr>
            <td>{{ $item['width'] }} x {{ $item['height'] }}</td>
            <td style="min-width: 450px;">
                <a href="{{ $item['url'] }}" title="{{ $item['url'] }}" target="_blank">{{ $item['url'] }}</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
