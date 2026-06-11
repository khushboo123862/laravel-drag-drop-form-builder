@props(['label' => 'File Upload', 'required' => false, 'cssClass' => 'w-full'])

<div class="mb-4 {{ $cssClass }}">
    <label class="block text-sm font-medium text-gray-700 mb-1">
        {{ $label }} @if($required)<span class="text-red-500">*</span>@endif
    </label>
    <div class="w-full border border-dashed border-gray-300 rounded-lg p-3 bg-gray-50 text-center text-xs text-gray-500">
        <i class="fa-solid fa-cloud-arrow-up text-lg text-gray-400 mb-1 block"></i>
        <span>Click or drag files to upload</span>
    </div>
</div>