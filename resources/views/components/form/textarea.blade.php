@props([
    'label' => null,
    'value' => '',
    'id' => null,
    'name',
])
@php
$id = $id ?? $name;
@endphp
@if (isset($label))
    <label for="{{ $id ?? '' }}" class="">{{ $label }}</label>
@endif
<textarea id="{{ $id }}" name="{{ $name }}"
    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>{{ old($name, $value) }}</textarea>
@error($name)
    <p class="text-danger">{{ $message }}</p>
@enderror
