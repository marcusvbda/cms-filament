@if (data_get($attributes, 'show_title'))
    <H1>{{ data_get($attributes, 'title') }}</H1>
@endif

@foreach (data_get($attributes, 'repeater_imagem') as $content)
    {{-- @php dd($content); @endphp --}}
    <img src="{{ $content->url }}" />
    <small>{{ $content->meta['description'] }}</small>
@endforeach
