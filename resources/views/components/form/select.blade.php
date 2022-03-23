@props([
    'label' => null,
    'value' => '',
    'id' => null,
    'name',
    'required' => 0,
])
@php
$id = $id ?? $name;
@endphp
@if (isset($label))
    <X-form.label :required="$required">{{ $label }}</X-form.label>
@endif
<input id="{{ $id }}" type="{{ $type }}" name="{{ $name }}"
    value="{{ $type == 'password' ? '' : old($name, $value) }}"
    {{ $attributes->class(['form-control text-right', 'is-invalid' => $errors->has($name)]) }}>
@error($name)
    <p class="text-danger">{{ $message }}</p>
@enderror
