@props(['name', 'type' => 'text', 'label', 'placeholder' => '', 'required' => false, 'autofocus' => false])

<div class="mb-6 relative group">
    @if($label)
    <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    @endif
    
    <input 
        type="{{ $type }}" 
        id="{{ $name }}" 
        name="{{ $name }}" 
        placeholder="{{ $placeholder }}" 
        {{ $required ? 'required' : '' }}
        {{ $autofocus ? 'autofocus' : '' }}
        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all duration-200 group-hover:border-blue-300"
        {{ $attributes }}
    >
    
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>