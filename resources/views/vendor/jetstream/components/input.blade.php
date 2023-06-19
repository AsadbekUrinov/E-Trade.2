@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border bg-light text-dark form-control rounded shadow']) !!}>
