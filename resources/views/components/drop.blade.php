@props(['label' => 'Dropdown Menu', 'options' => [], 'required' => false, 'cssClass' => 'w-full'])

<div class="mb-4 {{ $cssClass }}">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>
    <select class="w-full px-3 py-2 border border-gray-300 rounded-md bg-white text-gray-700" disabled>
        @if(empty($options))
            <option>Select Option</option>
        @else
            @foreach($options as $option)
                <option>{{ $option }}</option>
            @endforeach
        @endif
    </select>
</div>