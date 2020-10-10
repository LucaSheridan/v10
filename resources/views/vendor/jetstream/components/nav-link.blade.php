@props(['active'])

@php
$classes = ($active ?? false)
            ? 'pt-2 bg-cool-gray-400 inline-flex items-center px-2 py-1 border-b-0 border-gray-300 text-md sm:text-md md:text-lg font-medium leading-5 text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out bg-gray-200 rounded-t-lg'
            : ' pt-2 inline-flex items-center px-2 py-1 border-b-2 border-transparent  text-md sm:text-md md:text-lg font-medium leading-5 text-gray-500 hover:text-red-400 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
