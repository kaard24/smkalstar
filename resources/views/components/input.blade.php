@props([
    'type' => 'text',
    'name',
    'label',
    'placeholder' => '',
    'value' => '',
    'required' => false,
    'error' => null,
    'icon' => null,
    'helper' => null
])

<div class="space-y-2">
    @if($label)
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700">
        {{ $label }}
        @if($required)
        <span class="text-red-500">*</span>
        @endif
    </label>
    @endif
    
    <div class="relative group">
        @if($icon)
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-gray-400 group-focus-within:text-primary transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $icon !!}
            </svg>
        </div>
        @endif
        
        <input 
            type="{{ $type }}"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            {{ $required ? 'required' : '' }}
            {{ $attributes->merge([
                'class' => 'w-full ' . ($icon ? 'pl-11' : 'pl-4') . ' pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:bg-white focus:ring-4 focus:ring-primary/10 focus:border-primary transition-all duration-200' . ($error ? ' border-red-500' : '')
            ]) }}
        >
    </div>
    
    @if($error)
    <p class="text-sm text-red-500">{{ $error }}</p>
    @endif
    
    @if($helper && !$error)
    <p class="text-xs text-gray-500">{{ $helper }}</p>
    @endif
</div>
