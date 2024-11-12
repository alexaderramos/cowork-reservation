@props(['links'])

<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        @foreach($links as $link)
            @if ($loop->last)
                <!-- Último elemento como activo -->
                <li class="breadcrumb-item active" aria-current="page">{{ $link['label'] }}</li>
            @else
                <!-- Elementos anteriores con enlaces -->
                <li class="breadcrumb-item">
                    <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
