<div>
    @php
        $classes = "text-sm tracking-wide truncate bg-{$bgColor} hover:bg-{$hoverColor} text-white py-1 px-3 rounded-full";
    @endphp

    @if ($count > 0)
        <span class="{{ $classes }}">
            {{ $count }}
        </span>
    @endif
</div>