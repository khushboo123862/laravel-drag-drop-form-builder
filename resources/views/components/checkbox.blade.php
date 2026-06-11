@props(['label' => 'Checkboxes', 'options' => [], 'required' => false, 'cssClass' => 'w-full'])

<div class="mb-4 {{ $cssClass }}">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>
    <div class="flex flex-col gap-2 mt-1.5">
        @if(empty($options))
            <label class="inline-flex items-center gap-2 text-sm text-gray-600"><input type="checkbox" class="rounded border-gray-300 text-blue-600" disabled> Option 1</label>
        @else
            @foreach($options as $option)
                <label class="inline-flex items-center gap-2 text-sm text-gray-600"><input type="checkbox" class="rounded border-gray-300 text-blue-600" disabled> {{ $option }}</label>
            @endforeach
        @endif
    </div>
</div>