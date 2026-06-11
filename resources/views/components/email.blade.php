@props(['label' => 'Email Input', 'placeholder' => 'example@domain.com', 'required' => false, 'cssClass' => 'w-full'])

<div class="mb-4 {{ $cssClass }}">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>
    <input type="email" placeholder="{{ $placeholder }}" class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50/50 text-sm" disabled>
</div>