<div>
    @php
        $classes = "text-md tracking-wide truncate bg-{$bgColor} text-gray-400 px-3 py-1 rounded-full";
    @endphp

    @if ($count > 0)
        <span class="{{ $classes }}">
            {{ $count }}
        </span>
    @endif
</div>