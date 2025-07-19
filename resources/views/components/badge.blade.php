@props([
'label', // Required text label
'color' => '', // Tailwind background/text combo (from enum)
'class' => '', // Additional optional classes
])

@php
$baseClasses = 'inline-flex items-center px-3 py-1 rounded-md text-xs font-semibold';
@endphp

<span {{ $attributes->merge(['class' => "$baseClasses $color $class"]) }}>
    {{ $label }}
</span>