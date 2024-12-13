@php
    $type ??= 'text';
    $class ??= null;
    $name ??= '';
    $label ??= ucfirst($name);
    $value ??= old($name);
@endphp

<div @class(['form-group', $class])>
    <label for="{{ $name }}">{{ $label }}</label>
    @if ($type === 'textarea')
        <textarea class="form-control @error($name) is-invalid @enderror" type="{{$type}}" name="{{ $name }}" id="{{ $name }}" rows="4">{{ $value }}</textarea>
    @elseif ($type === 'file')
        <input type="file" class="form-control @error($name) is-invalid @enderror" type="{{$type}}" name="{{ $name }}" id="{{ $name }}">
        @if (session()->has('previous_file'))
        <p>Fichier précédemment téléchargé : {{ session('previous_file') }}</p>
    @endif
    @else
        <input type="{{ $type }}" class="form-control @error($name) is-invalid @enderror" type="{{$type}}" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}">
    @endif
    @error($name)
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>
