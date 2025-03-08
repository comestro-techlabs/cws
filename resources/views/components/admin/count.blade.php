@props(['count' => 0])

<div>
    @if ($count > 0)
        <span class="inline-flex items-center justify-center px-2 py-0.5 text-xs font-medium text-white bg-purple-700 rounded-full">
            {{ $count }}
        </span>
    @endif
</div>