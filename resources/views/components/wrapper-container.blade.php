@php
$classes = "p-6 lg:p-8 bg-white border-b border-gray-200 max-w-7xl mx-auto ";
@endphp
<div {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</div>
