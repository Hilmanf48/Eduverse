@props(['type' => 'submit'])

<button 
    type="{{ $type }}" 
    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
    {{ $attributes }}
>
    {{ $slot }}
</button>