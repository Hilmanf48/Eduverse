<!-- resources/views/components/button.blade.php -->
<button {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none transition']) }}>
    {{ $slot }}
</button>
