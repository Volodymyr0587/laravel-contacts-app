@props(['bgcolor' => 'gray', 'count' => 0])

@php
    $bgClass = match ($bgcolor) {
        'blue' => 'bg-blue-500',
        'red' => 'bg-red-500',
        'green' => 'bg-green-500',
        'yellow' => 'bg-yellow-500',
        'purple' => 'bg-purple-500',
        default => 'bg-gray-500',
    };
@endphp

<span class="top-0.5 right-0.5 grid min-h-[24px] min-w-[24px] translate-x-2/4 -translate-y-2/4 place-items-center rounded-full {{ $bgClass }} py-1 px-1 text-xs text-white">
    {{ $count }}
</span>
